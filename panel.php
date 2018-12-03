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

	$statements = DbUtils::executeQuery("select * from news where type='statement'", []);
	$contests = DbUtils::executeQuery("select * from news where type='contest'", []);
	$cinema = DbUtils::executeQuery('select title, date from cinema', [])->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
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
				<li>
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
								<h2>Tytul: </h2><input type="text" value="title"></input>
								<h3>Data: </h3><input type="date" value="date"></input>
								<h3>Treść: </h3><textarea wrap="soft">content</textarea>
							</form>
						';	
						
						foreach($statements as $s){
							
							unset($s['type']);
							echo(strtr($template, $s));

						}

				?>
			</div>
			<div class="cinema">
					<form method="post">
						<h2>Tytuł filmu: </h2>
						<input type="text" value="<?php echo($cinema['title']); ?>">
						<h3>Data: </h3>
						<input type="date" value="<?php echo($cinema['date']); ?>">		
					</form>
			</div>
			<div class="contests"></div>
		</div>
	</div>
</body>
</html>
