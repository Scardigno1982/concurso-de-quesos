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
		
		echo "<label for ='categoria_nueva'>Nueva Categoria de Queso</label>";
		echo "<input type='text' name='categoria_nueva' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
		echo "<br />";
		echo "<label for ='codigo_nueva'>Codigo Categoria de Queso</label>";
		echo "<input type='text' name='codigo_nueva' onkeyup='javascript:this.value=this.value.toUpperCase();'>";
		echo "<br />";
		echo "<br />";
		echo "<input type='submit' value='Aceptar' />";
		echo "</form>";



		//SI YA SELECCIONO UN NUEVO CAMPO

		if(isset($_POST['categoria_nueva'])){
			$tipo = $_POST['categoria_nueva'];
			$codigo = $_POST['codigo_nueva'];
			
			mysqli_query($con, "insert into categoria values(null,'$tipo','$codigo')");
			echo "<script>";
			echo "window.self.close()";
			echo "</script>";
		}
		echo "</div>";
		echo "</div>";
	?>
</body>