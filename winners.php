<?php
        session_start();
        if (!isset($_SESSION['login']))
                header("Location: login.php");
?>

<html>
<head>
	<title> Resultados </title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print" />
	<link rel="stylesheet" type="text/css" href="TableFilter/filtergrid.css" media="screen" />
	<script type="text/javascript" src="TableFilter/tablefilter.js"></script>
</head>
<body onLoad='sumarc1(); sumarc2(); sumarc3(); sumarc4(); sumarc5(); sumarc6()'>



	<?php include "conexiones.php" ?>
	
	<div id="header"> 

		
		<img src="images/header.gif" id="banner" />
	</div>

	

	<div id="content">

		<?php
				include "sidebar2.php";
				echo "<br />";
				echo "<br />";
				$concursos = mysqli_query($con,"select * from concurso");
				echo "<table class='data'>";
				echo "<th> Nombre <span class='informacion'>(Click para seleccionar concurso)</span>";
				echo "<th> Lugar";
				echo "<th> Estado";
				//echo "<th> En curso";
				while($concurso = mysqli_fetch_array($concursos)){
					echo "<tr>";
					echo "<td>";
					echo "<a href='winners.php?id_c=".$concurso['id_concurso']."&nom_c=".$concurso['nombre_concurso']."&l_c=".$concurso['lugar_concurso']."&e_c=".$concurso['estado_concurso']."'>".$concurso['nombre_concurso']."</a>";
					echo "</td>";
					echo "<td>";
					echo $concurso['lugar_concurso'];
					echo "</td>";
					echo "<td>";
					echo $concurso['estado_concurso'];
					echo "</td>";
					echo "</tr>";
				}
			echo "</table>";
			if(isset($_GET['id_c'])){
				$id_c = $_GET['id_c'];
				$nom_c = $_GET['nom_c'];
				$l_c = $_GET['l_c'];

				echo " <h2> Resultados Concurso $nom_c</h2>";
								
				
				$sql = "select  e.tipo_empresa, e.nombre_empresa, c.descripcion_categoria,
						ae_1+ae_2+ai_1+ai_2+ai_7+flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+
						flavor_7+flavor_8+flavor_9+textura_1+textura_2+textura_3+textura_4+textura_5+textura_6 as puntaje
						, q.codigo_queso, t.descripcion_tipo, m.nombre_mesa 'Mesa', p.id_jurado 'Jurado',p.id_queso 'Queso', p.id_muestra_puntaje 'Muestra'
						, q.id_categoria_queso, q.id_empresa_queso, q.id_tipo_queso,
						ae_1+ae_2+ai_1+round(((ai_2+ai_3+ai_4+ai_5+ai_6)/5),2)+ai_7+flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+
						flavor_7+flavor_8+flavor_9+textura_1+textura_2+textura_3+textura_4+textura_5+textura_6 as puntaje2 
						from mesa m 
						inner join concurso con on(con.id_concurso = m.id_concurso_mesa)
						inner join puntaje p on (p.id_mesa = m.id_mesa)
						inner join jurado j on  (p.id_jurado = j.id_jurado)
						inner join queso q on (p.id_queso=q.id_queso)
						inner join categoria c on (q.id_categoria_queso=c.id_categoria)
						inner join tipo t on (q.id_tipo_queso=t.id_tipo)
						inner join empresa e on (q.id_empresa_queso=e.id_empresa)
						inner join muestra mu on (mu.id_muestra = p.id_muestra_puntaje)
						where con.id_concurso = $id_c
						and m.id_coordinador_mesa = j.id_jurado
						order by mu.id_muestra, puntaje" ;



//				$sql = "(
//						select  e.tipo_empresa, e.nombre_empresa, c.descripcion_categoria,
//                        ae_1+ae_2+ai_1+ai_2+ai_7+flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+
//                        flavor_7+flavor_8+flavor_9+textura_1+textura_2+textura_3+textura_4+textura_5+textura_6 as puntaje
//                        , q.codigo_queso, t.descripcion_tipo, m.nombre_mesa 'Mesa', p.id_jurado 'Jurado',p.id_queso 'Queso', p.id_muestra_puntaje 'Muestra'
//                        , q.id_categoria_queso, q.id_empresa_queso, q.id_tipo_queso
//                        from mesa m
//                        inner join concurso con on(con.id_concurso = m.id_concurso_mesa)
//                        inner join puntaje p on (p.id_mesa = m.id_mesa)
//                        inner join jurado j on  (p.id_jurado = j.id_jurado)
//                        inner join queso q on (p.id_queso=q.id_queso)
//                        inner join categoria c on (q.id_categoria_queso=c.id_categoria)
//                        inner join tipo t on (q.id_tipo_queso=t.id_tipo)
//                        inner join empresa e on (q.id_empresa_queso=e.id_empresa)
//                        inner join muestra mu on (mu.id_muestra = p.id_muestra_puntaje)
//                        where con.id_concurso = $id_c
//                        and p.ai_3 is null
//                        and p.id_jurado  = 1
//						)
//						union
//						(
//						select  e.tipo_empresa, e.nombre_empresa, c.descripcion_categoria,
//                        ae_1+ae_2+ai_1+round(((ai_2+ai_3+ai_4+ai_5+ai_6)/5),2)+ai_7+flavor_1+flavor_2+flavor_3+flavor_4+flavor_5+flavor_6+
//                        flavor_7+flavor_8+flavor_9+textura_1+textura_2+textura_3+textura_4+textura_5+textura_6 as puntaje
//                        , q.codigo_queso, t.descripcion_tipo, m.nombre_mesa 'Mesa', p.id_jurado 'Jurado',p.id_queso 'Queso', p.id_muestra_puntaje 'Muestra'
//                        , q.id_categoria_queso, q.id_empresa_queso, q.id_tipo_queso
//                        from mesa m
//                        inner join concurso con on(con.id_concurso = m.id_concurso_mesa)
//                        inner join puntaje p on (p.id_mesa = m.id_mesa)
//                        inner join jurado j on  (p.id_jurado = j.id_jurado)
//                        inner join queso q on (p.id_queso=q.id_queso)
//                        inner join categoria c on (q.id_categoria_queso=c.id_categoria)
//                        inner join tipo t on (q.id_tipo_queso=t.id_tipo)
//                        inner join empresa e on (q.id_empresa_queso=e.id_empresa)
//                        inner join muestra mu on (mu.id_muestra = p.id_muestra_puntaje)
//                        where con.id_concurso = $id_c
//                        and p.ai_3 is not null
//						and p.id_jurado = 1
//						)
//						order by Muestra desc, puntaje desc";

				
				$resultados = mysqli_query($con,$sql);
				
					
					echo "<div id= 'inside2'>";
					echo "<h3>";
						echo "<table id='winners' class='data' cellspacing='0' cellpadding='0'>";	

							echo "<br />";
							echo "<th>";
							echo "Tipo Empresa";
							echo "</th>";
							echo "<th>";
							echo "Nombre Empresa";
							echo "</th>";
							echo "<th>";
							echo "Categoria";
							echo "</th>";
							echo "<th>";
							echo "Puntaje";
							echo "</th>";
							echo "<th>";
							echo "Medallas";
							echo "</th>";
							echo "<th>";
							echo "Codigo";
							echo "</th>";
							echo "<th>";
							echo "Tipo Queso";
							echo "</th>";
							echo "<th>";
							echo "Mesa";
							echo "</th>";
							echo "<th>";
							echo "Muestra";
							echo "</th>";
							

						while($resultado = mysqli_fetch_array($resultados)){
						
							echo "<tr>
									<td>".$resultado[0]."</td>								
						
									<td>".$resultado[1]."</td>							
							
									<td>".$resultado[2]."</td>";
									
									echo "<td>".$resultado[3]."</td>";

									echo "<td style='width:100px'>
											<select name='medallas' >
											<option value='oro'>Oro</option> 
											<option value='plata'>Plata</option> 
											<option value='bronce'>Bronce</option> <br />
											<option selected value='nada'>-</option>
											</select>	
										</td>
									<td>".$resultado[4]."</td>
								
									<td>".$resultado[5]."</td>
							
									<td>".$resultado[6]."</td>
							
									<td class='tdpart'>".$resultado[9]."</td>

									</tr>";
					
						} 
						echo "</table>";		
					echo "</h3>" ;   	
		
			    	echo "</div>";
		
			
		?>
		<form>
		<div class='botones-abajo'>
		<input type='button' onclick='window.print();' value='Imprimir' />
		</div>
		</form>
		<?php } ?>
		


	</div>

	<?php include "footer.php" ?>

</body>

<script language="javascript" type="text/javascript"> 


	var tablaclientes_Props =  {					
					col_0: "select", 
					col_1: "select",
					col_2: "select", 
					col_3: "select",
					col_4: "none", 
					col_5: "select",
					col_6: "select", 
					col_7: "select",
					col_8: "select",
					display_all_text: " [ Seleccionar ] ", 
					sort_select: true 
				}; 
	
	var tf = setFilterGrid( "winners",tablaclientes_Props ); 

	
   

</script>


</html>