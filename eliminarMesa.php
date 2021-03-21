<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
	// Create connection
	include "conexiones.php";

	mysqli_query($con,"delete from mesa where id_mesa=".$_GET['id_m']);
	header("Location: tables.php");
?>
