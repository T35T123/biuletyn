<?php

    require_once('php/data-validation.php');

    $error = '';

    session_start();

    if(isset($_SESSION['active'])){
        header('Location: /panel');
    }

    if(isset($_POST['login'])){
			$error = LoginValidation::validate($_POST['login'], $_POST['password']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
				<meta charset="UTF-8">
				<link rel="stylesheet" href="styles/login.css">
        <title>Logowanie</title>
</head>
<body>
        <div class="login-container">
                <form method="post" autocomplete='off'>
                        <h1>Biuletyn informacyjny ZST</h1>
                        <label for="login">Login</label>
                        <input type="text" name="login">
												<label for="password">Haslo</label>
												<input type="password" name="password">
												<span class="error"><?php echo($error); ?></span>
												<button>Zaloguj</button>
                </form>
        </div>
</body>
</html>
