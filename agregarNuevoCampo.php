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
		echo "<div id='inside'>";
			echo "<div id='peque'>";
		echo "<form action='' method='post'>";
		echo "<select name='categoria_campo'>";
		echo "<option>";
		echo "Apariencia Interna";
		echo "</option>";
		echo "<option>";
		echo "Apariencia Externa";
		echo "</option>";
		echo "<option>";
		echo "Flavor";
		echo "</option>";
		echo "<option>";
		echo "Textura";
		echo "</option>";
		echo "</select>";
		echo "<br />";
		echo "<br />";

		echo "<label for ='campo_nuevo'>Nuevo Campo</label>";
		echo "<input type='text' name='campo_nuevo'>";

		echo "<input type='submit' value='Aceptar' />";
		echo "</form>";



		//SI YA SELECCIONO UN NUEVO CAMPO

		if(isset($_POST['campo_nuevo'])){
			$campo = $_POST['campo_nuevo'];
			$cat_campo = $_POST['categoria_campo'];

			if($cat_campo == 'Apariencia Externa')
				$cat_campo = "AE";
			elseif ($cat_campo == 'Apariencia Interna')
				$cat_campo = "AI";
			elseif ($cat_campo == 'Flavor')
				$cat_campo = "F";
			elseif ($cat_campo == 'Textura')
				$cat_campo = "T";
			
			mysqli_query($con, "insert into planilla_campo values(null,'$campo','$cat_campo')");
			echo "<script>";
			echo "window.opener.location.reload();";
			echo "window.self.close();";
			echo "</script>";
		}
		echo "</div>";
		echo "</div>";
	?>
</body>