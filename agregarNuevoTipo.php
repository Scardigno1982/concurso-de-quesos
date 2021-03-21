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
		
		echo "<label for ='tipo_nuevo'>Nuevo Tipo de Queso</label>";
		echo "<input type='text' name='tipo_nuevo' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
		echo "<br />";
		echo "<br />";
		echo "<input type='submit' value='Aceptar' />";
		echo "</form>";



		//SI YA SELECCIONO UN NUEVO CAMPO

		if(isset($_POST['tipo_nuevo'])){
			$tipo = $_POST['tipo_nuevo'];
			
			mysqli_query($con, "insert into tipo values(null,'$tipo')");
			echo "<script>";
			echo "window.self.close()";
			echo "</script>";
		}
		echo "</div>";
		echo "</div>";
	?>
</body>