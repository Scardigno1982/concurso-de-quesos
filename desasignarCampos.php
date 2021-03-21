<?php
include "conexiones.php";
$anterior = $_SERVER['HTTP_REFERER'];
if (isset($_GET['id_q'])){
	$id_mues = $_GET['id_mues'];
	$id_q = $_GET['id_q'];
	mysqli_query($con, "update puntaje set id_muestra_puntaje=null
						where id_queso=$id_q");
                        header("Location: $anterior");
}
?>
