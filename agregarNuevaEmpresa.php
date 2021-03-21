<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
                header("Location: login.php");
?>
<html>



<head>
	<title>Concurso</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">	
	<link rel="stylesheet" type="text/css" href="css/style.css">	



</head>
<body>
	<?php
		include "conexiones.php";
		echo "<div id='inside'>";
			echo "<div id='peque'>";
		echo "<form action='' method='post'>";
		
		echo "<label for ='empresa_nueva'>Nueva Empresa</label>";
		echo "<input type='text' name='empresa_nueva' required>";
		echo "<br />";
		echo "<br />";
		echo "<label for ='tipo_nuevo'>Tipo Empresa</label>";

		echo "<select name='tipo_nuevo'>";
		echo "<option value='Gran'>Gran</option>";
		echo "<option value='Pyme'>Pyme</option>";
		echo "<option value='Micro Pyme'>Micro Pyme</option>";
		echo "</select>";

		echo "<br />";
		echo "<br />";
		echo "<label for ='localidad'>Localidad</label>";
		echo "<input type='text' name='localidad' required>";
		echo "<br />";
		echo "<br />";
		echo "<input type='submit' value='Aceptar' />";
		echo "</form>";



		//SI YA SELECCIONO UN NUEVO CAMPO

		if(isset($_POST['empresa_nueva'])){
			$empresa = $_POST['empresa_nueva'];
			$tipo = $_POST['tipo_nuevo'];
			$localidad = $_POST['localidad'];
			
			mysqli_query($con, "insert into empresa values(null,'$empresa','$localidad','$tipo')");
			echo "<script>";
			echo "window.opener.location.reload();";
			echo "window.self.close();";
			echo "</script>";
		}
		echo "</div>";
		echo "</div>";
	?>
</body>