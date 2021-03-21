<?php
include "conexiones.php";
if (isset($_POST['id_j_ej'])){
				$login_usuario = $_POST['l_u_ej'];

                                if (isset($_POST['admin_ej']))
                                        $checked = 1;
                                else
                                        $checked = 0;


                                if($_POST['e_j_cj'] == '-') 
                            		$id_e_q = 'null';
                        		else
                            		$id_e_q = $_POST['e_j_cj'];

                                mysqli_query($con, "update jurado set nombre_jurado='".$_POST['n_j_ej']."',id_empresa_jurado=$id_e_q where id_jurado=".$_POST['id_j_ej']);
                                mysqli_query($con, "update jurado_viejo set nombre_jurado='".$_POST['n_j_ej']."',id_empresa_jurado=$id_e_q where id_jurado=".$_POST['id_j_ej']);
				mysqli_query($con, "update usuario set is_admin_usuario=$checked where login_usuario='$login_usuario'");
                                
				header("Location: juries.php");
}
?>
