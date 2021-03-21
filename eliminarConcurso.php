<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
		header("Location: login.php");
	// Create connection
	include "conexiones.php";
	
	//VAN TODOS LOS TRUNCATE
	//echo $_GET['borrar'];
	//exit();
	//BACKUP ANTES DE BORRAR TODO
	//$fecha = date("m-d-Y");
	//exec("/usr/bin/mysqldump -u root -psanclemente cheese_world > /tmp/backup-$fecha-cheese_world.sql");
	if ($_GET['b'] == 1){
	$people = array(
		'puntaje',
		'queso',
		'mesa',
		'jurado',
		'muestra',
		'concurso'
		
	);
	for ($i=0; $i<count($people); $i++){
		if ($people[$i] == 'puntaje')
			$query="delete from puntaje where id_mesa > 0";
		else if ($people[$i] == 'jurado')	
			$query="delete from jurado where nombre_jurado not in ('Bruno Sessa','Daniela Priani', 'Marcelo Lioi','Consensuada')";
		else
			$query="delete from $people[$i] where id_".$people[$i]." > 0";
		mysqli_query($con,$query);
		//echo $query;
		//echo "<br />";
	}
	//exit();
	header("Location: crearConcurso2.php");
	}
?>
