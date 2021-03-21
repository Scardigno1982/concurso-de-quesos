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
		echo "Seleccione el nombre del jurado a traer: ";
                echo "<br />";
                echo "<br />";
		$jurados = mysqli_query($con,"select j.id_jurado, j.nombre_jurado,e.nombre_empresa, u.login_usuario, u.is_admin_usuario, j.id_usuario 
                                                       from jurado_viejo j 
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
                        echo "Nombre <span class='informacion'>(Click para agregar)</span>";
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
                        echo "<a href='agregarJuradoAnterior.php?id_j=".$jurado['id_jurado']."'>".$jurado['nombre_jurado']."<a/>";
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


		//SI YA SELECCIONO UN NUEVO CAMPO

	?>
</body>
