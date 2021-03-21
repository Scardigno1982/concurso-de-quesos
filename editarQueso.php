<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
?>

<html>
<head>
	<title> Crear Mesas </title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">    
        <link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- SCRIPTS -->
	<script type="text/javascript" src="js/jquery-2.1.1.min.js" defer></script>
	<script type="text/javascript" src="js/main.js" defer></script>
</head>
<body>

	<?php include "conexiones.php" ?>

	<div id="header">
                <img src="images/header.gif" id="banner" />
        </div>
        <div id="content">
	<?php include "sidebar.php" ?>	

		<div id="info">
                <div id="inside">	
		<?php
			$quesos = mysqli_query($con,"SELECT q.id_queso, q.nombre_queso, q.descripcion_queso, q.codigo_queso,e.nombre_empresa, c.descripcion_categoria, t.descripcion_tipo, q.id_tipo_queso, q.id_categoria_queso, q.id_empresa_queso FROM queso q inner join categoria c on (q.id_categoria_queso = c.id_categoria)inner join tipo t on (t.id_tipo = q.id_tipo_queso) inner join empresa e on (e.id_empresa = q.id_empresa_queso)");
			echo "<span class='titular'>Quesos existentes</span>";
			echo "<br />";
			echo "<br />";
			echo "<table>";
			echo "<th>";
			echo "Nombre";
			echo "</th>";
			echo "<th>";
			echo "Descripcion";
			echo "</th>";
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
                        echo "<a href='editarQueso.php?id_q=".$queso['id_queso']."&n_q=".$queso['nombre_queso']."&cod_q=".$queso['codigo_queso']."&cat_q=".$queso['id_categoria_queso']."&tipo_q=".$queso['id_tipo_queso']."&desc_q=".$queso['descripcion_queso']."&emp_q=".$queso['id_empresa_queso']."'>".$queso['nombre_queso']."<a/>";
                        echo "</td>";
			echo "<td>";
			echo $queso['descripcion_queso'];
                        echo "</td>";
			echo "<td>";
			echo $queso['codigo_queso'];
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
			echo "</li>";
			}
			echo "</table>";
			echo "<br />";
			echo "<br />";
			
			echo "<br />";
			echo "<br />";

			$empresas = mysqli_query($con, "select * from empresa");
			$categorias = mysqli_query($con, "select * from categoria");
			$tipos = mysqli_query($con, "select * from tipo");
			if (isset($_GET['id_q'])){
                                $get_id_q=$_GET['id_q'];
                                $get_n_q=$_GET['n_q'];
				$get_cod_q=$_GET['cod_q'];
                                $get_cat_q=$_GET['cat_q'];
                                $get_tipo_q=$_GET['tipo_q'];
                                $get_desc_q=$_GET['desc_q'];
                                $get_emp_q=$_GET['emp_q'];
				
                                echo "<span class='titular'>Editar Queso</span>";
                                echo "<br />";
                                echo "<br />";
                                echo "<form id='form-cc' action='updateQueso.php' method='post'>";
				echo "<fieldset class='inputs'>";
				
				#CAMPOS INVISIBLES
				echo "<input type='hidden' name='id_q_eq' value='$get_id_q' />";
				#FIN CAMPOS

				echo "<label for='n_q_cq'> Nombre Queso </label>";
				echo "<input type='text' id='editar_nombre_queso' name='n_q_eq' value='$get_n_q' required autofocus/>";
				echo "<label for='d_q_cq'> Descripcion </label>";
				echo "<input type='text' id='editar_descripcion_queso' name='d_q_eq' value='$get_desc_q' required autofocus/>";
				echo "<label for='cod_q_cq'> Codigo </label>";
				echo "<input type='text' id='editar_codigo_queso' name='cod_q_eq' value='$get_cod_q' required autofocus/>";

				echo "<select name='e_q_eq'>";
					while ($empresa = mysqli_fetch_array($empresas)){
						if ($empresa['id_empresa'] == $get_emp_q){ 
							echo "<option value=".$empresa['id_empresa']." selected>".$empresa['nombre_empresa']."</option>";
						}
						else
							echo "<option value=".$empresa['id_empresa']." >".$empresa['nombre_empresa']."</option>";
					}
				
				echo "</select>";
				
				echo "<select name='c_q_eq'>";
					while ($categoria = mysqli_fetch_array($categorias)){
						if ($categoria['id_categoria'] == $get_cat_q){ 
							echo "<option value=".$categoria['id_categoria']." selected>".$categoria['descripcion_categoria']."</option>";
						}
						else
							echo "<option value=".$categoria['id_categoria']." >".$categoria['descripcion_categoria']."</option>";
					}
				
				echo "</select>";
				
				echo "<select name='tipo_q_eq' Tipo>";
					while ($tipo = mysqli_fetch_array($tipos)){
						if($tipo['id_tipo'] == $get_tipo_q)
							echo "<option value=".$tipo['id_tipo']." selected>".$tipo['descripcion_tipo']."</option>";
						else
							echo "<option value=".$tipo['id_tipo'].">".$tipo['descripcion_tipo']."</option>";
					}
				echo "</select>";
				
				echo "</fieldset>";
				echo "<br />";
				echo "<input type='submit' value='Aceptar' class='boton' />";
			echo "</form>";	
		}
		?>
		
		<!-- inside -->
                </div>
                <!-- info  -->
                </div>
        <!-- Content -->
        </div>
	<?php include "footer.php" ?>
</body>
</html>
