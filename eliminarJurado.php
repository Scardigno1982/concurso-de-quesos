<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
	// Create connection
	include "conexiones.php";

	if(isset($_GET['id_j'])){
		$id_j = $_GET['id_j'];
		$id_u = $_GET['id_u'];

		$ver_puntaje = mysqli_query($con, "select * from puntaje where id_jurado = $id_j");
		if(mysqli_num_rows($ver_puntaje) == 0){
			//AGREGO PORQUE SI BORRO EL USUARIO DESPUES NO PUEDO AGREGARLO DE JURADOS VIEJOS
			mysqli_query($con,"delete from jurado where id_jurado=$id_j");
			//mysqli_query($con,"delete from usuario where id_usuario=$id_u");
			//$query = mysqli_query($con,"select * from jurado_viejo where id_jurado=$id_j");
			//if (mysqli_num_rows($query) == 0){
			//	mysqli_query($con,"insert into jurado_viejo select * from jurado where id_jurado=$id_j");
			//}
			//mysqli_query($con,"delete from jurado where id_jurado=$id_j");
			//
			header("Location: juries.php");
		}
		else
			echo "<script>";
			echo "alert('No se puede eliminar el jurado ya que está asignado a una mesa');";
			echo "window.location.assign('juries.php');";
			echo "</script>";

		
	}
?>
