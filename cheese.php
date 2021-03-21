                <div id="inside">       
                <?php
                        $quesos = mysqli_query($con, "select q.id_queso, q.codigo_queso, q.nacionalidad_queso, e.nombre_empresa, 
                                                e.tipo_empresa,c.descripcion_categoria, t.descripcion_tipo, q.id_tipo_queso, 
                                                q.id_categoria_queso, q.id_empresa_queso 
                                                from queso q 
                                                inner join categoria c on (q.id_categoria_queso = c.id_categoria)
                                                inner join tipo t on (t.id_tipo = q.id_tipo_queso) 
                                                left join empresa e on (e.id_empresa = q.id_empresa_queso)
                                                   order by q.codigo_queso ");
                        echo "<br />";
                        echo "<br />";
                        echo "<button class='boton-crear2'><a href='cheeses.php?isCreate=1' id='bcc'>Crear Queso Nuevo</a></button>";
                        echo "<button class='boton-crear2' onclick='abrir3()'>Traer Quesos Anteriores</button>";
                        echo "<button class='boton-crear2' onclick='abrir1()'>Crear Nuevo Tipo</button>";
                        echo "<button class='boton-crear2' onclick='abrir2()'>Crear Nueva Categoria</button>";
                        echo "<br />";
                        echo "<br />";
                        echo "<table id='cheese' class='data'>";
                        echo "<th>";
                        echo "Codigo";
                        echo "</th>";
                        echo "<th>";
                        echo "Empresa";
                        echo "</th>";
                        echo "<th>";
                        echo "Tipo Empresa";
                        echo "</th>";
                        echo "<th>";
                        echo "Categoria";
                        echo "</th>";
                        echo "<th>";
                        echo "Tipo";
                        echo "</th>";
                        echo "<th>";
                        echo "Nacionalidad";
                        echo "</th>";
                        echo "<th>";
                        echo "Eliminar";
                        echo "</th>";
                        while($queso = mysqli_fetch_array($quesos)){
                        echo "<tr>";
                        echo "<td>";
                        echo "<a href='cheeses.php?id_q=".$queso['id_queso']."&cod_q=".$queso['codigo_queso']."&cat_q=".$queso['id_categoria_queso']."&tipo_q=".$queso['id_tipo_queso']."&emp_q=".$queso['id_empresa_queso']."'>".$queso['codigo_queso']."</a>";
                        echo "</td>";
                        echo "<td>";
                        echo $queso['nombre_empresa'];
                        echo "</td>";
                        echo "<td>";
                        echo $queso['tipo_empresa'];
                        echo "</td>";
                        echo "<td>";
                        echo $queso['descripcion_categoria'];
                        echo "</td>";
                        echo "<td>";
                        echo $queso['descripcion_tipo'];
                        echo "</td>";
                        echo "<td>";
                        echo $queso['nacionalidad_queso'];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='eliminarQueso.php?id_q=".$queso['id_queso']."'>X</a>";
                        echo "</td>";
                        echo "</tr>";
                        }
                        echo "</table>";
                       
                        echo "<br />";
                        echo "<br />";

                        $empresas = mysqli_query($con, "select * from empresa ORDER BY nombre_empresa");
                        $categorias = mysqli_query($con, "select * from categoria");
                        $tipos = mysqli_query($con, "select * from tipo ORDER BY descripcion_tipo");

                        if (isset($_GET['id_q'])){
                                echo "<div class='ir'></div>";
                                $get_id_q=$_GET['id_q'];
                                $get_cod_q=$_GET['cod_q'];
                                $get_cat_q=$_GET['cat_q'];
                                $get_tipo_q=$_GET['tipo_q'];
                                $get_emp_q=$_GET['emp_q'];


                                echo "<br />";
                                echo "<br />";
                                echo "<form id='form-cc' action='updateQueso.php' method='post'>";
                                echo "<fieldset class='inputs'>";

                                #CAMPOS INVISIBLES
                                echo "<input type='hidden' name='id_q_eq' value='$get_id_q' />";
                                #FIN CAMPOS

                                echo "<label for='cod_q_cq'> Codigo </label>";
                                echo "<input type='text' id='editar_codigo_queso' name='cod_q_eq' value='$get_cod_q' required autofocus/>";
                                echo "<br />";
                                echo "<br />";
                                echo "<label for='e_q_eq'>Empresa</label>";
                                echo "<select name='e_q_eq'>";
                                while ($empresa = mysqli_fetch_array($empresas)){
                                                if ($empresa['id_empresa'] == $get_emp_q){
                                                        echo "<option value=".$empresa['id_empresa']." selected>".$empresa['nombre_empresa']." - ".$empresa['tipo_empresa']."</option>";
                                                }
                                                else
                                                        echo "<option value=".$empresa['id_empresa']." >".$empresa['nombre_empresa']." - ".$empresa['tipo_empresa']."</option>";
                                }

                                echo "</select>";
                                echo "<label for='c_q_eq'>Categoria</label>";
                                echo "<select name='c_q_eq'>";
                                        while ($categoria = mysqli_fetch_array($categorias)){
                                                if ($categoria['id_categoria'] == $get_cat_q){
                                                        echo "<option value=".$categoria['id_categoria']." selected>".$categoria['descripcion_categoria']."</option>";
                                                }
                                                else
                                                        echo "<option value=".$categoria['id_categoria']." >".$categoria['descripcion_categoria']."</option>";
                                        }

                                echo "</select>";
                                
                                echo "<label for='tipo_q_eq'>Tipo</label>";
                                echo "<select name='tipo_q_eq' Tipo>";
                                        while ($tipo = mysqli_fetch_array($tipos)){
                                                if($tipo['id_tipo'] == $get_tipo_q)
                                                        echo "<option value=".$tipo['id_tipo']." selected>".$tipo['descripcion_tipo']."</option>";
                                                else
                                                        echo "<option value=".$tipo['id_tipo'].">".$tipo['descripcion_tipo']."</option>";
                                        }
                                echo "</select>";

                                echo "</fieldset>";
                                echo "<br />";
                                echo "<input type='submit' value='Aceptar' class='boton' />";
                        echo "</form>"; 
                }       
                elseif (isset ($_GET['isCreate'])){
                        echo "<br />";
                        echo "<br />";
                        echo "<form id='form-cc' action='createQueso.php' method='post'>";
                                echo "<fieldset class='inputs'>";
                                echo "<label for='c_q_cq'> Codigo </label>";
                                echo "<input type='text' id='crear_codigo_queso' name='c_q_cq' required autofocus/>";
                                echo "<br />";
                                echo "<br />";
                                echo "<label for='e_q_cq'>Empresa</label>";
                                echo "<select name='e_q_cq' Empresa>";
                                
                                        while ($empresa = mysqli_fetch_array($empresas)){
                                                echo "<option value=".$empresa['id_empresa'].">".$empresa['nombre_empresa']." - ".$empresa['tipo_empresa']."</option>";
                                        }
                                echo "</select>";
                                
                                echo "<label for='cat_q_cq'>Categoria</label>";
                                echo "<select name='cat_q_cq' Categoria>";
                                        while ($categoria = mysqli_fetch_array($categorias)){
                                                echo "<option value=".$categoria['id_categoria'].">".$categoria['descripcion_categoria']."</option>";
                                        }
                                echo "</select>";

                                echo "<label for='tipo_q_cq'>Tipo</label>";
                                echo "<select name='tipo_q_cq' Tipo>";
                                        while ($tipo = mysqli_fetch_array($tipos)){
                                                echo "<option value=".$tipo['id_tipo'].">".$tipo['descripcion_tipo']."</option>";
                                        }
                                echo "</select>";

                                echo "<label for='n_q_cq'> Nacionalidad </label>";
                                echo "<input type='text' id='crear_codigo_queso' name='n_q_cq' required />";

                                echo "</fieldset>";
                                echo "<br />";
                                echo "<input type='submit' value='Aceptar' class='boton' />";
                        echo "</form>";
                }

        ?>
        <!-- inside -->

        <script language="javascript" type="text/javascript"> 


        var tablaclientes_Props =  {                                    
                                        col_0: "select", 
                                        col_1: "select",
                                        col_2: "select", 
                                        col_3: "select",
                                        col_4: "select", 
                                        col_5: "select",
                                        col_6: "select", 
                                        col_7: "select",
                                        col_8: "select",
                                        display_all_text: " [ Seleccionar ] ", 
                                        sort_select: true 
                                }; 
        
        var tf = setFilterGrid( "cheese",tablaclientes_Props ); 

        
   

        </script>
        </div>
