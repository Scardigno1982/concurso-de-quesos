<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
                header("Location: login.php");
?>

<html>
<head>
	<title> Crear Concurso </title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">	
	<link rel="stylesheet" type="text/css" href="css/style.css">	
</head>
<body>

	<?php include "conexiones.php" ?>
	
	<div id="header"> 
                <img src="images/header.gif" id="banner" />
	</div>
	<div id="content">
	<?php include "sidebar.php" ?>
	
		<div id="info">
		<div id="inside">	
		<?php
			$concursos=mysqli_query($con,"select * from concurso");
			echo "<span class='titular'>Concursos</span>";
			echo "<br />";
			echo "<br />";
			echo "<table>";
			echo "<th> Nombre";
			echo "<th> Lugar";
			echo "<th> Estado";
			//echo "<th> En curso";
			while($concurso = mysqli_fetch_array($concursos)){
				echo "<tr>";
				echo "<td>";
				echo "<a href='editarConcurso.php?id_c=".$concurso['id_concurso']."'>".$concurso['nombre_concurso']."</a>";
				echo "</td>";
				echo "<td>";
				echo $concurso['lugar_concurso'];
				echo "</td>";
				echo "<td>";
				echo $concurso['estado_concurso'];
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<br />";
			
		?>		
		<span class='titular'>Crear Concurso:</span>
		<br />
		<br />
		<form action="" method="POST" id="form-cc">
			<fieldset class="inputs">
			<label for="nombre_concurso">Nombre Concurso: </label>
			<input type="text" id="nombre_concurso" name="nombre_concurso" autofocus required/>

			<label for="lugar_concurso">Lugar: </label>
			<input type="text" id="lugar_concurso" name="lugar_concurso" required/>

			<!--<label for="fecha_concurso">Fecha: </label>
			<input type="date" id="fecha_concurso" name="fecha_concurso" required/>-->
			</fieldset>
			<br />

			<input type="submit" class="boton" value="Guardar" class="guardar_concurso" />
			<input type="reset" class="boton" value="Limpiar" class="limpiar_concurso" />
		</form>

		<?php 

			if (isset($_POST['nombre_concurso'])) {
				$insert="insert into concurso values(null,'".$_POST["nombre_concurso"]."')";
				mysqli_query($con, $insert);
				header("Location: crearConcurso.php");
			} 
			

		?>
		<!-- inside -->
		</div>
		<!-- info  -->
		</div>
	<!-- Content -->
	</div>
	<?php include "footer.php" ?>
</body>
</html>
