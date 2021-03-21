<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
?>

<html>
<head>
	<title> Editar </title>
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
			$jurados = mysqli_query($con,"select j.id_jurado, j.nombre_jurado, u.login_usuario, u.is_admin_usuario from jurado j inner join 							usuario u on (u.id_usuario=j.id_usuario)");

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
                        echo "<a href='editarJurado.php?id_j=".$jurado['id_jurado']."&n_j=".$jurado['nombre_jurado']."&l_u=".$jurado['login_usuario']."&admin=".$jurado['is_admin_usuario']."'>".$jurado['nombre_jurado']."<a/>";
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
			
			if (isset($_GET['id_j']) && isset($_GET['n_j'])){
                                echo "<span class='titular'>Editar Jurado</span>";
                                echo "<br />";
                                echo "<br />";
				
				if ($_GET['admin'] == 1)
					$is_admin = true;
				else
					$is_admin = false;

                                echo "<form id='form-cc' action='updateJurado.php' method='post'>";
                                        echo "<fieldset class='inputs'>";
                                        echo "<label for='id_j_ej'>ID Jurado </label>";
                                        echo "<input type='text' id='editar_id_mesa' name='id_j_ej' value=".$_GET['id_j']." readonly />";
                                        echo "<label for='n_j_ej'> Nombre Jurado </label>";
                                        echo "<input type='text' id='editar_nombre_mesa' name='n_j_ej' value='".$_GET['n_j']."' required autofocus />";
                                        echo "<label for='l_u_ej'> Usuario </label>";
                                        echo "<input type='text' id='editar_nombre_mesa' name='l_u_ej' value='".$_GET['l_u']."' readonly />";
                                        echo "</fieldset>";
					if ($is_admin)
						echo "<input type='checkbox' id='editar_nombre_mesa' name='admin_ej' checked> Administrador";
					else	
                                        	echo "<input type='checkbox' id='editar_nombre_mesa' name='admin_ej'>Administrador";
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
