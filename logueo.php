<?php
	include "conexiones.php";
	$usuario=$_POST['usuario'];
	$pass=$_POST['pass'];
		$result = mysqli_query($con,"select j.id_jurado 'id_jurado', u.id_usuario 'id_usuario', u.is_admin_usuario 'is_admin_usuario'
                        from usuario u 
                        inner join jurado j on(u.id_usuario = j.id_usuario)
                        where login_usuario='{$usuario}' and pass_usuario=md5('{$pass}')");


		$aux = 0;
		while ($row = mysqli_fetch_array($result))
		{
		  $aux = $aux + 1;
		  $var = $row['is_admin_usuario'];
		  $id_j=$row['id_jurado'];
		}
		if ($aux == 1)
		{
			session_start();
			session_unset();
			//PONGO QUE NO ES COORDINADOR Y DESPUES LO EVALUO
			$_SESSION['is_Coordinador'] = 0;
			//VEO SI ES COORDINADOR DE UNA MESA
			$es_coord = mysqli_query($con,"select id_mesa from mesa
										where id_coordinador_mesa = $id_j");
			if (mysqli_num_rows($es_coord) > 0)
			{
		  		$_SESSION['is_Coordinador'] = 1;
			}
			
			$_SESSION['login'] = $usuario;
		  	$_SESSION['token'] = md5(rand().$_SESSION['login']);
		  	$_SESSION['is_Admin'] = $var;
		  	$_SESSION['id_jurado'] = $id_j;
		  			  	

		  	mysqli_query($con,"update usuario set token_usuario='{$_SESSION['token']}' where login_usuario='{$_SESSION['login']}'");
	  	  	if ($var == 1)
			  	header("Location: crearConcurso2.php");
		  	else
			  	header("Location: index.php");
		  	}
                mysqli_close($con);

?>

<html>
	<head>
		<title>Error Login</title>
	</head>
	<body>
		<strong>Usuario o password incorrectos</strong>
		<br />
		<a href="login.php">Intentar Nuevamente</a>
	</body>
</html>
