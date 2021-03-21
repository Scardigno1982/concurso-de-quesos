<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
?>

<html>
<head>
	<title> Crear Jurado </title>
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
			$jurados = mysqli_query($con,"select j.id_jurado, j.nombre_jurado, u.login_usuario, u.is_admin_usuario from jurado j inner join usuario u on (u.id_usuario=j.id_usuario)");
			echo "<span class='titular'>Jurados</span>";
			echo "<br />";
			echo "<br />";
			echo "<table>";
			echo "<th>";
			echo "Id";
			echo "</th>";
			echo "<th>";
			echo "Nombre";
			echo "</th>";
			echo "<th>";
			echo "Usuario";
			echo "</th>";
			echo "<th>";
			echo "Admin";
			echo "</th>";
			while($jurado = mysqli_fetch_array($jurados)){
			echo "<tr>";
			echo "<td>";
			echo $jurado['id_jurado'];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='editarJurado.php?id_j=".$jurado['id_jurado']."&n_j=".$jurado['nombre_jurado']."'>".$jurado['nombre_jurado']."<a/>";
                        echo "</td>";
			echo "<td>";
			echo $jurado['login_usuario'];
                        echo "</td>";
			echo "<td>";
			echo $jurado['is_admin_usuario'];
                        echo "</td>";
                        echo "</tr>";
			echo "</li>";
			}
			echo "</table>";
			echo "<br />";
			echo "<br />";
			
			echo "<span class='titular'>Crear Jurado</span>";
			echo "<br />";
			echo "<br />";
			echo "<form id='form-cc' action='' method='post'>";
				echo "<fieldset class='inputs'>";
				echo "<label for='n_j_cj'> Nombre Jurado </label>";
				echo "<input type='text' id='crear_nombre_mesa' name='n_j_cj' required autofocus/>";
				echo "<label for='n_u_cj'> Usuario </label>";
				echo "<input type='text' id='crear_nombre_mesa' name='n_u_cj' required/>";
				echo "<label for='p_u_cj'> Password </label>";
				echo "<input type='password' id='crear_nombre_mesa' name='p_u_cj' required/>";
				echo "</fieldset>";
				echo "<br />";
				echo "<input type='submit' value='Aceptar' class='boton' />";
			echo "</form>";	
			if (isset($_POST['n_j_cj'])){
				mysqli_query($con, "insert into usuario values(null,'".$_POST['n_u_cj']."',md5('".$_POST['p_u_cj']."'),null,0)");
				$aux = mysqli_insert_id($con);
				mysqli_query($con, "insert into jurado values(null,'".$_POST['n_j_cj']."',".$aux.")");
				header("Location: crearJurado.php");
			}
			

		?>
<!--
		<input type="button" value="Asignar Mesa" class="boton" />
		<input type="button" value="Asignar Jurado" class="boton" />
		<input type="button" value="Asignar Queso" class="boton" />
-->		
		
		<!-- inside -->
                </div>
                <!-- info  -->
                </div>
        <!-- Content -->
        </div>
	<?php include "footer.php" ?>
</body>
</html>
