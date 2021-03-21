	<div id="inside">	
	<?php
		$actual = $_SERVER['REQUEST_URI'];
		echo "<br />";
		echo "<br />";
		//TRAER MESAS DEL UNICO CONCURSO ABIERTO
		echo "<label for='asigna'>Concurso 1</label>";
		$query3 = "select m.nombre_mesa, m.id_mesa from concurso c 
			inner join mesa m on (c.id_concurso = m.id_concurso_mesa)
			where c.estado_concurso = 'Abierto'";
		$mesas = mysqli_query($con,$query3);

		echo "<table class='data' id='asigna'>";
		echo "<tr>";
		echo "<th>Mesas del Concurso</th>";
		echo "</tr>";	
		while ($mesa = mysqli_fetch_array($mesas)){
			$mes = $mesa['nombre_mesa'];
			$id_mes = $mesa['id_mesa'];
			echo "<tr>";
			echo "<td><a href='configuring.php?id_m=$id_mes&n_m=$mes'>$mes</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br />";
		echo "<br />";
	
		if (isset($_GET['id_m'])) {
			$id_m = $_GET['id_m'];
			$n_m = $_GET['n_m'];
						
			//TENGO QUE VER SI ESA MESA YA TIENE ASIGNADO JURADOS Y QUESOS. DE SER ASI NO PUEDE MODIFICAR NADA.

			$verificar = "select * from puntaje where id_mesa=$id_m";
			$ver = mysqli_query($con,$verificar);
			if(mysqli_num_rows($ver) > 0) {
				echo "<script>";
					echo "alert('Esta mesa ya tiene asignados Jurados y Quesos.');";
					echo "window.location= 'configuring.php';";
				echo "</script>";
			}
			elseif (mysqli_num_rows($ver) == 0){
				echo "<h1>".$_GET['n_m']."</h1>";	
				echo "<br />";
			//ONE
			echo "<div id='one' class='pasarela'>";  //DIV ONE
			echo "<form action='insertComplete.php' method='post' id='formulario'>";
			echo "<input type='hidden' id='post_mesa' name='post_mesa' value='$n_m' />"; //LE PASO EL NOMBRE DE LA MESA
			echo "<input type='hidden' id='post_mesa' name='post_id_mesa' value='$id_m' />"; //LE PASO EL ID DE LA MESA

			//JURADOS DISPONIBLES
			$query5 = "select * from jurado where id_jurado not in
				(SELECT j.id_jurado FROM puntaje p
	                        inner join mesa m on (p.id_mesa = m.id_mesa)
	                        inner join jurado j on (p.id_jurado = j.id_jurado)
				inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
				where c.estado_concurso= 'Abierto')";
		
			$jds = mysqli_query($con,$query5);
			echo "<label for='origen1'>Jurados Disponibles</label>";
			echo "<select name='origen1[]' id='origen1' class='multiple' multiple>";
	                while ($jd = mysqli_fetch_array($jds)){
						$id_jd = $jd['id_jurado'];
	                	echo "<option value='$id_jd'>".$jd['nombre_jurado']."</option>";
	                }
	                echo "</select>";
			echo "<br />";
			echo "<div class='centro'>"; //DIV CENTRO
			echo "<a href='#two' id='button-one'>Siguiente </a>";
			echo "</div>"; //FIN CENTRO
			echo "</div>"; //FIN ONE
			
			/////QUESOS//////
			//QUESOS ASIGNADOS A MESA
			//TWO
			echo "<div id='two' class='pasarela'>"; //DIV TWO
			
			//QUESOS DISPONIBLES
	                $query6 = "select q.*, t.descripcion_tipo from queso q 
				inner join tipo t on (q.id_tipo_queso = t.id_tipo)
				where id_queso not in
	                        (SELECT q.id_queso FROM puntaje p
	                        inner join mesa m on (p.id_mesa = m.id_mesa)
	                        inner join queso q on (p.id_queso = q.id_queso)
				inner join tipo t on (t.id_tipo = q.id_tipo_queso)
				inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
	                        where c.estado_concurso = 'Abierto')";
	
	                $qds = mysqli_query($con,$query6);
			echo "<label for='origen2'>Quesos Disponibles</label>";
        	        echo "<select name='origen2[]' id='origen2' class='multiple' required multiple>";
	                while ($qd = mysqli_fetch_array($qds)){
				$id_qd = $qd['id_queso'];
	                        echo "<option value='$id_qd'>".$qd['codigo_queso']." - ".$qd['descripcion_tipo']."</option>";
	                }
	                echo "</select>";
			echo "<br />";
			echo "<div class='centro'>"; //DIV CENTER
			echo "<a href='#three' id='button-two'>Siguiente</a>";
			echo "</div>"; //FIN CENTER
			echo "</div>"; //FIN TWO

			
			echo "<div id='three' class='pasarela'>";//DIV THREE
			
			echo "<label for='select-coord'>Jurado Coordinador</label>";
			echo "<select id='select-coord' name='coord'>";
	        echo "</select>";
			//GRABAR EN LA DB
			echo "<br />";
			echo "<br />";
			echo "<div class='centro'>"; //DIV CENTER
			//echo "<a href='#four' id='button-three'>Siguiente</a>";
			echo "</div>"; //FIN CENTER
				echo "<input type='button' id='valid' value='Finalizar' />";
				echo "<input type='button' id='restart' value='Reiniciar' />";
			echo "</div>";//FIN THREE

			echo "<br />";
			echo "<br />";

	

			echo "</form>"; //FIN FORMULARIO DE CJAS
		}//FIN IF LA MESA NO TENIA ASIGNADO JURADO Y QUESO
	
		}//FIN IF SI SELECCIONO ALGUNA MESA
	
	?>
	<!-- inside -->
	</div>
