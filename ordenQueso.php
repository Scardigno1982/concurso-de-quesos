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
		
		
		
		$quesos_mesa_modif = mysqli_query($con,"select q.codigo_queso,q.id_queso, t.descripcion_tipo, orden_jura_queso as orden from puntaje p
									inner join mesa m on (p.id_mesa = m.id_mesa)
									inner join queso q on (q.id_queso = p.id_queso)
									inner join tipo t on (q.id_tipo_queso = t.id_tipo)
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									and m.id_mesa =$id_m
									group by q.codigo_queso");

				echo "<table class='data'>";
				echo "<th>Quesos</th>";
				echo "<th>Orden Jura</th>";

				$cantidad_quesos = mysqli_num_rows($quesos_mesa_modif);
				echo "<input type='hidden' value='$id_m' name='idm'/>";
				echo "<input type='hidden' value='$cantidad_quesos' name='cq'/>";

				if(mysqli_num_rows($quesos_mesa_modif) > 0){
					
					$aux = 1;
					while ($qmm = mysqli_fetch_array($quesos_mesa_modif)){
						$idqm = $qmm['id_queso']; 
						$nqm = $qmm['descripcion_tipo'];
						$cqm = $qmm['codigo_queso'];
						$orden = $qmm['orden'];
						echo "<input type='hidden' value='$idqm' name='idq$aux' />";
						echo "<tr>";
						echo "<td>";
						echo "$cqm - $nqm";
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
			
			$cantidad = $_POST['cq'];
			$idm = $_POST['idm'];
			for ($i=1 ; $i<=$cantidad ; $i++){
				$texto='orden'.$i;
				$texto2='idq'.$i;
				$orden = $_POST[$texto];	
				$idq = $_POST[$texto2];	
				
				mysqli_query($con,"update puntaje set orden_jura_queso = $orden 
										where id_mesa = $idm and id_queso=$idq") or die(mysqli_error($con));
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