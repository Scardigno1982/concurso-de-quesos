<html>
	<head>
	  <title>Login</title>
		
	  <link rel="stylesheet" type="text/css" href="css/reset.css">
	  <link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body>
		<div id="header">
                <img src="images/header.gif" id="banner" />
       	</div>

		<div id="content">
			<form  action="logueo.php" method="post" id="login">
			<h1>Acceso</h1>
			<fieldset class="login-inputs">
			<input type="text" name="usuario" id="usuario" placeholder="Username" autofocus required>
	  		</br>
			<input type="password" name="pass" id="pass" placeholder="Password" required>
			</br>
			</fieldset>
			<input type="submit" value="Aceptar" class="boton">
			</form>
		</div>

		<?php include "footer.php" ?>

	</body>
</html>
