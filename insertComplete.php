<?php
	include "conexiones.php";
	if (isset ($_POST['post_mesa'])) {
		$n_m = $_POST['post_mesa'];
		$id_m = $_POST['post_id_mesa'];

		$insertarjurado = $_POST['origen1']; 
		$insertarqueso = $_POST['origen2']; 
		$id_coordinador = $_POST['coord'];
		//ME FIJO SI EL JURADO ESTA EN LA MISMA EMPRESA QUE EL QUESO
		/*for($i = 0; $i < count($insertarjurado); $i++){
		 	$id_j = $insertarjurado[$i];
		 	$emp_j = "select id_empresa_jurado from jurado where id_jurado = $id_j";
			for($j = 0; $j < count($insertarqueso); $j++){
				$id_q = $insertarqueso[$j];
				$emp_q = "select id_empresa_queso from queso where id_queso = $id_q";

				if($emp_j == $emp_q){
					//VERIFICAR QUE EL JURADO NO SEA DE LA MISMA EMPRESA QUE EL QUESO
				}
				
*/
		
		//INSERTO DATOS EN PUNTAJE
		$confirm = 0;		
		for($i = 0; $i < count($insertarjurado); $i++){
		 	$id_j = $insertarjurado[$i];
			
			
			for($j = 0; $j < count($insertarqueso); $j++){
				$id_q = $insertarqueso[$j];


				//VEO SI ES ROQUEFORT
				$roque = mysqli_query($con,"select c.descripcion_categoria
											from queso q
											inner join categoria c on (c.id_categoria = q.id_categoria_queso)
											where q.id_queso=$id_q");
				$nom_q = mysqli_fetch_row($roque);		


				$campos = "campo1, campo2, campo3, campo4, campo5, campo6, campo7, 
					campo8, campo9, campo10, campo11, campo12, campo13, campo14, campo15, 
					campo16, campo17, campo18, campo19, campo20, campo21, campo22, campo23, campo24";

				switch($nom_q[0]){
					//AGREGO LA TUPLA FINAL A PUNTAJE
					
					case 'PASTA SEMIDURA CON OJOS' :
					$nom_campos_1 = "'Forma', 'Corteza/Superficie', 'Color', 'Tamano de ojos', 'Numero de ojos', 
					'Distribucion de ojos','Forma de ojos','Brillo de ojos','Homogeneidad de la pasta',
					'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Persistencia','Gusto residual/Regusto',
					'Elasticidad(Manual)','Firmeza','Friabilidad', 'Impresion de humedad','Adherencia','Solubilidad'";

					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,$campos) 
										values ($id_m,$id_q,$id_j,$nom_campos_1)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,$campos) 
										values ($id_m,$id_q,1,$nom_campos_1)";
					}

					break;

					
					case 'ESPECIADOS' :					
					$nom_campos_2 = "'Forma', 'Corteza/Superficie', 'Color', 'Homogeneidad de la pasta',null,null,null,null, 
					'Distribucion especias', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Persistencia','Gusto residual/Regusto',
					'Elasticidad(Manual)','Firmeza','Friabilidad', 'Impresion de humedad','Adherencia','Solubilidad'";
					
					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_2)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_2)";
					}

					break;					

					
					case 'PASTA BLANDA HILADA' :					
					$nom_campos_3 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de ojos o aberturas',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Savor a Levadura','Gusto residual/Regusto',
					'Elasticidad(Manual)','Firmeza','Fibrosidad', 'Impresion de humedad','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_3)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_3)";
					}

					break;					
					


					case 'PASTA HILADA' :					
					$nom_campos_4 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de Ojos o abertura',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Persistencia','Gusto residual/Regusto',
					'Elasticidad(Manual)','Firmeza','Fibrosidad', 'Impresion de humedad','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_4)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_4)";
					}

					break;					

					
					case 'PASTA BLANDA' :					
					$nom_campos_5 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de Ojos o abertura',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Sabor a levadura','Persistencia',
					'Elasticidad(Manual)','Firmeza','Granulosidad', 'Impresion de humedad','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_5)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_5)";
					}

					break;						


					case 'PASTA BLANDA CON HONGOS EN INTERIOR' :					
					$nom_campos_6 = "'Presentacion/Forma', 'Corteza/Superficie', 'Color', 'Distribucion del hongo',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico',
					'Gusto salado', 'Gusto amargo','Gusto acido','Sabor a levadura','Rancidez','Gusto residual/Regusto',
					'Elasticidad(Manual)','Firmeza','Solubilidad','Impresion de humedad','Cremosidad','Adherencia'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_6)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_6)";
					}

					break;					


					case 'PASTA BLANDA CON HONGOS EN SUPERFICIE' :					
					$nom_campos_7 = "'Forma', 'Distribucion y estado del hongo', 'Color', 'Brillo',null,null,null,null, 
					'Homogeneidad de la pasta (aberturas)', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Persistencia','Gusto residual/Regusto',
					'Elasticidad','Firmeza','Cremosidad', 'Impresion de humedad','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_7)";	
					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_7)";
					}

					break;						


					case 'PASTA BLANDA MUY ALTA HUMEDAD' :					
					$nom_campos_8 = "'Superficie', 'Separacion de Fases', 'Color', 'Brillo',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Regusto','Persistencia',
					'Corte','Cremosidad','Untabilidad','Granulosidad',
					'Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_8)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_8)";
					}

					break;						


					case 'PASTA DURA' :					
					$nom_campos_9 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de Ojos o abertura',null,null,null,null, 
					'Grana', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Sensacion picante','Gusto residual/Regusto',
					'Elasticidad(Manual)','Firmeza','Friabilidad', 'Impresion de humedad','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_9)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_9)";
					}

					break;						


					case 'PASTA SEMIDURA SIN OJOS' :					
					$nom_campos_10 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de Ojos o abertura',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Sensacion picante','Persistencia',
					'Elasticidad(Manual)','Firmeza','Friabilidad', 'Impresion de humedad','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_10)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_10)";
					}

					break;						


					case 'PASTA SEMIDURA SIN OJOS BARRA' :					
					$nom_campos_11 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de Ojos o abertura',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Persistencia','Regusto',
					'Firmeza','Miga','Feteado', 'Enrollamiento','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_11)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_11)";
					}

					break;						


					case 'PASTA BLANDA HILADA MUZZA' :					
					$nom_campos_12 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de ojos o aberturas',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Sabor a levadura','Gusto residual/Regusto',
					'Fibrosidad','Pardiamiento(Browning)','Formacion de burbujas(Blister)','Liberacion de aceite(Oiling off)',
					'Derretimiento(Spreading)','Estiramiento(Streatching)'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_12)";

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_12)";
					}

					break;						


					default:								
					$nom_campos_13 = "'Forma', 'Corteza/Superficie', 'Color', 'Presencia de Ojos o abertura',null,null,null,null, 
					'Homogeneidad de la pasta', 'Intensidad de olor','Intensidad de aroma','Olor y aroma caracteristico','Gusto dulce',
					'Gusto salado', 'Gusto amargo','Gusto acido','Persistencia','Regusto',
					'Firmeza','Miga','Feteado', 'Enrollamiento','Adherencia','Solubilidad'";
					
   					$insertcompleto = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,$id_j,null,null,null,null,$nom_campos_13)";									

					if (!$confirm){
						$insert_concensuada = "insert into puntaje(id_mesa,id_queso,id_jurado,ai_3,ai_4,ai_5,ai_6,$campos) 
										values ($id_m,$id_q,1,null,null,null,null,$nom_campos_13)";
					}

					break;						
																																		
				
				}
				
				
				mysqli_query($con,$insertcompleto) or die(mysqli_error($con));
				if(!$confirm)
					mysqli_query($con,$insert_concensuada) or die(mysqli_error($con));
			}

			$confirm = 1;
			
				
		
		}
		
		//INSERT DATOS DE COORDINADOR EN MESA
		
		$insert_coord = "update mesa set id_coordinador_mesa = $id_coordinador where id_mesa = $id_m";
		mysqli_query ($con, $insert_coord) or die ( mysqli_error($con));
	}
	header("Location: configuring.php");
	

?>
