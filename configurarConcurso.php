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
	<?php include "funciones.php" ?>
	
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
				echo "<a href='configurarConcurso.php?id_c=".$concurso['id_concurso']."'>".$concurso['nombre_concurso']."</a>";
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
		$consulta = "select c.id_concurso, m.id_mesa,q.id_queso,j.id_jurado, c.nombre_concurso, m.nombre_mesa, q.nombre_queso, j.nombre_jurado from concurso c inner join mesa m on (c.id_concurso = m.id_concurso_mesa) left join puntaje p on (p.id_mesa = m.id_mesa) left join jurado j on (p.id_jurado = j.id_jurado) left join queso q on (q.id_queso = p.id_queso) where id_concurso='$id_c'";
		$result = mysqli_query($con,$consulta);
		$datos_concurso = mysqli_fetch_array($result) or die (mysqli_error($con));
		echo "<span class='titular'>Configurar Concurso:</span>";
		echo "<br />";
		echo "<br />";
		echo "<form action='configConcurso.php' method='POST' id='form-cc'>";
			echo "<fieldset class='inputs'>";

			echo "<select name='id_m_cfm'>";
			$mesas = traerMesas();
			while($mesa = mysqli_fetch_array($mesas)){
				echo "<option value='".$mesa['id_mesa']."'>".$mesa['nombre_mesa']."</option>";
			}
			echo "</select>";

			echo "</fieldset>";
			echo "<br />";

			echo "<input type='submit' class='boton' value='Guardar' class='guardar_concurso' />";
			echo "<input type='reset' class='boton' value='Limpiar' class='limpiar_concurso' />";
		echo "</form>";

		
			
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
