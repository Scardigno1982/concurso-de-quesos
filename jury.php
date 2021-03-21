		<div id="info">
		<div id="inside">
            <?php
			$jurados = mysqli_query($con,"select j.id_jurado, j.nombre_jurado,e.nombre_empresa, u.login_usuario, u.is_admin_usuario, j.id_usuario 
                                                       from jurado j 
                                                       inner join usuario u on (u.id_usuario=j.id_usuario)
                                                       left join empresa e on (e.id_empresa = j.id_empresa_jurado) ORDER BY j.nombre_jurado");
                        echo "<br />";
                        echo "<br />";
                        echo "<button class='boton-crear2'><a href='juries.php?isCreate=1' id='bct'>Crear Jurado Nuevo</a></button>";
                        echo "<button class='boton-crear2' onclick='abrir3()'>Traer Jurados Anteriores</button>";
                        echo "<button class='boton-crear2'><a href='promediosJurado.php'>Puntaje de Jurados</a></button>";
                        echo "<br />";
                        echo "<br />";
                        echo "<table class='data'>";
                        echo "<th>";
                        echo "Id";
                        echo "</th>";
                        echo "<th>";
                        echo "Nombre <span class='informacion'>(Click para editar)</span>";
                        echo "</th>";
                        echo "<th>";
                        echo "Empresa";
                        echo "</th>";
                        echo "<th>";
                        echo "Usuario";
                        echo "</th>";
                        echo "<th>";
                        echo "Admin";
                        echo "</th>";
                        echo "<th>";
                        echo "Eliminar";
                        echo "</th>";
                        while($jurado = mysqli_fetch_array($jurados)){
                        echo "<tr>";
                        echo "<td>";
                        echo $jurado['id_jurado'];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='juries.php?id_j=".$jurado['id_jurado']."&n_j=".$jurado['nombre_jurado']."&e_j=".$jurado['nombre_empresa']."&l_u=".$jurado['login_usuario']."&admin=".$jurado['is_admin_usuario']."&id_u=".$jurado['id_usuario']."'>".$jurado['nombre_jurado']."<a/>";
                        echo "</td>";
                        echo "<td>";
                        echo $jurado['nombre_empresa'];
                        echo "</td>";
                        echo "<td>";
                        echo $jurado['login_usuario'];
                        echo "</td>";
                        echo "<td>";
                        echo $jurado['is_admin_usuario'];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='eliminarJurado.php?id_j=".$jurado['id_jurado']."&id_u=".$jurado['id_usuario']."'>X</a>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</li>";
                        }
                        echo "</table>";
			
                        echo "<br />";
                        echo "<br />";
	
		if (isset($_GET['id_j']) && isset($_GET['n_j'])){
                                echo "<br />";
                                echo "<br />";
                                $id_j = $_GET['id_j'];
                                $id_u = $_GET['id_u'];

                                if ($_GET['admin'] == 1)
                                        $is_admin = true;
                                else
                                        $is_admin = false;
                                //EMPRESAS PARA CARGAR SELECT
                                $empresas = mysqli_query($con,"select * from empresa ORDER BY nombre_empresa");

                                echo "<form id='form-cc' action='updateJurado.php' method='post'>";

                                        echo "<fieldset class='inputs'>";
                                        echo "<label for='id_j_ej'>ID Jurado </label>";
                                        echo "<input type='text' id='editar_id_mesa' name='id_j_ej' value=".$_GET['id_j']." readonly />";
                                        echo "<label for='n_j_ej'> Nombre Jurado </label>";
                                        echo "<input type='text' id='editar_nombre_mesa' name='n_j_ej' value='".$_GET['n_j']."' required autofocus />";
                                        echo "<br />";
                                        echo "<label for='e_j_cj'> Empresa </label>";
                                        echo "<select id='crear_empresa_jurado' name='e_j_cj'>";
                                        echo "<option>-</option>";
                                        while ($empr = mysqli_fetch_array($empresas)){
                                            if($empr['nombre_empresa'] ==  $_GET['e_j'])
                                                echo "<option value='".$empr['id_empresa']."' selected>".$empr['nombre_empresa']."</option>";
                                            else
                                                echo "<option value='".$empr['id_empresa']."'>".$empr['nombre_empresa']."</option>";
                                        }
                                        echo "</select>";
                                        echo "<label for='l_u_ej'> Usuario </label>";
                                        echo "<input type='text' id='editar_nombre_mesa' name='l_u_ej' value='".$_GET['l_u']."' readonly />";
                                        
                                        echo "</fieldset>";
					                    echo "<br />";
                                        if ($is_admin)
                                                echo "<input type='checkbox' id='editar_nombre_mesa' name='admin_ej' checked> Administrador";
                                        else
                                                echo "<input type='checkbox' id='editar_nombre_mesa' name='admin_ej'>Administrador";
                                        echo "<br />";
                    					echo "<br />";
                                        echo "<input type='button' value='Modificar Password' class='boton' onclick='abrir($id_u)' />";
                                        echo "<br />";
                                        echo "<br />";
                                        echo "<input type='submit' value='Aceptar' class='boton' />";
                                echo "</form>";
                }
		elseif (isset ($_GET['isCreate'])){
                        $empresas = mysqli_query($con,"select * from empresa");

                        echo "<br />";
                        echo "<br />";
			            echo "<form id='form-cc' action='' method='post'>";
                                echo "<fieldset class='inputs'>";
                                echo "<label for='n_j_cj'> Nombre Jurado </label>";
                                echo "<input type='text' id='crear_nombre_mesa' name='n_j_cj' required autofocus/>";
                                echo "<label for='e_j_cj'> Empresa Jurado </label>";
                                echo "<select id='crear_empresa_jurado' name='e_j_cj' required />";
                                echo "<option>-</option>";
                                while ($empr = mysqli_fetch_array($empresas)){
                                        echo "<option value='".$empr['id_empresa']."'>".$empr['nombre_empresa']."</option>";
                                }      
                                echo "</select>";
                                echo "<label for='n_u_cj'> Usuario </label>";
                                echo "<input type='text' id='crear_nombre_mesa' name='n_u_cj' onkeyup='javascript:this.value=this.value.toLowerCase();' required/>";
                                echo "<label for='p_u_cj'> Password </label>";
                                echo "<input type='password' id='crear_nombre_mesa' name='p_u_cj' required/>";
                                echo "</fieldset>";
                                echo "<br />";
                                echo "<input type='submit' value='Aceptar' class='boton' />";
                        echo "</form>";
		}

                if (isset($_POST['n_j_cj'])){
	                mysqli_query($con, "insert into usuario values(null,'".$_POST['n_u_cj']."',md5('".$_POST['p_u_cj']."'),null,0)");
                        $aux = mysqli_insert_id($con);

                        $id_e_q = $_POST['e_j_cj'];
                        if($_POST['e_j_cj'] == '-'){ 
                            $insertar = "insert into jurado values(null,'".$_POST['n_j_cj']."',".$aux.",null)";
                            $insertar_viejo = "insert into jurado_viejo select * from jurado where id_jurado=(select MAX(id_jurado) from jurado)";
			}
                        else{
                            $insertar = "insert into jurado values(null,'".$_POST['n_j_cj']."',".$aux.",$id_e_q)";
                            $insertar_viejo = "insert into jurado_viejo select * from jurado where id_jurado=(select MAX(id_jurado) from jurado)";
                        }
                        //echo $insertar;
                        //exit();
                        mysqli_query($con, $insertar);
                        mysqli_query($con, $insertar_viejo);
                        echo "<script>location.href='juries.php'</script>";
                }
?>
<!-- inside -->
</div>
<!-- info  -->
</div>
