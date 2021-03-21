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

	<script> 
		function sumarc1() { 
			var n1 = parseFloat(document.consensuada.campo1c.value); 
			var n2 = parseFloat(document.consensuada.campo2c.value); 
			document.consensuada.campo3c.value=n1+n2; 
		} 

		function sumarc2() { 
			var n3 = parseFloat(document.consensuada.campo4c.value); 
			var n4 = parseFloat(document.consensuada.campo5c.value); 
			var n5 = parseFloat(document.consensuada.campo6c.value); 
			var n6 = parseFloat(document.consensuada.campo7c.value); 
			var n7 = parseFloat(document.consensuada.campo8c.value); 
			var n8 = parseFloat(document.consensuada.campo9c.value); 
			var n9 = parseFloat(document.consensuada.campo10c.value); 
			var val= parseFloat((n4+n5+n6+n7+n8)/5);
			var val2= val.toFixed(1);	
			var val3=n3+val2+n9;
			document.consensuada.campo11c.value=n3+val+n9; 
		} 

		function sumarc3() { 
			var n10 = parseFloat(document.consensuada.campo3c.value); 
			var n11 = parseFloat(document.consensuada.campo11c.value); 
			document.consensuada.campo12c.value=n10+n11; 
		} 

		function sumarc4() { 
			var n12 = parseFloat(document.consensuada.campo13c.value); 
			var n13 = parseFloat(document.consensuada.campo14c.value); 
			var n14 = parseFloat(document.consensuada.campo15c.value); 
			var n15 = parseFloat(document.consensuada.campo16c.value); 
			var n16 = parseFloat(document.consensuada.campo17c.value); 
			var n17 = parseFloat(document.consensuada.campo18c.value); 
			var n18 = parseFloat(document.consensuada.campo19c.value); 
			var n19 = parseFloat(document.consensuada.campo20c.value); 
			var n20 = parseFloat(document.consensuada.campo21c.value); 
			document.consensuada.campo22c.value=n12+n13+n14+n15+n16+n17+n18+n19+n20; 
		} 

		function sumarc5() { 
			var n21 = parseFloat(document.consensuada.campo23c.value); 
			var n22 = parseFloat(document.consensuada.campo24c.value); 
			var n23 = parseFloat(document.consensuada.campo25c.value); 
			var n24 = parseFloat(document.consensuada.campo26c.value); 
			var n25 = parseFloat(document.consensuada.campo27c.value); 
			var n26 = parseFloat(document.consensuada.campo28c.value); 
			document.consensuada.campo29c.value=n21+n22+n23+n24+n25+n26;
		} 
		function sumarc6() { 
			var n27 = parseFloat(document.consensuada.campo12c.value); 
			var n28 = parseFloat(document.consensuada.campo22c.value); 
			var n29 = parseFloat(document.consensuada.campo29c.value); 
			document.consensuada.campo30c.value=n27+n28+n29; 
		} 
		function sumar1(aux) {
			n1= parseFloat(document.getElementById("campo1"+aux).value);
			n2= parseFloat(document.getElementById("campo2"+aux).value);
			document.getElementById("campo3"+aux).value=n1+n2; 
		} 

		function sumar2(aux) { 
			var n3 = parseFloat(document.getElementById("campo4"+aux).value); 
			var n4 = parseFloat(document.getElementById("campo5"+aux).value); 
			var n5 = parseFloat(document.getElementById("campo6"+aux).value); 
			var n6 = parseFloat(document.getElementById("campo7"+aux).value); 
			var n7 = parseFloat(document.getElementById("campo8"+aux).value); 
			var n8 = parseFloat(document.getElementById("campo9"+aux).value); 
			var n9 = parseFloat(document.getElementById("campo10"+aux).value); 
			var val= parseFloat((n4+n5+n6+n7+n8)/5);
			var val2= val.toFixed(1);	
			var val3=n3+val2+n9;
			document.getElementById("campo11"+aux).value=n3+val+n9; 
		} 

		function sumar3(aux) { 
			var n10 = parseFloat(document.getElementById("campo3"+aux).value); 
			var n11 = parseFloat(document.getElementById("campo11"+aux).value); 
			document.getElementById("campo12"+aux).value=n10+n11; 
		} 

		function sumar4(aux) { 
			var n12 = parseInt(document.getElementById("campo13"+aux).value); 
			var n13 = parseInt(document.getElementById("campo14"+aux).value); 
			var n14 = parseInt(document.getElementById("campo15"+aux).value); 
			var n15 = parseInt(document.getElementById("campo16"+aux).value); 
			var n16 = parseInt(document.getElementById("campo17"+aux).value); 
			var n17 = parseInt(document.getElementById("campo18"+aux).value); 
			var n18 = parseInt(document.getElementById("campo19"+aux).value); 
			var n19 = parseInt(document.getElementById("campo20"+aux).value); 
			var n20 = parseInt(document.getElementById("campo21"+aux).value); 
			document.getElementById("campo22"+aux).value=n12+n13+n14+n15+n16+n17+n18+n19+n20; 
		} 

		function sumar5(aux) { 
			var n21 = parseFloat(document.getElementById("campo23"+aux).value); 
			var n22 = parseFloat(document.getElementById("campo24"+aux).value); 
			var n23 = parseFloat(document.getElementById("campo25"+aux).value); 
			var n24 = parseFloat(document.getElementById("campo26"+aux).value); 
			var n25 = parseFloat(document.getElementById("campo27"+aux).value); 
			var n26 = parseFloat(document.getElementById("campo28"+aux).value); 
			document.getElementById("campo29"+aux).value=n21+n22+n23+n24+n25+n26;
		} 
		function sumar6(aux) { 
			var n27 = parseFloat(document.getElementById("campo12"+aux).value); 
			var n28 = parseFloat(document.getElementById("campo22"+aux).value); 
			var n29 = parseFloat(document.getElementById("campo29"+aux).value); 
			document.getElementById("campo30"+aux).value=n27+n28+n29; 
		} 
	</script> 

