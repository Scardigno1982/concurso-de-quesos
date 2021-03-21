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
	<script>
	        function abrir(j,n){
			open('promediosJurado.php?id_j='+j+'&n_j='+n,'','top=300,left=300,width=550px,height=130px');
		}
        </script>

</head>
<body>
	<?php
		include "conexiones.php";
	
		if(!isset($_GET['id_j'])){
		

        	echo "<div id='header'>";
                echo "<img src='images/header.gif' id='banner' />";
	        echo "</div>";
		include "sidebar2.php";	

		$jurados = mysqli_query($con,"select j.id_jurado, j.nombre_jurado,e.nombre_empresa, u.login_usuario, u.is_admin_usuario, j.id_usuario
                                                       from jurado j 
                                                       inner join usuario u on (u.id_usuario=j.id_usuario)
                                                       left join empresa e on (e.id_empresa = j.id_empresa_jurado)");


                echo "<br />";
		echo "<div id='inside'>";
		echo "<div id='peque'>";
		
		echo "<table class='data'>";
                        echo "<th>";
                        echo "ID";
                        echo "</th>";
                        echo "<th>";
                        echo "Nombre <span class='informacion'>(Click para Ver Puntos)</span>";
                        echo "</th>";
                        echo "<th>";
                        echo "Empresa";
                        echo "</th>";
                        echo "<th>";
                        echo "Usuario";
                        echo "</th>";
                        while($jurado = mysqli_fetch_array($jurados)){
                        echo "<tr>";
                        echo "<td>";
                        echo $jurado['id_jurado'];
                        echo "</td>";
                        echo "<td>";
                        //echo "<a href='promediosJurado.php?id_j=".$jurado['id_jurado']."'>".$jurado['nombre_jurado']."<a/>";
			$j = $jurado['id_jurado'];
			$n = $jurado['nombre_jurado'];
                        echo "<a onclick='abrir($j,\"$n\")'>".$n."<a/>";
                        echo "</td>";
                        echo "<td>";
                        echo $jurado['nombre_empresa'];
                        echo "</td>";
                        echo "<td>";
                        echo $jurado['login_usuario'];
                        echo "</td>";
			echo "</tr>";
                        }
                        echo "</table>";

		}
		else { //SELECCIONO JURADO
			$id_j = $_GET['id_j'];
			$n_j = $_GET['n_j'];
			$mesa = mysqli_fetch_row(mysqli_query($con,"select distinct(id_mesa) from puntaje p where p.id_jurado=$id_j"));
			$id_m = $mesa[0];
			$quesos = mysqli_query($con,"select distinct(id_queso) from puntaje where id_jurado=$id_j");
			$cant_quesos = mysqli_fetch_row(mysqli_query($con,"select count(distinct(id_queso)) from puntaje where id_jurado=$id_j"));

			//SUM ES LA VARIABLE QUE VA SUMANDO LOS ERRORES DE JURADOS
			$sum = $cant_quesos[0]*24*5;
			$worst = 0; //PUNTAJE PERFECTO
			$best = $cant_quesos[0]*24*5; //PEOR PUNTAJE-Cantidad de quesos por cantidad de campos * 5 que es la peor diferencia posible
			//RECORRO LOS QUESOS DE ESE JURADO
			while($queso=mysqli_fetch_array($quesos)){
				$id_q = $queso['id_queso'];	
	
				//CHEQUEO DE CANTIDAD DE CAMPOS PARA DETERMINAR EL PEOR PUNTAJE POSIBLE
				$cons = mysqli_fetch_row(mysqli_query($con,"select ifnull((
							select ai_3 from puntaje where id_mesa=$id_m and id_jurado=$id_j and id_queso=$id_q), 1)
							"));
				if ($cons[0] == 1){
					$best = $best - 20; //RESTO la cantidad de los 4 campos que corresponden a los quesos con menos campos
					$sum = $sum - 20;
				}
				

				//FIN
				
				$prom = mysqli_fetch_row(mysqli_query($con,"select 
					(MAX(ae_1)-MIN(ae_1))+(MAX(ae_2)-MIN(ae_2))+(MAX(ai_1)-MIN(ai_1))+(MAX(ai_2)-MIN(ai_2))+
					ifnull((MAX(ai_3)-MIN(ai_3)),0)+ifnull((MAX(ai_4)-MIN(ai_4)),0)+ifnull((MAX(ai_5)-MIN(ai_5)),0)+
					ifnull((MAX(ai_6)-MIN(ai_6)),0)+(MAX(ai_7)-MIN(ai_7))+
					(MAX(flavor_1)-MIN(flavor_1))+(MAX(flavor_2)-MIN(flavor_2))+(MAX(flavor_3)-MIN(flavor_3))+
					(MAX(flavor_4)-MIN(flavor_4))+(MAX(flavor_5)-MIN(flavor_5))+(MAX(flavor_6)-MIN(flavor_6))+
					(MAX(flavor_7)-MIN(flavor_7))+(MAX(flavor_8)-MIN(flavor_8))+(MAX(flavor_9)-MIN(flavor_9))+
					(MAX(textura_1)-MIN(textura_1))+(MAX(textura_2)-MIN(textura_2))+(MAX(textura_3)-MIN(textura_3))+
					(MAX(textura_4)-MIN(textura_4))+(MAX(textura_5)-MIN(textura_5))+(MAX(textura_6)-MIN(textura_6)) as suma
					from puntaje
					where id_jurado in (1,$id_j)
					and id_queso = $id_q
					and id_mesa= $id_m"));
					$sum = $sum - $prom[0];
					
			}//FIN WHILE DE QUESOS
			if($best != 0){
			$porc = number_format($sum * 100 / $best,2);
			
			echo "<table class='data'>";
			echo "<tr>";
			echo "<th colspan=4>$n_j</th>";
			echo "</tr>";
			echo "<th>Puntos</th>";
			echo "<th>Puntaje Ideal</th>";
			echo "<th>Peor Puntaje</th>";
			echo "<th>Aciertos</th>";

			echo "<tr>";
			echo "<td>$sum</td>";
			echo "<td>$best</td>";
			echo "<td>$worst</td>";
			echo "<td>$porc %</td>";
			echo "</tr>";
			echo "</table>";
			}
			else
				echo "El Jurado no Tiene Quesos asignados en el Concurso";
		}
		//SI YA SELECCIONO UN NUEVO CAMPO

	?>
</body>
