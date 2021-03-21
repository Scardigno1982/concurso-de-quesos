<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
?>

<html>
<head>
	<title> Editar Mesas </title>
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
			$mesas = mysqli_query($con,"select m.id_mesa, m.nombre_mesa, c.nombre_concurso from mesa m, concurso c where m.id_concurso_mesa = c.id_concurso order by c.nombre_concurso,m.id_mesa");
			echo "<span class='titular'>Mesas</span>";
			echo "<br />";
			echo "<br />";
			echo "<table>";
			echo "<th>";
			echo "Mesa";
			echo "</th>";
			echo "<th>";
			echo "Concurso";
			echo "</th>";
			echo "<th>";
			echo "Eliminar";
			echo "</th>";
			while($mesa = mysqli_fetch_array($mesas)){
			echo "<tr>";
                        echo "<td>";
                        echo "<a href='editarMesa.php?id_m=".$mesa['id_mesa']."&n_m=".$mesa['nombre_mesa']."'>".$mesa['nombre_mesa']."<a/>";
                        echo "</td>";
			echo "<td>";
			echo $mesa['nombre_concurso'];
                        echo "</td>";
			echo "<td>";
			echo "<a href='eliminarMesa.php?id_m=".$mesa['id_mesa']."' onclick=\"return confirm('Se borrara la Mesa, Continuar?')\">X</a>";
                        echo "</td>";
                        echo "</tr>";
			echo "</li>";
			}
			echo "</table>";
			echo "<br />";
			echo "<br />";
			
			if (isset($_GET['id_m']) && isset($_GET['n_m'])){
				$get_id_m=$_GET['id_m'];
				$get_n_m=$_GET['n_m'];
				echo "<span class='titular'>Editar Mesa</span>";
				echo "<br />";
				echo "<br />";
				echo "<form id='form-cc' action='updateMesa.php' method='post'>";
					echo "<fieldset class='inputs'>";
					echo "<label for='id_m_em'>ID Mesa </label>";
					echo "<input type='text' id='editar_id_mesa' name='id_m_em' value=".$get_id_m." readonly />";
					echo "<label for='n_m_em'> Nombre Mesa </label>";
					echo "<input type='text' id='editar_nombre_mesa' name='n_m_em' value='".$get_n_m."' required autofocus />";
					echo "</fieldset>";
					echo "<br />";
					echo "<input type='submit' value='Aceptar' class='boton' />";
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
