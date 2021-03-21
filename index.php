<?php
        session_start();
        if(!isset($_SESSION['id_jurado']))
        header("Location: login.php");
?>

<html>
<head>
	<title> Concurso </title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<?php include "conexiones.php" ?>
	
	<div id="header"> 
		<img src="images/header.gif" id="banner" />
	</div>

	<div id="content">
		<?php
		//CHEQUEO SI EL JURADO TIENE MESA ASIGNADA
		$cons = "select distinct p.id_mesa 'id_mesa', m.nombre_mesa 'nombre_mesa', m.id_coordinador_mesa 'coord', c.estado_concurso
                             from puntaje p
                             inner join mesa m on (p.id_mesa = m.id_mesa)
                             inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
                             where p.id_jurado=".$_SESSION['id_jurado'].
                             " and c.estado_concurso = 'Abierto'";
		$mesa = mysqli_query($con,$cons);
		$filas = mysqli_num_rows($mesa);
		if($filas == 0){
                        exit("USTED NO TIENE MESA ASIGNADA");
                }
                else{
			while($rowm = mysqli_fetch_array($mesa)){;
                        	//SI NO ES COORDINADOR
	                        if ( $rowm['coord'] != $_SESSION['id_jurado'] ){
        	                        exit ("USTED NO ES COORDINADOR");
                	        }
			}
                        
                } 

		$result = mysqli_query($con,"SELECT nombre_concurso, estado_concurso FROM concurso where estado_concurso='Abierto'");
		echo "<h2>";
		while($row = mysqli_fetch_array($result)) {
		echo "Concurso: ".$row ['nombre_concurso'];
		}

		echo "<br/>";

		
		$coordinador = mysqli_query($con,"SELECT nombre_jurado, id_jurado FROM jurado where id_jurado=".$_SESSION['id_jurado']);
		while($row = mysqli_fetch_array($coordinador)) {
		echo "Coordinador: ".$row ['nombre_jurado'];
		}

			$mesa = mysqli_query($con,$cons);
			while($rowm2 = mysqli_fetch_array($mesa)){
			$id_mesa = $rowm2['id_mesa'];
			echo "<br />";
			echo "Mesa: ".$rowm2['nombre_mesa'];
			echo "</h2>";			
			}
			$quesos = mysqli_query($con,"select q.id_queso 'id', q.codigo_queso, c.descripcion_categoria 'nombre', (ae_1+ae_2+ai_1+ai_2+ai_7) 'pa'
										, (ae_1+ae_2+ai_1+round(((ai_2+ai_3+ai_4+ai_5+ai_6)/5),2)+ai_7) 'par'
										, (flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+flavor_7+flavor_8+flavor_9) 'pf'
										,(textura_1+textura_2+textura_3+textura_4+textura_5+textura_6) 'pt'
										, (ae_1+ae_2+ai_1+ai_2+ai_7+flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+flavor_7+flavor_8+flavor_9
											+textura_1+textura_2+textura_3+textura_4+textura_5+textura_6) 'tm'
										,(ae_1+ae_2+ai_1+round(((ai_2+ai_3+ai_4+ai_5+ai_6)/5),2)+ai_7+flavor_1+flavor_2+flavor_3+flavor_4+flavor_5
											+flavor_6+flavor_7+flavor_8+flavor_9+textura_1+textura_2+textura_3+textura_4+textura_5+textura_6)'tmr'
										 ,c.codigo_categoria 'cc', t.descripcion_tipo 'dt'
										  from queso q
										  inner join puntaje p on q.id_queso = p.id_queso
										  inner join categoria c on c.id_categoria = q.id_categoria_queso
										  inner join tipo t on t.id_tipo = q.id_tipo_queso
										  where p.id_mesa=".$id_mesa."
										  and id_jurado=1".			
										  " group by q.id_queso order by orden_jura_queso");
			//var_dump($result2);
			echo "<div class='central'>";
			echo "<div id='queso-puntaje'>";
			echo "<h3>QUESOS</h3>"; 
			echo "<ul>";
			while($queso = mysqli_fetch_array($quesos)){
				//echo "<li>";
				//echo "<a style='color:#82000A' href='planilla.php?id_queso=".$queso['id']."'>".$queso['nombre']." - ".$queso['codigo_queso']."</a>";
				//echo "<input type='button' value='Crear' class='crear_planilla' onclick =\"location='crearPlanilla.php?id_queso=".$queso['id']."'\"/>";
				//echo "</li>";
					if ($queso['nombre'] == 'PASTA SEMIDURA CON OJOS'){
						$tmr= $queso['tmr'];
					}	
					else{
						$tm= $queso['tm'];
					}
					
					if ($queso['nombre'] != 'PASTA SEMIDURA CON OJOS'){
						echo "<li><a style='color:#82000A' href='planilla.php?id_queso=".$queso['id']."'>".$queso['cc']." - ".$queso['dt']." - ".$queso['codigo_queso']."</a> - TOTAL: ".$tm." 
						 <input type='button' value='Crear / Modificar' class='crear_planilla' onclick =\"location='crearPlanilla.php?id_queso=".$queso['id']."'\"/> </li> ";
					}
					else{
						echo "<li><a style='color:#82000A' href='planillaDos.php?id_queso=".$queso['id']."'>".$queso['cc']." - ".$queso['dt']." - ".$queso['codigo_queso']."</a> - TOTAL: ".$tmr."	
						<input type='button' value='Crear / Modificar' class='crear_planilla' onclick =\"location='crearPlanillaDos.php?id_queso=".$queso['id']."'\"/> </li>";
					}
								
					/*if ($queso['nombre'] != 'PASTA SEMIDURA CON OJOS'){
						echo "<input type='button' value='Crear / Modificar' class='crear_planilla' onclick =\"location='crearPlanilla.php?id_queso=".$queso['id']."'\"/>";
					}
					else{
						echo "<input type='button' value='Crear / Modificar' class='crear_planilla' onclick =\"location='crearPlanillaDos.php?id_queso=".$queso['id']."'\"/>";
					}*/
					echo "<br />";
					
			}
			echo "</ul>";
			echo "</div>";	
			

			/*$jurados = mysqli_query($con,"select j.id_jurado 'id', j.nombre_jurado 'nombre'
										  from jurado j
										  inner join puntaje p on j.id_jurado = p.id_jurado
										  where p.id_mesa=".$id_mesa.
										  " group by id") or die (mysqli_error($con));
			echo "<div id='jurado-puntaje'>";
				echo "<h3>JURADOS</h3>";
				while($jurado = mysqli_fetch_array($jurados)){
				echo "<ul>";
				if ($jurado[0] == $_SESSION['id_jurado']){
					echo "<li id='listado-jurados'>Planilla Consensuada";
				}	
				else{ 
					echo "<li id='listado-jurados'>".$jurado['nombre'];
				}	
					        echo "<ul>";
					        	$quesos = mysqli_query($con,"select q.id_queso 'id', q.codigo_queso, c.descripcion_categoria 'nombre'
											   ,c.codigo_categoria 'cc', t.descripcion_tipo 'dt'
											  from queso q
											  inner join puntaje p on q.id_queso = p.id_queso
											  inner join categoria c on c.id_categoria = q.id_categoria_queso
											  inner join tipo t on t.id_tipo = q.id_tipo_queso
											  where p.id_mesa=".$id_mesa.
											  " group by q.id_queso");
					        	while($queso = mysqli_fetch_array($quesos)){
					        	echo "<li>";
					        		if ($queso['nombre'] != 'PASTA SEMIDURA CON OJOS'){
					        			echo "<a href='planillaJurado.php?id_jurado=".$jurado['id']."&id_queso=".$queso['id']."'> Planilla ".$queso['cc']." - ".$queso['dt']." - ".$queso['codigo_queso']."</a>";	
					        		}
					        		else {
					        			echo "<a href='planillaJuradoDos.php?id_jurado=".$jurado['id']."&id_queso=".$queso['id']."'> Planilla ".$queso['cc']." - ".$queso['dt']." - ".$queso['codigo_queso']."</a>";		
					        		}
					        		//echo "<input type='button' value='Crear' class='crear_planilla' onclick =\"location='crearPlanilla.php?id_jurado=".$jurado['id']."&id_queso=".$queso['id']."'\"/>";
					        	echo "</li>";  
					        	//echo "<br />";
					        	}	
					        echo "</ul>";
					echo "<br />";
					echo "</li>";
				echo "</ul>";
				}
				
			echo "</div>";*/
		?>
		</div> <!-- FIN DIV CENTRAR -->
	</div>

			
	<?php include "footer.php" ?>
</body>
</html>