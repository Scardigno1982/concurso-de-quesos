<?php
	include "conexiones.php";
	if (isset($_POST['n_m_cm'])){
                                $nom_m = $_POST['n_m_cm'];
                                $turno_m = $_POST['t_m_cm'];
                                $concurso_actual = $_POST['c_m_cm'];
                                
                                mysqli_query($con, "insert into muestra 
								values(null,'$nom_m','$turno_m',$concurso_actual)") or die(mysqli_error($con));
                                header("Location: muestras.php");
	}
?>
