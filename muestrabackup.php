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

                        $muestras = mysqli_query($con,"select * from muestra");
                        echo "<br />";
                        echo "<br />";
                        echo "<table class='data'>";
                        echo "<th>";
                        echo "ID";
                        echo "</th>";
                        echo "<th>";
                        echo "Muestra";
                        echo "</th>";
                        echo "<th>";
                        echo "Turno";
                        echo "</th>";
                        
                        while($muestra = mysqli_fetch_array($muestras)){
                                echo "<tr>";
                                echo "<td>";
                                echo $muestra['id_muestra'];
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='muestras.php?id_m=".$muestra['id_muestra']."&nom_m=".$muestra['nombre_muestra']."&turno_m=".$muestra['turno_muestra']."'>".$muestra['nombre_muestra']."</a>";
        			echo "</td>";
                                echo "<td>";
                                echo $muestra['turno_muestra'];
                                echo "</td>";
                                echo "</tr>";
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

                                $qms = mysqli_query($con,"select distinct q.id_queso, t.descripcion_tipo,q.codigo_queso 
                                        from puntaje p
                                        inner join muestra m on (p.id_muestra_puntaje = m.id_muestra)
                                        inner join queso q on (q.id_queso = p.id_queso)
                                        inner join tipo t on (q.id_tipo_queso = t.id_tipo)                                        
                                        where m.id_muestra = $get_id_m");

                                $qds = mysqli_query($con,"select distinct p.id_queso,t.descripcion_tipo, q.codigo_queso 
                                                        from puntaje p
                                                        inner join queso q on (q.id_queso = p.id_queso)
                                                        inner join tipo t on (q.id_tipo_queso = t.id_tipo)
                                                        where p.id_muestra_puntaje is null");


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
				echo "<label for='t_m_em'>Turno</label>";
                                echo "<input type='text' id='editar_codigo_queso' name='t_m_em' value='$get_turno_m' required autofocus/>";
                                echo "<br />";
                                echo "<br />";
				echo "</fieldset>";
                                echo "<table class='pasa'>";
                                echo "<th>";
                                echo "Queso en muestra";
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
                                echo "Queso a asignar";
                                echo "</th>";
                                while($qd = mysqli_fetch_array($qds)){
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<a href='asignarQueso.php?id_q=".$qd['id_queso']."&id_mues=$get_id_m'>".$qd['codigo_queso']." - ".$qd['descripcion_tipo']."</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                }
                                
                                echo "</table>";
                                echo "<br />";
                                echo "<br />";
                                echo "<br />";
                               

                                //ASIGNO LOS CAMPOS

                                $campos = mysqli_query($con,"select * from puntaje p 
                                                        inner join muestra m on (m.id_muestra = p.id_muestra_puntaje)
                                                        where m.id_muestra = $get_id_m
                                                        group by m.id_muestra");
                                $campos2 = mysqli_query($con,"select * from planilla_campo");
                                echo "<table class='pasa'>";
                                echo "<th>";
                                echo "Campos Asignados a muestra";
                                echo "</th>";
                                while($campo = mysqli_fetch_array($campos)){
                                        //$id_campo = $campo['id_campo'];
                                        //$n_campo = $campo['nombre_campo'];
                                        for($i = 1; $i < 25; $i++){       
                                                if ($campo['campo'.$i] != null){ //ESTO ES POR SI LA PLANILLA TIENE MENOS CAMPOS
                                                        echo "<tr>";
                                                        echo "<td>";
                                                        echo "<a href='desasignarCampos.php'>".$campo['campo'.$i]."</a>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                }
                                        }
                                }
                                echo "</table>";

                                echo "<table class='pasa'>";
                                echo "<th>";
                                echo "Campos Disponibles";
                                echo "</th>";
                                while($campo2 = mysqli_fetch_array($campos2)){
                                        $id_campo = $campo2['campo_id'];
                                        $n_campo = $campo2['nombre_campo'];
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<a href='asignarCampos.php?n_c=$n_campo&id_m=$get_id_m'>$n_campo</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                }
                                echo "</table>";
                                echo "<br />";
                                echo "<br />";

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
				echo "<label for='t_m_cm'>Turno</label>";
                                echo "<input type='text' id='crear_codigo_queso' name='t_m_cm' required />";

                                echo "</fieldset>";
                                echo "<br />";
                                echo "<input type='submit' value='Aceptar' class='boton' />";
                        echo "</form>";
		}

	?>
	<!-- inside -->
	</div>
