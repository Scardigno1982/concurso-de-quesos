<div id="inside">	
		<?php
			$quesos = mysqli_query($con, "select q.id_queso, q.codigo_queso, q.nacionalidad_queso, e.nombre_empresa, 
                                                c.descripcion_categoria, t.descripcion_tipo, q.id_tipo_queso, q.id_categoria_queso, 
                                                q.id_empresa_queso 
                                                from queso q 
                                                inner join categoria c on (q.id_categoria_queso = c.id_categoria)
                                                inner join tipo t on (t.id_tipo = q.id_tipo_queso) 
                                                inner join empresa e on (e.id_empresa = q.id_empresa_queso)
					           order by q.id_queso asc");

                        $muestras = mysqli_query($con,"select * from muestra m
                                    inner join concurso c on (c.id_concurso = m.id_concurso_muestra) 
                                    where c.estado_concurso = 'Abierto'");

                        echo "<br />";
                        echo "<br />";
                        echo "<table class='data'>";
                        echo "<th>";
                        echo "ID";
                        echo "</th>";
                        echo "<th>";
                        echo "Muestra <span class='informacion'>(Click para editar Muestra)</span>";
                        echo "</th>";
                        
                        $cas = mysqli_query($con,"select * from concurso where estado_concurso='Abierto'");
                        while($ca = mysqli_fetch_array($cas)){
                            $concurso_actual = $ca['id_concurso'];
                        }
                        
                        while($muestra = mysqli_fetch_array($muestras)){
                                echo "<tr>";
                                echo "<td>";
                                echo $muestra['id_muestra'];
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='muestras.php?id_m=".$muestra['id_muestra']."&nom_m=".$muestra['nombre_muestra']."&turno_m=".$muestra['turno_muestra']."'>".$muestra['nombre_muestra']."</a>";
        		              	echo "</td>";
                                
                                echo "</tr>";
                        /////////////////////////////////
                        //TRAIGO EL ID DEL CONCURSO ACTUAL
                        
                        ///////////////////////////////////////
                        }
                        
                        echo "</table>";
		              	echo "<button class='boton-crear'><a href='muestras.php?isCreate=1' id='bcc'>Crear Muestra Nueva</a></button>";
                        echo "<br />";
                        echo "<br />";

                        echo "<br />";
                        echo "<br />";

                        $empresas = mysqli_query($con, "select * from empresa");
                        $categorias = mysqli_query($con, "select * from categoria");
                        $tipos = mysqli_query($con, "select * from tipo");		

			if (isset($_GET['id_m'])){
				echo "<div class='ir'></div>";
                                $get_id_m=$_GET['id_m'];
                                $get_nom_m=$_GET['nom_m'];
                                $get_turno_m=$_GET['turno_m'];

                                $qms = mysqli_query($con,"select distinct q.id_queso, t.descripcion_tipo,q.codigo_queso, m.id_mesa 
                                        from puntaje p
                                        inner join muestra mu on (p.id_muestra_puntaje = mu.id_muestra)
                                        inner join queso q on (q.id_queso = p.id_queso)
                                        inner join tipo t on (q.id_tipo_queso = t.id_tipo)  
                                        inner join mesa m on (m.id_mesa = p.id_mesa)                                      
                                        where mu.id_muestra = $get_id_m");

                                echo "<br />";
                                echo "<br />";
                                echo "<form id='form-cc' action='updateMuestra.php' method='post'>";
                                echo "<fieldset class='inputs'>";

                                #CAMPOS INVISIBLES
                                echo "<input type='hidden' name='id_m_em' value='$get_id_m' />";
                                #FIN CAMPOS

                                echo "<label for='n_m_em'> Nombre </label>";
                                echo "<input type='text' id='editar_codigo_queso' name='n_m_em' value='$get_nom_m' required autofocus/>";
                				echo "<br />";
                				echo "<br />";
                				
                                echo "<br />";
                                echo "<br />";
                				echo "</fieldset>";

                                echo "<table class='pasa'>";
                                echo "<th>";
                                echo "Queso en muestra <span class='informacion'>(Click para desasignar)</span>";
                                echo "</th>";
                                while($qm = mysqli_fetch_array($qms)){
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<a href='desasignarQueso.php?id_q=".$qm['id_queso']."&id_mues=$get_id_m'>".$qm['codigo_queso']." - ".$qm['descripcion_tipo']."</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                }
                                echo "</table>";
                                echo "<table class='pasa'>";
                                echo "<th>";
                                echo "Queso a asignar <span class='informacion'>(Click para asignar)</span>";
                                echo "</th>";
                                //$consultar_concurso = mysqli_query($con,"select id_concurso from concurso where estado_concurso = 'Abierto'");
                                //$id_conc = mysqli_fetch_row($consultar_concurso);
                                //$id_concurso = $id_conc[0];
                                $qms = mysqli_query($con,"select distinct q.id_queso, t.descripcion_tipo,q.codigo_queso, m.id_mesa 
                                        from puntaje p
                                        inner join muestra mu on (p.id_muestra_puntaje = mu.id_muestra)
                                        inner join queso q on (q.id_queso = p.id_queso)
                                        inner join tipo t on (q.id_tipo_queso = t.id_tipo)  
                                        inner join mesa m on (m.id_mesa = p.id_mesa)                                      
                                        where mu.id_muestra = $get_id_m");
                                
                                if(mysqli_num_rows($qms) != 0){
                                    while($asig = mysqli_fetch_array($qms)){
                                                $mesa_muestra = $asig['id_mesa'];
                                    }            
                                                $qds = mysqli_query($con,"select distinct p.id_queso,t.descripcion_tipo, q.codigo_queso 
                                                                from puntaje p
                                                                inner join queso q on (q.id_queso = p.id_queso)
                                                                inner join tipo t on (q.id_tipo_queso = t.id_tipo)
                                                                where p.id_muestra_puntaje is null
                                                                and p.id_mesa = $mesa_muestra");

                                        while($qd = mysqli_fetch_array($qds)){
                                                echo "<tr>";
                                                echo "<td>";
                                                echo "<a href='asignarQueso.php?id_q=".$qd['id_queso']."&id_mues=$get_id_m&id_mesa=$mesa_muestra'>".$qd['codigo_queso']." - ".$qd['descripcion_tipo']."</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                        }
                                
                                }
                                else{
                                       $cons = mysqli_query($con,"select * from puntaje p
                                                inner join mesa m on (m.id_mesa = p.id_mesa)
                                                inner join queso q on (q.id_queso = p.id_queso)
                                                inner join tipo t on (t.id_tipo = q.id_tipo_queso)
                                                inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
                                                where c.estado_concurso = 'Abierto'
                                                and p.id_muestra_puntaje is null
                                                group by q.id_queso");
                                       while($con = mysqli_fetch_array($cons)){
                                                echo "<tr>";
                                                echo "<td>";
                                                echo "<a href='asignarQueso.php?id_q=".$con['id_queso']."&id_mues=$get_id_m&id_mesa=".$con['id_mesa']."'>".$con['codigo_queso']." - ".$con['descripcion_tipo']."</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                        }

                                }

                                
                                echo "</table>";
                                echo "<br />";
                                echo "<br />";
                                echo "<br />";
                               

                                //ASIGNO LOS CAMPOS

                               
                                echo "<input type='submit' value='Aceptar' class='boton' />";
                                echo "</form>";	
		        }	
		elseif (isset ($_GET['isCreate'])){
                        echo "<br />";
                        echo "<br />";
			echo "<form id='form-cc' action='createMuestra.php' method='post'>";
                                echo "<fieldset class='inputs'>";
                                echo "<label for='n_m_cm'> Nombre Muestra </label>";
                                echo "<input type='text' id='crear_codigo_queso' name='n_m_cm' required autofocus/>";
				echo "<br />";
				echo "<br />";
				
                                echo "<input type='hidden' id='crear_muestra_concurso' name='c_m_cm' value='$concurso_actual' />";

                                echo "</fieldset>";
                                echo "<br />";
                                echo "<input type='submit' value='Aceptar' class='boton' />";
                        echo "</form>";
		}

	?>
	<!-- inside -->
	</div>
