<?php
include "conexiones.php";
if (isset($_POST['id_q_eq'])){
	$id_q = $_POST['id_q_eq'];
	$id_c_q = $_POST['c_q_eq'];	
	$id_t_q = $_POST['tipo_q_eq'];	
	$cod_q = $_POST['cod_q_eq'];
	if($_POST['e_q_eq'] == '-')	
		$id_e_q = 'null';
	else
		$id_e_q = $_POST['e_q_eq'];

	$ver_queso = mysqli_query($con,"select * from queso 
                                    where codigo_queso = $cod_q");

    	if(mysqli_num_rows($ver_queso) == 0){
	
		mysqli_query($con, "update queso set id_categoria_queso=$id_c_q,id_tipo_queso=$id_t_q,
					codigo_queso='$cod_q',id_empresa_queso=$id_e_q where id_queso=$id_q");
		mysqli_query($con, "update queso_viejo set id_categoria_queso=$id_c_q,id_tipo_queso=$id_t_q,
					codigo_queso='$cod_q',id_empresa_queso=$id_e_q where id_queso=$id_q");
        header("Location: cheeses.php");
	}
	else
                                        echo "El codigo de queso ya existe";

}
?>
