<?php

	require_once 'php/database/dbutils.php';

	session_start();

	if(!isset($_SESSION['active'])){
		header('Location: /login');
	}

	if(isset($_GET['logout'])){
		session_destroy();
		header('Location: /login');
	}
	if(isset($_SESSION['active'])){
		
		if(isset($_GET['update'])){
			if($_GET['update'] == 'cinema'){
					DbUtils::executeQuery('update cinema set title="%s", date="%s"', [$_POST['title'], $_POST['date']]);
			}	else {
				DbUtils::executeQuery('update news set title="%s", date="%s", content="%s" where id="%s"',[
						$_POST['title'],
						$_POST['date'],
						$_POST['content'],
						$_GET['update']
					]);
			}

		header('Location: /panel');

		}

		if(isset($_GET['delete'])){

			DbUtils::executeQuery('delete from news where id="%s"', [$_GET['delete']]);

			header('Location: /panel');

		}

		if(isset($_GET['add'])){

			if(!$_POST['title'] || !$_POST['date'] || !$_POST['content'] || !$_POST['type']){
				
				header("Location: /panel?err=1");
			
			} else {

				DbUtils::executeQuery('insert into news(title, date, content, type) values("%s", "%s", "%s", "%s")', 
					[$_POST['title'], $_POST['date'], $_POST['content'], $_POST['type']]);

			}
		
				header('Location: /panel');
		
		}


	}

	$statements = DbUtils::executeQuery("select * from news where type='statement' order by id desc", []);
	$contests = DbUtils::executeQuery("select * from news where type='contest' order by id desc", []);
	$cinema = DbUtils::executeQuery('select title, date from cinema', [])->fetch_assoc();

  function convertTimestampToDate($timestamp){
	
		preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}/', $timestamp, $date);

		return $date[0];

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/panel.css">
	<title>Panel kontrolny</title>
</head>
<body>
	<div id="app">
		<nav class="navbar">
			<header class='navbar-header'>
				<h1>Panel kontrolny</h1>
			</header>
			<ul class="menu">
				<li id="mode_switch">
					<p>Dodaj</p>
				</li>
				<li> 
					<a href="/panel?logout">Wyloguj</a>
				</li>
			</ul>
		</nav>
		<div class="preview">
			<div class="statements">
				<?php

						$template = '
							<form method="post">
								<h2>Tytuł: </h2><input type="text" name="title" value="__title__"></input>
								<h3>Data: </h3><input type="date" name="date" value="__date__"></input>
								<h3>Treść: </h3><textarea name="content" >__content__</textarea>
								<div class="buttons-container">
									<button class="btn"formaction="/panel?update=__id__">Zapisz</button>
									<button class="btn" type="reset">Anuluj</button>
									<button class="btn btn--delete" formaction="/panel?delete=__id__">Usuń</button>
								</div>
							</form>
						';	
						
						foreach($statements as $s){

							$values = array(
								"__id__" => $s['id'],
								"__title__" => $s['title'],
								"__date__" => convertTimestampToDate($s['date']),
								"__content__" => $s['content']
							);

							echo(strtr($template, $values));

						}

				?>
			</div>
			<div class="cinema">
					<form method="post">
						<h2>Tytuł filmu: </h2>
						<input type="text" name="title" value="<?php echo($cinema['title']); ?>">
						<h3>Data: </h3>
						<input type="date" name="date" value="<?php echo($cinema['date']); ?>">		
						<button class='btn' formaction="/panel?update=cinema" >Zapisz</button>
					</form>
			</div>
			<div class="contests">
					<?php 	
						
						foreach($contests as $c){

							$values = array(
								"__id__" => $c['id'],
								"__title__" => $c['title'],
								"__date__" => convertTimestampToDate($c['date']),
								"__content__" => $c['content']
							);

							echo(strtr($template, $values));
						
						}
	
					?>
			</div>
		</div>
		<div class="add">
			<h1>Dodawanie treści</h2>
			<form method="post">
				<h3>Tytuł</h3>
				<input type="text" name="title" required autocomplete='off'>
				<h3>Data</h3>
				<input type="date" name="date" id="add_date">
				<h3>Treść</h3>
				<textarea name="content" required></textarea>
				<select name="type">
					<option value="statement">Komunikat</option>
					<option value="contest">Konkurs</option>
				</select>
				<div class='buttons-container'>
					<button class='btn' formaction="/panel?add">Dodaj</button>
					<button class='btn' id='add_cancel' type="reset">Anuluj</button>
				</div>
			</form>
		</div>
	</div>
	<script>
		
		const deleteButtons = document.querySelectorAll('.btn--delete');
		let editMode = true;

		deleteButtons.forEach(btn => {

			btn.addEventListener('click', function(e) {
		
				if(!confirm(`Czy napewno chcesz usunac: ${this.form.title.value}`)) e.preventDefault(); 

			});

		});

		function switchMode() {
			
			editMode = !editMode;

			document.querySelector('#mode_switch>p').innerText = editMode ? "Dodaj" : "Edytuj";
			document.querySelector('.preview').style.display = editMode ? 'grid' : 'none';
			document.querySelector('.add').style.display = editMode ? 'none' : 'flex';
		
	}

		mode_switch.addEventListener('click', switchMode);	 

	add_date.value = new Date().toISOString().match('^.{10}')[0];
		
	add_cancel.addEventListener('click', switchMode);

	</script>
</body>
</html>
