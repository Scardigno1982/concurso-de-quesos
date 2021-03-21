<?php
        session_start();
        if (!isset($_SESSION['login']))
                header("Location: login.php");
?>

<html>
<head>
	<title> Planilla </title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print" />
</head>
<body>

	<?php include "conexiones.php" ?>
	
	<div id="header"> 
		<img src="images/header.gif" id="banner" />
	</div>


	<div id="content">

		<?php
			$result = mysqli_query($con,"SELECT nombre_concurso FROM concurso where estado_concurso = 'Abierto'");

			while($row = mysqli_fetch_array($result)) {
			echo "<h2>Concurso ".$row ['nombre_concurso'];
			}

			echo "<br/>";

			$coordinador = mysqli_query($con,"SELECT nombre_jurado FROM jurado where id_jurado =".$_SESSION['id_jurado']);
			while($row = mysqli_fetch_array($coordinador)) {
			echo "Coordinador: ".$row ['nombre_jurado'];
			echo "<br/>";
			}
		?>
		<?php
			
			$result= mysqli_query($con,"select distinct p.id_mesa 'id_mesa', m.nombre_mesa 'nombre_mesa' 
				                        from puntaje p
										inner join mesa m on p.id_mesa = m.id_mesa
										inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
				                        where p.id_jurado=".$_SESSION['id_jurado']."
										and c.estado_concurso = 'Abierto'"); 
			
			$row = mysqli_fetch_array($result);
			//var_dump($row);
			$id_mesa = $row [0];

			echo "Mesa: ".$row[1]."</h2>";

			$quesos=mysqli_query($con, "select distinct q.id_queso 'id', t.descripcion_tipo 'nombre', q.codigo_queso
										from queso q
										inner join puntaje p on q.id_queso = p.id_queso
										inner join tipo t on t.id_tipo = q.id_tipo_queso
										where p.id_mesa=".$id_mesa);
			$jurados=mysqli_query($con, "select distinct j.id_jurado 'id', j.nombre_jurado 'nombre'
										from jurado j
										inner join puntaje p on j.id_jurado = p.id_jurado
										where p.id_mesa=".$id_mesa);

			$muestras = mysqli_query($con,"select id_muestra_puntaje
										  from puntaje
										  where id_mesa=".$id_mesa." and id_jurado=".$_SESSION['id_jurado']." 
										  and id_queso=".$_GET['id_queso']);

			/*echo "Queso: ";
			echo "<select>";
			while ($queso=mysqli_fetch_array($quesos)) {
				echo "<option value=".$queso['id'].">".$queso['nombre']." - ".$queso['codigo_queso']."</option>";
  			}
  			echo "</select>";

  			echo "<br />";

			echo "Jurado: ";
			echo "<select>";
			while ($jurado=mysqli_fetch_array($jurados)) {
				echo "<option value=".$jurado['id'].">".$jurado['nombre']."</option>";
  			}
  			echo "</select>";
			*/



			/*if(isset($_GET['id_queso'])){
				$quesos= mysqli_query($con,"select t.descripcion_tipo 'queso', q.codigo_queso 
											from queso q
											inner join tipo t on t.id_tipo = q.id_tipo_queso
											where q.id_queso=".$_GET['id_queso']);
			}	
			while($queso = mysqli_fetch_array($quesos)){
			echo "<h5>Queso ".$queso['queso']." - ".$queso['codigo_queso']."</h5>";*/

			if(isset($_GET['id_queso'])){
			$quesos= mysqli_query($con,"select t.descripcion_tipo 'tipo queso', q.codigo_queso, 
											c.descripcion_categoria 'cat queso'
											from queso q
											inner join tipo t on t.id_tipo = q.id_tipo_queso
											inner join categoria c on c.id_categoria = q.id_categoria_queso
											where q.id_queso=".$_GET['id_queso']);
			}	
			
			while($muestra = mysqli_fetch_array($muestras)){
			echo "<h2>Codigo Muestra: ".$muestra['id_muestra_puntaje'];
			echo "<br />";
			}


			while($queso = mysqli_fetch_array($quesos)){
			echo "Categoria: ".$queso['cat queso'];
			echo "<br />";	
			echo "Tipo: ".$queso['tipo queso']." - ".$queso['codigo_queso']."</h2>";
			}				

			
			$sql= "select nombre_jurado,ae_1 'c1', ae_2 'c2',(ae_1+ae_2) as 'STAE',ai_1 'c3', ai_2 'c4', ai_7 'c9'
				  ,(ai_1+ai_2+ai_7) as 'STAI'
				  ,(ae_1+ae_2+ai_1+ai_2+ai_7) 'Total Apariencia'
				  ,flavor_1 'c10',flavor_2 'c11', flavor_3 'c12', flavor_4 'c13', flavor_5 'c14', flavor_6 'c15', flavor_7 'c16'
				  , flavor_8 'c17', flavor_9 'c18'
				  ,(flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+flavor_7+flavor_8+flavor_9)'Total Flavor'
				  ,textura_1 'c19', textura_2 'c20', textura_3 'c21', textura_4 'c22', textura_5 'c23', textura_6 'c24'
				  ,(textura_1+textura_2+textura_3+textura_4+textura_5+textura_6)'Total Textura'
				  ,(ae_1+ae_2+ai_1+ai_2+ai_7+flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+flavor_7+flavor_8+flavor_9
				  	+textura_1+textura_2+textura_3+textura_4+textura_5+textura_6)
					,j.id_jurado
				  from puntaje p 
				  inner join jurado j on (p.id_jurado=j.id_jurado)
				  where p.id_mesa =".$id_mesa." and p.id_queso=".$_GET['id_queso']." order by orden_jura_jurado";	  

			//echo "<h3>";	  

			$result2 = mysqli_query($con,$sql);
			
			$campos = mysqli_query($con,"select campo1,campo2,campo3,campo4,campo9,campo10
											,campo11,campo12,campo13,campo14,campo15,campo16,campo17,campo18,campo19,campo20,campo21,campo22,campo23,campo24
											from puntaje p
											where id_mesa=".$id_mesa." and p.id_queso=".$_GET['id_queso'].  
											" group by id_queso");
				
					echo "<table id='tcampos'>";
					while($campo = mysqli_fetch_array($campos)){
						echo "<tr><td><p>DESCRIPTORES</p></td></tr>";
						echo "<tr><td><p>EVALUACION DE APARIENCIA</p></td></tr>";
						echo "<tr><td><p>Apariencia Externa</p></td></tr>";
						echo "<tr><td>".$campo[0]."</td></tr>";
						echo "<tr><td>".$campo[1]."</td></tr>";
						echo "<tr><td><p>Apariencia Interna</p></td></tr>";
						//echo "<tr><td>SUBTOTAL APARIENCIA EXTERNA:</td></tr>";
						echo "<tr><td>".$campo[2]."</td></tr>";
						echo "<tr><td>".$campo[3]."</td></tr>";
						echo "<tr><td>".$campo[4]."</td></tr>";
						//echo "<tr><td>SUBTOTAL APARIENCIA INTERNA:</td></tr>";
						//echo "<tr><td>TOTAL APARIENCIA:</td></tr>";
						echo "<tr><td><p>EVALUACION DE FLAVOR</p></td></tr>";
				     	echo "<tr><td>".$campo[5]."</td></tr>";
						echo "<tr><td>".$campo[6]."</td></tr>";
						echo "<tr><td>".$campo[7]."</td></tr>";
						echo "<tr><td>".$campo[8]."</td></tr>";
						echo "<tr><td>".$campo[9]."</td></tr>";
						echo "<tr><td>".$campo[10]."</td></tr>";
						echo "<tr><td>".$campo[11]."</td></tr>";
						echo "<tr><td>".$campo[12]."</td></tr>";
						echo "<tr><td>".$campo[13]."</td></tr>";
						//echo "<tr><td>TOTAL FLAVOR</td></tr>";
						echo "<tr><td><p>EVALUACION DE TEXTURA</p></td></tr>";
						echo "<tr><td>".$campo[14]."</td></tr>";
						echo "<tr><td>".$campo[15]."</td></tr>";
						echo "<tr><td>".$campo[16]."</td></tr>";
						echo "<tr><td>".$campo[17]."</td></tr>";
						echo "<tr><td>".$campo[18]."</td></tr>";
						echo "<tr><td>".$campo[19]."</td></tr>";
						//echo "<tr><td>TOTAL TEXTURA</td></tr>";
						//echo "<tr><td>TOTAL MUESTRA</td></tr>";
					}
					echo "</table>";

					while($res2 = mysqli_fetch_array($result2)){
					echo "<table id='tpuntajes'>";
						if($res2['id_jurado'] != 1)
							echo "<tr><td>".$res2[0]."</td></tr>";
						else
						echo "<tr><td>Consensuada</td></tr>";
					
						echo "<tr class='tdesp'><td></td></tr>";
						echo "<tr class='tdesp'><td></td></tr>";
						echo "<tr><td>".$res2[1]."</td></tr>";
						echo "<tr><td>".$res2[2]."</td></tr>";
						echo "<tr class='tdesp'><td></td></tr>";
						//echo "<tr><td>".$res2[3]."</td></tr>";
						echo "<tr><td>".$res2[4]."</td></tr>";
						echo "<tr><td>".$res2[5]."</td></tr>";
						echo "<tr><td>".$res2[6]."</td></tr>";
						//echo "<tr><td>".$res2[7]."</td></tr>";
						//echo "<tr><td>".$res2[8]."</td></tr>";
						echo "<tr class='tdesp'><td></td></tr>";
						echo "<tr><td>".$res2[9]."</td></tr>";
						echo "<tr><td>".$res2[10]."</td></tr>";
						echo "<tr><td>".$res2[11]."</td></tr>";
						echo "<tr><td>".$res2[12]."</td></tr>";
						echo "<tr><td>".$res2[13]."</td></tr>";
						echo "<tr><td>".$res2[14]."</td></tr>";
						echo "<tr><td>".$res2[15]."</td></tr>";
						echo "<tr><td>".$res2[16]."</td></tr>";
						echo "<tr><td>".$res2[17]."</td></tr>";
						//echo "<tr><td>".$res2[18]."</td></tr>";
						echo "<tr class='tdesp'><td></td></tr>";
						echo "<tr><td>".$res2[19]."</td></tr>";
						echo "<tr><td>".$res2[20]."</td></tr>";
						echo "<tr><td>".$res2[21]."</td></tr>";
						echo "<tr><td>".$res2[22]."</td></tr>";
						echo "<tr><td>".$res2[23]."</td></tr>";
						echo "<tr><td>".$res2[24]."</td></tr>";
						//echo "<tr><td>".$res2[25]."</td></tr>";
						//echo "<tr><td>".$res2[26]."</td></tr>";
						
					echo "</table>";	
					
					} 
			//echo "</h3>";		
			//while($campo = mysqli_fetch_array($campos)){
			//	echo $campo[1];
			//}	
			//var_dump($campo);
			//print_r($campo);
				
		    
		?>

	</div>

	<form> 
	<div class='botones-abajo'>
		<input type='button' onclick='window.print();' value='Imprimir' />
		<input type='button' onclick='window.location="index.php"' value='Volver' />
	</div>

	</form> 

	<?php include "footer.php" ?>


	
</body>
</html>
