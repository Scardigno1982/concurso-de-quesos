	<div id="inside">	
	<?php
		include "conexiones.php";
		$actual = $_SERVER['REQUEST_URI'];
		echo "<br />";
		echo "<br />";
		//TRAER MESAS DEL UNICO CONCURSO ABIERTO
		$query3 = "select nombre_concurso, id_concurso, estado_concurso from concurso";
		$concursos = mysqli_query($con,$query3);

		echo "<table class='data' id='asigna'>";
		echo "<tr>";
		echo "<th>Concursos</th>";
		echo "</tr>";	
		while ($concurso = mysqli_fetch_array($concursos)){
			$conc = $concurso['nombre_concurso'];
			$id_conc = $concurso['id_concurso'];
			echo "<tr>";
			echo "<td><a href='estadistics.php?id_c=$id_conc&n_c=$conc'>$conc</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br />";
		echo "<br />";

		if( isset($_GET['id_c']){
			$id_c = $_GET['id_c'];
			$query_mesas = "select m.nombre_mesa, m.id_mesa from concurso c 
                        inner join mesa m on (c.id_concurso = m.id_concurso_mesa)
                        where c.id_concurso = $id_c";
                $mesas = mysqli_query($con,$query_mesas);

                echo "<h3>Mesas del Concurso</h3>";
                while ($mesa = mysqli_fetch_array($mesas)){
                        $mes = $mesa['nombre_mesa'];
                        $id_mes = $mesa['id_mesa'];
                        echo "<button><a href='estadistics.php?id_m=$id_mes&n_m=$mes'>$mes</a></button>";
                }
                echo "<br />";
                echo "<br />";
			echo "<button><a href='$actual&id_m=$id_m'></a></button>";
		}
	
	?>
	<!-- inside -->
	</div>
