<?php
include "conexiones.php";
if (isset($_POST['n_m_cm'])){
	$n_m_cm = $_POST['n_m_cm'];
	$id_c_cm = $_POST['id_c_cm'];
	mysqli_query($con, "insert into mesa values(null,$id_c_cm,'$n_m_cm')");
}
header("Location: crearMesa.php");
?>
