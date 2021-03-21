<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
	// Create connection
	include "conexiones.php";

	if(isset($_GET['id_q'])){
		$id_q = $_GET['id_q'];
		$ver_puntaje = mysqli_query($con, "select * from puntaje where id_queso = $id_q");
		if(mysqli_num_rows($ver_puntaje) == 0){
			mysqli_query($con,"delete from queso where id_queso=$id_q");
			header("Location: cheeses.php");
		}
		else
			echo "<script>";
			echo "alert('No se puede eliminar el Queso ya que está asignado a una mesa');";
			echo "window.location.assign('cheeses.php');";
			echo "</script>";
	}
?>
