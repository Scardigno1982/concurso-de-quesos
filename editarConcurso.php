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
				echo "<a href='editarConcurso.php?id_c=".$concurso['id_concurso']."&nom_c=".$concurso['nombre_concurso']."&l_c=".$concurso['lugar_concurso']."&e_c=".$concurso['estado_concurso']."'>".$concurso['nombre_concurso']."</a>";
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
			
		
	if ( isset($_GET['id_c'])){		
		$id_c = $_GET['id_c'];
		$nom_c = $_GET['nom_c'];
		$l_c = $_GET['l_c'];
		$e_c = $_GET['e_c'];
		echo "<span class='titular'>Editar Concurso:</span>
		<br />
		<br />
		<form action='updateConcurso.php' method='POST' id='form-cc'>
			<fieldset class='inputs'>
			<input type='hidden' name='id_c_ec' value=$id_c />
			<label for='nombre_concurso'>Nombre Concurso</label>
			<input type='text' id='nombre_concurso' value='$nom_c' name='n_c_ec' autofocus required/>

			<label for='lugar_concurso'>Lugar: </label>
			<input type='text' id='lugar_concurso' value='$l_c' name='l_c_ec' required/>";
			
			if ($e_c == 'Abierto')
                                                echo "<input type='checkbox' id='editar_estado_concurso' value='$e_c' name='e_c_ec' checked> Abierto";
                                        else
                                                echo "<input type='checkbox' id='editar_estado_concurso' value='$e_c' name='e_c_ec'>Abierto";

			echo "</fieldset>
			<br />

			<input type='submit' class='boton' value='Guardar' class='guardar_concurso' />
			<input type='reset' class='boton' value='Limpiar' class='limpiar_concurso' />
		</form>";

		
			
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
