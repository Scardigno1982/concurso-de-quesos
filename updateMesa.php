<?php
include "conexiones.php";
if (isset($_POST['id_m_em'])){
                        mysqli_query($con, "update mesa set nombre_mesa='".$_POST['n_m_em']."' where id_mesa=".$_POST['id_m_em']);
                        header("Location: tables.php");
}
?>
