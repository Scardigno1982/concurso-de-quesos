<?php
	include "conexiones.php";
	if (isset($_POST['n_q_cq'])){

                                $cat_q = $_POST['cat_q_cq'];
                                $tipo_q = $_POST['tipo_q_cq'];
                                $cod_q = $_POST['c_q_cq'];
                                $nac_q = $_POST['n_q_cq'];
                                $emp_q = $_POST['e_q_cq'];

                                $ver_queso = mysqli_query($con,"select * from queso 
                                                                where codigo_queso = $cod_q");

                                if(mysqli_num_rows($ver_queso) == 0){

                                        if($emp_q == '-'){
                                                $insert = "insert into queso values(null,$cat_q,$tipo_q,'$cod_q',null,'$nac_q')";
                                                $insert_viejo = "insert into queso_viejo select * from queso where id_queso=(select MAX(id_queso) from queso) ";
					}
                                        else{
                                                $insert = "insert into queso values(null,$cat_q,$tipo_q,'$cod_q','$emp_q','$nac_q')";
                                                $insert_viejo = "insert into queso_viejo select * from queso where id_queso=(select MAX(id_queso) from queso) ";
					}
                                                                        
                                        mysqli_query($con, $insert) or die(mysqli_error($con));
                                        mysqli_query($con, $insert_viejo) or die(mysqli_error($con));
                                        header("Location: cheeses.php");
                                }
                                else
                                        echo "El codigo de queso ya existe";
	}
?>
