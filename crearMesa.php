<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
?>

<html>
<head>
	<title> Crear Mesas </title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">    
        <link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- SCRIPTS -->
	<script type="text/javascript" src="js/jquery-2.1.1.min.js" defer></script>
	<script type="text/javascript" src="js/main.js" defer></script>
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
			$mesas = mysqli_query($con,"select m.id_mesa, m.nombre_mesa, c.nombre_concurso from mesa m, concurso c where m.id_concurso_mesa =    							c.id_concurso order by c.nombre_concurso");
			echo "<span class='titular'>Mesas existentes</span>";
			echo "<br />";
			echo "<br />";
			echo "<table>";
			echo "<th>";
			echo "Mesa";
			echo "</th>";
			echo "<th>";
			echo "Concurso";
			echo "</th>";
			while($mesa = mysqli_fetch_array($mesas)){
			echo "<tr>";
                        echo "<td>";
                        echo "<a href='editarMesa.php?id_m=".$mesa['id_mesa']."&n_m=".$mesa['nombre_mesa']."'>".$mesa['nombre_mesa']."<a/>";
                        echo "</td>";
			echo "<td>";
			echo $mesa['nombre_concurso'];
                        echo "</td>";
                        echo "</tr>";
			echo "</li>";
			}
			echo "</table>";
			echo "<br />";
			echo "<br />";
			
			$consulta = mysqli_query($con, "select * from concurso where estado_concurso='Abierto'");

			if($consulta != null){
			echo "<span class='titular'>Crear Mesa</span>";
			echo "<br />";
			echo "<br />";
			echo "<form id='form-cc' action='createMesa.php' method='post'>";
				echo "<fieldset class='inputs'>";
				echo "<label for='n_m_cm'> Nombre Mesa </label>";
				echo "<input type='text' id='crear_nombre_mesa' name='n_m_cm' required autofocus/>";
				echo "<select name='id_c_cm'>";
				while ($conc_abierto = mysqli_fetch_array($consulta)){
					$c_n = $conc_abierto['nombre_concurso'];
					$id_c = $conc_abierto['id_concurso'];
					echo "<option value='$id_c'>$c_n</option>";
				}
				echo "</select>";
				echo "</fieldset>";
				echo "<br />";
				echo "<input type='submit' value='Aceptar' class='boton' />";
			echo "</form>";	
			
			}
			else {
				echo "<span class='titular'> No Hay Concurso abierto</span>";
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
