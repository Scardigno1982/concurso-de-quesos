	<div id="inside">	
	<?php
		$actual = $_SERVER['REQUEST_URI'];
		echo "<br />";
		echo "<br />";
		//TRAER MESAS DEL UNICO CONCURSO ABIERTO
		$query3 = "select m.nombre_mesa, m.id_mesa from concurso c 
			inner join mesa m on (c.id_concurso = m.id_concurso_mesa)
			where c.estado_concurso = 'Abierto'";
		$mesas = mysqli_query($con,$query3);

		echo "<h2>CONCURSO</h2>";

		echo "<table class='data' id='asigna'>";
		echo "<tr>";
		echo "<th>Mesas del Concurso <span class='informacion'>(Click para agregar Queso/Jurado en Mesa)</span></th>";
		echo "</tr>";	
		while ($mesa = mysqli_fetch_array($mesas)){
			$mes = $mesa['nombre_mesa'];
			$id_mes = $mesa['id_mesa'];
			//PARA CONTAR NUMERO DE QUESOS EN MESA
			$quesos_en_mesa = mysqli_query($con,"select q.id_queso,q.codigo_queso, t.descripcion_tipo from puntaje p
									inner join mesa m on (p.id_mesa = m.id_mesa)
									inner join queso q on (q.id_queso = p.id_queso)
									inner join tipo t on (q.id_tipo_queso = t.id_tipo)
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									and m.id_mesa =$id_mes
									group by q.codigo_queso");

			$cantidad_quesos = mysqli_num_rows($quesos_en_mesa);
			
			echo "<tr>";
			echo "<td><a href='configuring.php?id_m=$id_mes&n_m=$mes'>$mes ($cantidad_quesos Quesos)</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br />";
		echo "<br />";
	
		if (isset($_GET['id_m'])) {
			$id_m = $_GET['id_m'];
			$n_m = $_GET['n_m'];

			echo "<h2>Configurar Mesa $n_m</h2>";

						
			//TENGO QUE VER SI ESA MESA YA TIENE ASIGNADO JURADOS Y QUESOS. DE SER ASI NO PUEDE MODIFICAR NADA.
			echo "<br />";
			echo "<br />";
			echo "<button class='boton-crear2' onclick='abrir($id_m)' id='bct'>Modificar orden de Jura (Jurados)</a></button>";
			echo "<button class='boton-crear2' onclick='abrir2($id_m)' id='bct'>Modificar orden de Jura (Quesos)</a></button>";
			echo "<br />";
			echo "<br />";
			$verificar = "select * from puntaje where id_mesa=$id_m";
			$ver = mysqli_query($con,$verificar);
			if(mysqli_num_rows($ver) > 0) {
				//TIENE ASIGNADOS JURADOS Y MESAS
				$quesos_mesa_modif = mysqli_query($con,"select q.codigo_queso,q.id_queso, t.descripcion_tipo from puntaje p
									inner join mesa m on (p.id_mesa = m.id_mesa)
									inner join queso q on (q.id_queso = p.id_queso)
									inner join tipo t on (q.id_tipo_queso = t.id_tipo)
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									and m.id_mesa =$id_m
									group by q.codigo_queso
									order by orden_jura_queso");
				$jurados_mesa_modif = mysqli_query($con,"select j.nombre_jurado, j.id_jurado from puntaje p
									inner join mesa m on (p.id_mesa = m.id_mesa)
									inner join jurado j on (j.id_jurado = p.id_jurado)
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									and m.id_mesa =$id_m
									and p.id_jurado <> 1
									group by j.id_jurado
									order by orden_jura_jurado");

				echo "<table class='data'>";
				echo "<th colspan=2>Jurados en $n_m <span class='informacion'>(Click para Eliminar Jurado de Mesa)</span></th>";

				if(mysqli_num_rows($jurados_mesa_modif) > 0){
					
					while ($jmm = mysqli_fetch_array($jurados_mesa_modif)){
						$idjm = $jmm['id_jurado']; 
						$njm = $jmm['nombre_jurado'];
						$mensaje = "Esta usted seguro?";
						echo "<tr>";
						echo "<td>";
						echo "<a href='#' onclick='borrarj($idjm,$id_m)'>$njm</a>";
						echo "</td>";
						echo "</tr>";
					}
				}
					
				
				echo "</table>";
				echo "<br />";
				echo "<br />";
				echo "<br />";

				echo "<table class='data'>";
				echo "<th colspan=2>Quesos en $n_m <span class='informacion'>(Click para eliminar queso de Mesa)</span></th>";

				if(mysqli_num_rows($quesos_mesa_modif) > 0){
					while ($qmm = mysqli_fetch_array($quesos_mesa_modif)){
						$idqm = $qmm['id_queso']; 
						$nqm = $qmm['codigo_queso']." - ".$qmm['descripcion_tipo'];
						echo "<tr>";
						echo "<td>";
						echo "<a href='#' onclick='borrarq($idqm,$id_m)'>$nqm</a>";						
						echo "</td>";
						echo "<tr>";
					}
					echo "</table>";
				}

				//Botones para agregar nuevo Jurado o Queso

				//TODOS LOS JURADOS DISPONIBLES
				$jdmm = mysqli_query($con,"select * from jurado j
											inner join usuario u  on (u.id_usuario = j.id_usuario)
											where u.is_admin_usuario = 0
											and id_jurado not in
											(SELECT j.id_jurado FROM puntaje p
					                        inner join mesa m on (p.id_mesa = m.id_mesa)
					                        inner join jurado j on (p.id_jurado = j.id_jurado)
											inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
											where c.estado_concurso= 'Abierto')");

				$qdmm = mysqli_query($con,"select q.*, t.descripcion_tipo from queso q 
								inner join tipo t on (q.id_tipo_queso = t.id_tipo)
								where id_queso not in
		                        (SELECT q.id_queso FROM puntaje p
		                        inner join mesa m on (p.id_mesa = m.id_mesa)
		                        inner join queso q on (p.id_queso = q.id_queso)
								inner join tipo t on (t.id_tipo = q.id_tipo_queso)
								inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
		                        where c.estado_concurso = 'Abierto')");
				echo "<br />";
				echo "<br />";
				echo "<br />";

				echo "<form action='agregarJuradoMesa.php' method='post'>";
				echo "<input type='hidden' name='id_m' value='$id_m' />";
				echo "<select name='jma'>";
				while ($jdm = mysqli_fetch_array($jdmm)){
					$njmm = $jdm['nombre_jurado'];
					$idjmm = $jdm['id_jurado'];
					echo "<option value='$idjmm'>";
					echo $njmm;
					echo "</option>";
				}
				echo "</select>";
				echo "<input type='submit' value='Agregar Jurado'/>";
				echo "</form>";

				echo "<br />";
				echo "<br />";

				echo "<form action='agregarQuesoMesa.php' method='post'>";
				echo "<input type='hidden' name='id_m' value='$id_m' />";
				echo "<select name='qma'>";
				while ($qdm = mysqli_fetch_array($qdmm)){
					$nqmm = $qdm['codigo_queso']." - ".$qdm['descripcion_tipo'];
					$idqmm = $qdm['id_queso'];
					echo "<option value='$idqmm'>";
					echo $nqmm;
					echo "</option>";
				}
				echo "</select>";
				echo "<input type='submit' value='Agregar Queso'/>";
				echo "</form>";
				

				echo "<br />";
				echo "<br />";
				echo "<br />";
			}
			elseif (mysqli_num_rows($ver) == 0){
					echo "<h1>".$_GET['n_m']."</h1>";	
					echo "<br />";
				//ONE
				echo "<div id='one' class='pasarela'>";  //DIV ONE
				echo "<form action='insertComplete.php' method='post' id='formulario'>";

				echo "<input type='hidden' id='post_mesa' name='post_mesa' value='$n_m' />"; //LE PASO EL ID DE LA MESA
				echo "<input type='hidden' id='post_mesa' name='post_id_mesa' value='$id_m' />"; //LE PASO EL ID DE LA MESA
				
				//JURADOS DISPONIBLES
				$query5 = "select * from jurado j
											inner join usuario u  on (u.id_usuario = j.id_usuario)
											where u.is_admin_usuario = 0
											and id_jurado not in
											(SELECT j.id_jurado FROM puntaje p
					                        inner join mesa m on (p.id_mesa = m.id_mesa)
					                        inner join jurado j on (p.id_jurado = j.id_jurado)
											inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
											where c.estado_concurso= 'Abierto')";
				//ESTO ES VIEJO, ACA DEJABA AGREGAR ADMINS COMO JURADOS
				/*$query5 = "select * from jurado where id_jurado not in
					(SELECT j.id_jurado FROM puntaje p
		                        inner join mesa m on (p.id_mesa = m.id_mesa)
		                        inner join jurado j on (p.id_jurado = j.id_jurado)
					inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
					where c.estado_concurso= 'Abierto')";
			*/
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
		                        where c.estado_concurso = 'Abierto')
								order by q.codigo_queso";
		
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
				echo "<a href='#one' id='anterior-two'>Anterior</a>";
				echo "   -   ";
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
				echo "<a href='#two' id='anterior-three'>Anterior</a>";
				echo "<br />";
				echo "<br />";
				echo "<br />";
				echo "</div>"; //FIN CENTER
					echo "<input type='button' class='boton-crear2' id='valid' value='Finalizar' />";
				echo "</div>";//FIN THREE

				echo "<br />";
				echo "<br />";

		

				echo "</form>"; //FIN FORMULARIO DE CJAS
			}//FIN IF LA MESA NO TENIA ASIGNADO JURADO Y QUESO
		
			}//FIN IF SI SELECCIONO ALGUNA MESA

		
		//////ACA VIENE TODA LA INFO DE MESAS, CON LOS QUESOS Y JURADOS CUANDO NO ELIGIO MESA AUN
		else{
		$mesas = mysqli_query($con,"select m.nombre_mesa, m.id_mesa
									from mesa m 
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									group by m.id_mesa");

		
		//CREO LA TABLA QUE CONTIENE LA INFO
		
		echo "<br />";
		echo "<br />";
		

		if(mysqli_num_rows($mesas) > 0){
			echo "<h2>Todas las mesas</h2>";

			while ($mesa = mysqli_fetch_array($mesas)){
				$nm = $mesa['nombre_mesa'];
				$idm = $mesa['id_mesa'];
				$quesos_mesa = mysqli_query($con,"select q.id_queso,q.codigo_queso, t.descripcion_tipo from puntaje p
									inner join mesa m on (p.id_mesa = m.id_mesa)
									inner join queso q on (q.id_queso = p.id_queso)
									inner join tipo t on (q.id_tipo_queso = t.id_tipo)
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									and m.id_mesa =$idm
									group by q.codigo_queso
									order by orden_jura_queso");

				$jurados_mesa = mysqli_query($con,"select j.nombre_jurado, j.id_jurado from puntaje p
									inner join mesa m on (p.id_mesa = m.id_mesa)
									inner join jurado j on (j.id_jurado = p.id_jurado)
									inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
									where c.estado_concurso = 'Abierto'
									and m.id_mesa =$idm
									and p.id_jurado <> 1
									group by j.id_jurado
									order by orden_jura_jurado");

				$coordinador_mesa = mysqli_query($con,"select m.id_coordinador_mesa from mesa m
														inner join jurado j on (j.id_jurado = m.id_coordinador_mesa)
															where m.id_mesa = $idm");
				if (mysqli_num_rows($coordinador_mesa) > 0){
					$row = mysqli_fetch_row($coordinador_mesa);
					$coordinador = $row[0];
				}
				else
					$coordinador = 'null';


				$i = 0;
				$j = 0;
				$vectorj = null;
				$vectorq = null;
				$vectoridj = null;	
				$vectoridq = null;	
				if(mysqli_num_rows($jurados_mesa) > 0){
					while ($jurado = mysqli_fetch_array($jurados_mesa)){
						$vectorj[$i] = $jurado['nombre_jurado'];
						$vectoridj[$i] = $jurado['id_jurado'];
						$i++;
					}
				}					

				if(mysqli_num_rows($quesos_mesa) > 0){
					while ($queso = mysqli_fetch_array($quesos_mesa)){
							$vectorq[$j] = $queso['codigo_queso']." - ".$queso['descripcion_tipo'];
							$vectoridq[$j] = $queso['id_queso'];
						$j++;
					}
				}
			
				
				echo "<table class='data'>";
				
				echo "<th colspan='2'>$nm</th>";
				echo "<tr>";
				echo "<th>Jurados <span class='informacion'>(Click para establecer Coordinador)</span></th>";
				echo "<th>Quesos <span class='informacion'>(Click para editar Campos de Planilla)</span></th>";
				echo "</tr>";
				$c_vectorj = count($vectorj);
				$c_vectorq = count($vectorq);
				
				if($c_vectorj > $c_vectorq){ //HAY MAS JURADOS QUE QUESOS
					
					for( $k=0; $k < $c_vectorj; $k++ ){
					echo "<tr>";	
					echo "<td>";
					if ($coordinador == $vectoridj[$k]){
						echo $vectorj[$k]." <span class='informacion2'>(Coordinador)</span>";
					}

					else{
						echo "<a href='modificarCoordinador.php?id_m=$idm&id_j=".$vectoridj[$k]."'>";
							echo $vectorj[$k];
						echo "</a>";
					}
					
					echo "</td>";
					echo "<td>";
					if($k < $c_vectorq)
						echo "<a href='verCampos.php?id_mesa=$idm&id_queso=".$vectoridq[$k]."'>".$vectorq[$k]."</a>";
					else
						echo " - ";
					echo "</td>";
					echo "</tr>";
					
					}
				}
				else{ //HAY MAS QUESOS QUE JURADOS
					for( $k=0; $k < $c_vectorq; $k++ ){
						echo "<tr>";	
						echo "<td>";
						if($k < $c_vectorj){
							if ($coordinador == $vectoridj[$k]){
									echo $vectorj[$k]." <span class='informacion2'>(Coordinador)</span>";
							}
							else{
								echo "<a href='modificarCoordinador.php?id_m=$idm&id_j=".$vectoridj[$k]."'>";
									echo $vectorj[$k];
								echo "</a>";
							}
						}
						else
							echo " - ";
						echo "</td>";

						echo "<td>";
						echo "<a href='verCampos.php?id_mesa=$idm&id_queso=".$vectoridq[$k]."'>".$vectorq[$k]."</a>";
						echo "</td>";
						echo "</tr>";
					}	
				}

				echo "</table>";
				echo "<br />";
				echo "<br />";
			}//FIN WHILE HAYA MESA
		}	
	}
	
	?>
	<form> 
	
		<input type='button' onclick='window.print();' value='Imprimir' />
		

	</form> 
	<!-- inside -->
	</div>