</head>
<body onLoad='sumarc1(); sumarc2(); sumarc3(); sumarc4(); sumarc5(); sumarc6()'>



	<?php include "conexiones.php" ?>
	
	<div id="header"> 

		
		<img src="images/header.gif" id="banner" />
	</div>

	

	<div id="content">

	<!--	<?php 

			//if (isset($_POST['nombre_concurso'])) {
			//	$insert="insert into concurso values(null,'".$_POST["nombre_concurso"]."')";
			//	mysqli_query($con, $insert);
			//	header("Location: admin.php");
			//} 
		?>
	-->	
		<?php
			$concursos = mysqli_query($con,"select nombre_concurso FROM concurso where estado_concurso = 'Abierto'");

			while($concurso = mysqli_fetch_array($concursos)) {
				echo "<h2>Concurso: ".$concurso ['nombre_concurso'];
				echo "<br />";
			}

			
			$coordinador = mysqli_query($con,"SELECT nombre_jurado FROM jurado where id_jurado =".$_SESSION['id_jurado']);
			while($row = mysqli_fetch_array($coordinador)) {
				echo "Coordinador: ".$row ['nombre_jurado'];
				echo "<br />";
			}


			while($row = mysqli_fetch_array($coordinador)) {
				echo "Coordinador: ".$row ['nombre_jurado'];
				echo "<br />";
			}
		
			$result= mysqli_query($con,"select distinct p.id_mesa 'id_mesa', m.nombre_mesa 'nombre_mesa' 
				                        from puntaje p
										inner join mesa m on p.id_mesa = m.id_mesa
										inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
				                        where p.id_jurado=".$_SESSION['id_jurado']."
										and c.estado_concurso = 'Abierto'");
			
			$row = mysqli_fetch_array($result);
			//var_dump($row);
			$id_mesa = $row [0];

			echo "Mesa: ".$row[1]. "</h2>";

			$muestras = mysqli_query($con,"select id_muestra_puntaje
										  from puntaje
										  where id_mesa=".$id_mesa." and id_jurado=".$_SESSION['id_jurado']." 
										  and id_queso=".$_GET['id_queso']);

			$quesos=mysqli_query($con, "select distinct q.id_queso 'id', t.descripcion_tipo 'nombre'
										from queso q
										inner join puntaje p on q.id_queso = p.id_queso
										inner join tipo t on t.id_tipo = q.id_tipo_queso
										where p.id_mesa=".$id_mesa);
			//AGREGO BRUNO EL DISTINC
			$jurados=mysqli_query($con, "select distinct j.id_jurado 'id', j.nombre_jurado 'nombre'
										from jurado j
										inner join puntaje p on j.id_jurado = p.id_jurado
										where p.id_mesa=".$id_mesa);

			


			if(isset($_GET['id_queso'])){
				$quesos= mysqli_query($con,"select t.descripcion_tipo 'tipo queso', q.codigo_queso, 
											c.descripcion_categoria 'cat queso'
											from queso q
											inner join tipo t on t.id_tipo = q.id_tipo_queso
											inner join categoria c on c.id_categoria = q.id_categoria_queso
											where q.id_queso=".$_GET['id_queso']);
			}	
			
			while($muestra = mysqli_fetch_array($muestras)){
			echo "<h5>Codigo Muestra: ".$muestra['id_muestra_puntaje'];
			echo "<br />";


			}


			while($queso = mysqli_fetch_array($quesos)){
			echo "Categoria: ".$queso['cat queso'];
			echo "<br />";	
			echo "Tipo: ".$queso['tipo queso']." - ".$queso['codigo_queso']."</h5>";
			echo "<br />";

			}

	

			
			if(isset($_GET['id_queso'])){
				$id_queso=$_GET['id_queso'];
			
				$campos = mysqli_query($con,"select campo1,campo2,campo3,campo4,campo5,campo6,campo7,campo8,campo9,campo10
											,campo11,campo12,campo13,campo14,campo15,campo16,campo17,campo18,campo19,campo20,campo21,campo22,campo23,campo24
											from puntaje p
											where id_mesa=".$id_mesa." and p.id_queso=".$_GET['id_queso'].  
											" group by id_queso");
				
				
					echo "<table id='tcampos' class='tabla-dani'>";
					while($campo = mysqli_fetch_array($campos)){
						echo "<tr><td>DESCRIPTORES</td></tr>";
						echo "<tr><td>EVALUACION DE APARIENCIA</td></tr>";
						echo "<tr><td>Apariencia Externa</td></tr>";
						//echo "<tr><td> </td></tr>";
						echo "<tr><td>".$campo[0]."</td></tr>";
						echo "<tr><td>".$campo[1]."</td></tr>";
						echo "<tr><td>Apariencia Interna</td></tr>";
						//echo "<tr><td>SUBTOTAL APARIENCIA EXTERNA:</td></tr>";
						//echo "<tr><td>Apariencia Interna - Descriptores</td></tr>";
						echo "<tr><td>".$campo[2]."</td></tr>";
						echo "<tr><td>".$campo[3]."</td></tr>";
						echo "<tr><td>".$campo[4]."</td></tr>";
						echo "<tr><td>".$campo[5]."</td></tr>";
						echo "<tr><td>".$campo[6]."</td></tr>";
						echo "<tr><td>".$campo[7]."</td></tr>";
						echo "<tr><td>".$campo[8]."</td></tr>";
						//echo "<tr><td>SUBTOTAL APARIENCIA INTERNA:</td></tr>";
						//echo "<tr><td>TOTAL APARIENCIA:</td></tr>";
						//echo "<tr><td>Evaluacion Flavor</td></tr>";
						echo "<tr><td>EVALUACION DE FLAVOR</td></tr>";
						echo "<tr><td>".$campo[9]."</td></tr>";
						echo "<tr><td>".$campo[10]."</td></tr>";
						echo "<tr><td>".$campo[11]."</td></tr>";
						echo "<tr><td>".$campo[12]."</td></tr>";
						echo "<tr><td>".$campo[13]."</td></tr>";
						echo "<tr><td>".$campo[14]."</td></tr>";
						echo "<tr><td>".$campo[15]."</td></tr>";
						echo "<tr><td>".$campo[16]."</td></tr>";
						echo "<tr><td>".$campo[17]."</td></tr>";
						//echo "<tr><td>TOTAL FLAVOR</td></tr>";
						//echo "<tr><td>Evaluacion Textura</td></tr>";
						echo "<tr><td>EVALUACION DE TEXTURA</td></tr>";
						echo "<tr><td>".$campo[18]."</td></tr>";
						echo "<tr><td>".$campo[19]."</td></tr>";
						echo "<tr><td>".$campo[20]."</td></tr>";
						echo "<tr><td>".$campo[21]."</td></tr>";
						echo "<tr><td>".$campo[22]."</td></tr>";
						echo "<tr><td>".$campo[23]."</td></tr>";
						//echo "<tr><td>TOTAL TEXTURA</td></tr>";
						//echo "<tr><td>TOTAL MUESTRA</td></tr>";
					}
					echo "</table>";
					
					$punt_consensuada = mysqli_query($con, "select * from puntaje where id_mesa=".$id_mesa." and id_queso=".$_GET['id_queso']." and id_jurado=".$_SESSION['id_jurado']);
					$punt_c=mysqli_fetch_array($punt_consensuada);




					//echo $punt[3];
					echo "<form name='consensuada' action='guarda_datos_planilla_dos.php' method='POST'>";
					echo "<input type='hidden' name='id_mesa' value=$id_mesa />";
					echo "<input type='hidden' name='id_queso' value=$id_queso />";
					echo "<table id='tpuntajes' class='tabla-dani'>";
					echo "<th>Consensuada</th>";
					echo "<th>Observaciones</th>";
					//echo "<tr><td>Escala</td></tr>";
					echo "<tr><td></td><td></td></tr>";
					echo "<tr><td></td><td></td></tr>";
					echo "<tr>
							<td><input type='number' step='0.5' max=5 min=0 id='campo1c' name='campo1c' onChange='sumarc1()' value=".$punt_c[3]."  required /></td>
							<td><input type='text' name='obs1c' value='".$punt_c[51]."' /></td>
						</tr>";	
					echo "<tr>
							<td><input type='number' step='0.5' max=5 min=0 id='campo2c' name='campo2c' onChange='sumarc1()' value=".$punt_c[4]." required /></td>
							<td><input type='text' name='obs2c' value='".$punt_c[52]."' /></td>
						</tr>";
						/*echo "<tr>
								<td><input type='number' step='0.5' max=10 min=0 id='campo3c' name='campo3c' onLoad='sumarc1()' required /></td>
							</tr>";	*/	

					echo "<tr><td></td><td></td></tr>";								

						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo4c' name='campo4c' value=".$punt_c[5]." required /></td>
								<td><input type='text' name='obs3c' value='".$punt_c[53]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo5c' name='campo5c' value=".$punt_c[6]." required /></td>
								<td><input type='text' name='obs4c' value='".$punt_c[54]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo6c' name='campo6c' value=".$punt_c[7]." required /></td>
								<td><input type='text' name='obs5c' value='".$punt_c[55]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo7c' name='campo7c' value=".$punt_c[8]." required /></td>
								<td><input type='text' name='obs6c' value='".$punt_c[56]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo8c' name='campo8c' value=".$punt_c[9]." required /></td>
								<td><input type='text' name='obs7c' value='".$punt_c[57]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo9c' name='campo9c' value=".$punt_c[10]." required /></td>
								<td><input type='text' name='obs8c' value='".$punt_c[58]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo10c' name='campo10c' value=".$punt_c[11]." required /></td>
								<td><input type='text' name='obs9c' value='".$punt_c[59]."' /></td>
							</tr>";

						/*echo "<tr>
								<td><input type='number' step='0.1' max=15 min=0 id='campo11c' name='campo11c' onfocus='sumarc2()' required /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.1' max=30 min=0 id='campo12c' name='campo12c' onfocus='sumarc3()' required /></td>
							</tr>";*/

							echo "<tr><td></td><td></td></tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo13c' name='campo13c' value=".$punt_c[12]." required /></td>
								<td><input type='text' name='obs10c' value='".$punt_c[60]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo14c' name='campo14c' value=".$punt_c[13]." required /></td>
								<td><input type='text' name='obs11c' value='".$punt_c[61]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo15c' name='campo15c' value=".$punt_c[14]." required /></td>
								<td><input type='text' name='obs12c' value='".$punt_c[62]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo16c' name='campo16c' value=".$punt_c[15]." required /></td>
								<td><input type='text' name='obs13c' value='".$punt_c[63]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo17c' name='campo17c' value=".$punt_c[16]." required /></td>
								<td><input type='text' name='obs14c' value='".$punt_c[64]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo18c' name='campo18c' value=".$punt_c[17]." required /></td>
								<td><input type='text' name='obs15c' value='".$punt_c[65]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo19c' name='campo19c' value=".$punt_c[18]." required /></td>
								<td><input type='text' name='obs16c' value='".$punt_c[66]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo20c' name='campo20c' value=".$punt_c[19]." required /></td>
								<td><input type='text' name='obs17c' value='".$punt_c[67]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo21c' name='campo21c' value=".$punt_c[20]." required /></td>
								<td><input type='text' name='obs18c' value='".$punt_c[68]."' /></td>
							</tr>";

					/*echo "<tr>
								<td><input type='number' step='0.5' max=45 min=0 id='campo22c' name='campo22c' onfocus='sumarc4()' required /></td>
							</tr>";*/

							echo "<tr><td></td><td></td></tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo23c' name='campo23c' value=".$punt_c[21]." required /></td>
								<td><input type='text' name='obs19c' value='".$punt_c[69]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo24c' name='campo24c' value=".$punt_c[22]." required /></td>
								<td><input type='text' name='obs20c' value='".$punt_c[70]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo25c' name='campo25c' value=".$punt_c[23]." required /></td>
								<td><input type='text' name='obs21c' value='".$punt_c[71]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo26c' name='campo26c' value=".$punt_c[24]." required /></td>
								<td><input type='text' name='obs22c' value='".$punt_c[72]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo27c' name='campo27c' value=".$punt_c[25]." required /></td>
								<td><input type='text' name='obs23c' value='".$punt_c[73]."' /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo28c' name='campo28c' value=".$punt_c[26]." required /></td>
								<td><input type='text' name='obs24c' value='".$punt_c[74]."' /></td>
							</tr>";
						/*echo "<tr>
								<td><input type='number' step='0.5' max=30 min=0 id='campo29c' name='campo29c' onfocus='sumarc5()' required /></td>
							</tr>";
						echo "<tr>
								<td><input type='number' step='0.1' max=200 min=0 id='campo30c' name='campo30c' onfocus='sumarc6()' required /></td>
							</tr>";*/
					 echo "</table>";	


					$aux = 0;
					$jurados=mysqli_query($con, "select distinct j.id_jurado 'id', j.nombre_jurado 'nombre'
										from jurado j
										inner join puntaje p on j.id_jurado = p.id_jurado
										where p.id_mesa=".$id_mesa);
					
					while($jurado = mysqli_fetch_array($jurados)){
						if ($jurado[0] != $_SESSION['id_jurado']){
							echo "<table id='tpuntajes' class='tabla-dani'>";
							$punt_jurado = mysqli_query($con, "select * from puntaje where id_mesa=".$id_mesa." and id_queso=".$_GET['id_queso']." and id_jurado=".$jurado[0]);
							$punt_j=mysqli_fetch_array($punt_jurado);
							$aux++;
							echo "<tr>";
								echo "<th>".$jurado[1]."</th>";
							echo "</tr>";
							//echo "<tr><td>Escala</td></tr>";
							echo "<tr><td></td></tr>";
							echo "<tr><td></td></tr>";
							echo "<tr>
									<td><input type='number' step='0.5' max=5 min=0 id='campo1".$aux."' name='campo1".$aux."' value=".$punt_j[3]."  required autofocus /></td>
								</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo2".$aux."' name='campo2".$aux."' value=".$punt_j[4]."  required /></td>
							</tr>";
							echo "<tr><td></td></tr>";
							/*echo "<tr><td><input type='number' step='0.5' max=10 min=0 id='campo3".$aux."' name='campo3".$aux."' onfocus='sumar1(".$aux.")'  /></td></tr>";*/
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo4".$aux."' name='campo4".$aux."' value=".$punt_j[5]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo5".$aux."' name='campo5".$aux."' value=".$punt_j[6]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo6".$aux."' name='campo6".$aux."' value=".$punt_j[7]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo7".$aux."' name='campo7".$aux."' value=".$punt_j[8]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo8".$aux."' name='campo8".$aux."' value=".$punt_j[9]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo9".$aux."' name='campo9".$aux."' value=".$punt_j[10]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo10".$aux."' name='campo10".$aux."' value=".$punt_j[11]." required /></td>
							</tr>";
							/*echo "<tr><td><input type='number' step='0.5' max=15 min=0 id='campo11".$aux."' name='campo11".$aux."' value='0' onfocus='sumar2(".$aux.")'  /></td></tr>";
							echo "<tr><td><input type='number' step='0.5' max=30 min=0 id='campo12".$aux."' name='campo12".$aux."' value='0' onfocus='sumar3(".$aux.")'  /></td></tr>";*/
							echo "<tr><td></td></tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo13".$aux."' name='campo13".$aux."' value=".$punt_j[12]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo14".$aux."' name='campo14".$aux."' value=".$punt_j[13]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo15".$aux."' name='campo15".$aux."' value=".$punt_j[14]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo16".$aux."' name='campo16".$aux."' value=".$punt_j[15]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo17".$aux."' name='campo17".$aux."' value=".$punt_j[16]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo18".$aux."' name='campo18".$aux."' value=".$punt_j[17]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo19".$aux."' name='campo19".$aux."' value=".$punt_j[18]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo20".$aux."' name='campo20".$aux."' value=".$punt_j[19]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo21".$aux."' name='campo21".$aux."' value=".$punt_j[20]." required /></td>
							</tr>";
							echo "<tr><td></td></tr>";
							//*echo "<tr><td><input type='number' step='0.5' max=45 min=0 id='campo22".$aux."' name='campo22".$aux."' value='0' onfocus='sumar4(".$aux.")'  /></td></tr>";*/
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo23".$aux."' name='campo23".$aux."' value=".$punt_j[21]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo24".$aux."' name='campo24".$aux."' value=".$punt_j[22]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo25".$aux."' name='campo25".$aux."' value=".$punt_j[23]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo26".$aux."' name='campo26".$aux."' value=".$punt_j[24]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo27".$aux."' name='campo27".$aux."' value=".$punt_j[25]." required /></td>
							</tr>";
							echo "<tr>
								<td><input type='number' step='0.5' max=5 min=0 id='campo28".$aux."' name='campo28".$aux."' value=".$punt_j[26]." required /></td>
							</tr>";
							/*echo "<tr><td><input type='number' step='0.5' max=30 min=0 id='campo29".$aux."' name='campo29".$aux."' value='0' onfocus='sumar5(".$aux.")'  /></td></tr>";
							echo "<tr><td><input type='number' step='0.5' max=200 min=0 id='campo30".$aux."' name='campo30".$aux."' value='0' onfocus='sumar6(".$aux.")'  /></td></tr>";*/
							echo "</table>";	
						}//Cierra IF de si no es el coordinador
					} //cierra while
					echo "<div class='botones-abajo'>";
						echo "<input type='submit' value='Guardar' class='guardar_planilla' />";
					?>
					<input type='button' onclick='window.location="index.php"' value='Volver' />
					<?php
					echo "</div>";
		    		echo "</form>";
			} //cierra if

		    //echo $id_queso;
		?>
	</div>
		<?php include "footer.php" ?>

</body>
</html>
