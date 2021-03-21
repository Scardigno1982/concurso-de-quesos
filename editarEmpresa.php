<?php

	if(isset($_POST['nom_e'])){
		include "conexiones.php";
		$nom_e = $_POST['nom_e'];
		$tipo_e = $_POST['tipo_e'];
		$id_e = $_POST['id_emp'];

		$update = mysqli_query($con, "update empresa set nombre_empresa = '$nom_e', tipo_empresa='$tipo_e' 
											where id_empresa=$id_e");
		header("Location: empresas.php");
	}

?>