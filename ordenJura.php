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

	if(isset($_GET['id_m'])){
		include "conexiones.php";
		echo "<div id='inside'>";
			echo "<div id='peque'>";
		echo "<form action='' method='post'>";
		$id_m = $_GET['id_m'];
		
		
		
		$jurados_mesa_modif = mysqli_query($con,"select j.nombre_jurado, j.id_jurado,p.orden_jura_jurado as orden from puntaje p
									inner join mesa m on (p.id_mesa = m.id_mesa)
									inner join jurado j on (j.id_jurado = p.id_jurado)
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									and m.id_mesa =$id_m
									and p.id_jurado <> 1
									group by j.id_jurado");

				echo "<table class='data'>";
				echo "<th>Jurados</th>";
				echo "<th>Orden Jura</th>";

				$cantidad_jurados = mysqli_num_rows($jurados_mesa_modif);
				echo "<input type='hidden' value='$id_m' name='idm'/>";
				echo "<input type='hidden' value='$cantidad_jurados' name='cj'/>";

				if(mysqli_num_rows($jurados_mesa_modif) > 0){
					
					$aux = 1;
					while ($jmm = mysqli_fetch_array($jurados_mesa_modif)){
						$idjm = $jmm['id_jurado']; 
						$njm = $jmm['nombre_jurado'];
						$orden = $jmm['orden'];
						echo "<input type='hidden' value='$idjm' name='idj$aux' />";
						echo "<tr>";
						echo "<td>";
						echo "$njm";
						echo "</td>";
						echo "<td>";
						echo "<input type='number' value='$orden' name='orden$aux' required/>";
						echo "</td>";
						echo "</tr>";
						$aux++;
					}
					
				}
				echo "</table>";
		echo "<br />";
		echo "<br />";
		echo "<input type='submit' value='Aceptar' />";
		echo "</form>";



		//SI YA SELECCIONO UN NUEVO CAMPO

		if(isset($_POST['idm'])){
			
			$cantidad = $_POST['cj'];
			$idm = $_POST['idm'];
			for ($i=1 ; $i<=$cantidad ; $i++){
				$texto='orden'.$i;
				$texto2='idj'.$i;
				$orden = $_POST[$texto];	
				$idj = $_POST[$texto2];	
				
				mysqli_query($con,"update puntaje set orden_jura_jurado = $orden 
										where id_mesa = $idm and id_jurado=$idj") or die(mysqli_error($con));
			}
			
			echo "<script>";
			echo "window.self.close()";
			echo "</script>";
		}
		echo "</div>";
		echo "</div>";
	}
	?>

</body>