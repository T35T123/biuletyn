<?php

    require_once('php/data-validation.php');

		$private_key = file_get_contents('.private.key');
	  $public_key = file_get_contents('.public.key');

    $error = '';

    session_start();

    if(isset($_SESSION['active'])){
        header('Location: /panel');
		}

    if(isset($_POST['login']) && isset($_POST['password'])){
			
			openssl_private_decrypt(base64_decode($_POST['login']), $login, $private_key);
			openssl_private_decrypt(base64_decode($_POST['password']), $password, $private_key);

			$error = LoginValidation::validate($login, $password);
		
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
												<textarea disabled hidden id="public_key"><?php echo($public_key); ?></textarea>
												<span class="error"><?php echo($error); ?></span>
												<button>Zaloguj</button>
                </form>
				</div>
				<script src="js/jsencrypt.min.js"></script>
				<script>
					
						const rsa = new JSEncrypt();
						rsa.setPublicKey(public_key.value);

						document.forms[0].addEventListener('submit', function(e){

							let {login, password} = this;

							login.value = rsa.encrypt(login.value);
							password.value = rsa.encrypt(password.value);

						});
			
				</script>
</body>
</html>
