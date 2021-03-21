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
		include "conexiones.php";
		echo "Seleccione el codigo del queso a traer: ";
                echo "<br />";
                echo "<br />";
		$quesos = mysqli_query($con, "select q.id_queso, q.codigo_queso, e.nombre_empresa, 
                                                c.descripcion_categoria, t.descripcion_tipo, q.id_tipo_queso, 
                                                q.id_categoria_queso, q.id_empresa_queso 
                                                from queso_viejo q 
                                                inner join categoria c on (q.id_categoria_queso = c.id_categoria)
                                                inner join tipo t on (t.id_tipo = q.id_tipo_queso) 
                                                left join empresa e on (e.id_empresa = q.id_empresa_queso)
                                                   order by e.nombre_empresa ");

                echo "<br />";
		echo "<div id='inside'>";
		echo "<div id='peque'>";
		echo "<table id='cheese' class='data'>";
                        echo "<th>";
                        echo "Codigo";
                        echo "</th>";
                        echo "<th>";
                        echo "Empresa";
                        echo "</th>";
                        echo "<th>";
                        echo "Categoria";
                        echo "</th>";
                        echo "<th>";
                        echo "Tipo";
                        echo "</th>";
                        while($queso = mysqli_fetch_array($quesos)){
                        echo "<tr>";
                        echo "<td>";
			echo "<a href='agregarQuesoAnterior.php?id_q=".$queso['id_queso']."'>".$queso['codigo_queso']."</a>";
                        echo "</td>";
                        echo "<td>";
                        echo $queso['nombre_empresa'];
                        echo "</td>";
                        echo "<td>";
                        echo $queso['descripcion_categoria'];
                        echo "</td>";
                        echo "<td>";
                        echo $queso['descripcion_tipo'];
                        echo "</td>";
                        echo "</tr>";
                        }
                        echo "</table>";


		//SI YA SELECCIONO UN NUEVO CAMPO

	?>
</body>
