		<div id="inside">	
		<?php

			$empresas = mysqli_query($con, "select * from empresa ORDER by nombre_empresa");
                        echo "<br />";
                        echo "<br />";
                        echo "<button class='boton-crear2' onclick='abrir()'>Crear Empresa Nueva</button>";
                        echo "<br />";
                        echo "<br />";
                        echo "<table class='data'>";
                        echo "<th>";
                        echo "ID";
                        echo "</th>";
                        echo "<th>";
                        echo "Empresa <span class='informacion'>(Click para editar)</span>";
                        echo "</th>";
                       
                        echo "<th>";
                        echo "Tipo";
                        echo "</th>";
                        
                        while($empresa = mysqli_fetch_array($empresas)){
                        echo "<tr>";
                        echo "<td>";
                        echo $empresa['id_empresa'];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='empresas.php?id_e=".$empresa['id_empresa']."&n_e=".$empresa['nombre_empresa']."&t_e=".$empresa['tipo_empresa']."'>";
                        echo $empresa['nombre_empresa'];
                        echo "</a>";
			echo "</td>";
                        
                        echo "<td>";
                        echo $empresa['tipo_empresa'];
                        echo "</td>";
                        echo "</tr>";
                        }
                        echo "</table>";
                        echo "<br />";
                        echo "<br />";

                        if(isset($_GET['id_e'])){
                                $id_e = $_GET['id_e'];
                                $n_e = $_GET['n_e'];
                                $t_e = $_GET['t_e'];

                                echo "<form action='editarEmpresa.php' method='post' >";
                                echo "<input type='hidden' name='id_emp' value='$id_e' />";
                                echo "<input type='text' name='nom_e' value='$n_e' required />";
                                echo "<select name='tipo_e'>";
                                        if($t_e == 'Gran'){
                                                echo "<option selected>Gran</option>";
                                                echo "<option>Pyme</option>";
                                                echo "<option>Micro Pyme</option>";
                                        }
                                        elseif ($t_e == 'Pyme'){
                                                echo "<option>Gran</option>";
                                                echo "<option selected>Pyme</option>";
                                                echo "<option>Micro Pyme</option>";
                                        }
                                        elseif ($t_e == 'Micro Pyme'){
                                                echo "<option>Gran</option>";
                                                echo "<option>Pyme</option>";
                                                echo "<option selected>Micro Pyme</option>";
                                        }
                                echo "</select>";
                                echo "<input type='submit' value='Aceptar' />";
                                echo "</form>";
                        }       

                                              

                       
				

	?>
	<!-- inside -->
	</div>
