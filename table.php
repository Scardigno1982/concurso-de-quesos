		<div id="inside">	
		<?php
			$mesas = mysqli_query($con,"select m.id_mesa, m.nombre_mesa, c.nombre_concurso from mesa m
                                                inner join concurso c on (c.id_concurso = m.id_concurso_mesa)
                                                where c.estado_concurso='Abierto'");
                        echo "<br />";
                        echo "<br />";
                        echo "<table class='data'>";
                        echo "<th>";
                        echo "Mesa <span class='informacion'>(Click para Editar)</span>";
                        echo "</th>";
                        echo "<th>";
                        echo "Concurso";
                        echo "</th>";
                        echo "<th>";
                        echo "Eliminar";
                        echo "</th>";
                        while($mesa = mysqli_fetch_array($mesas)){
                        echo "<tr>";
                        echo "<td>";
                        echo "<a href='tables.php?id_m=".$mesa['id_mesa']."&n_m=".$mesa['nombre_mesa']."'>".$mesa['nombre_mesa']."<a/>";
                        echo "</td>";
                        echo "<td>";
                        echo $mesa['nombre_concurso'];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='eliminarMesa.php?id_m=".$mesa['id_mesa']."' onclick=\"return confirm('Se borrara la Mesa, Continuar?')\">X</a>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</li>";
                        }
                        echo "</table>";
			echo "<button class='boton-crear'><a href='tables.php?isCreate=1' id='bct'>Crear Mesa Nueva</a></button>";
                        echo "<br />";
                        echo "<br />";
                        echo "<br />";	
		
	if (isset($_GET['id_m']) && isset($_GET['n_m'])){
                                $get_id_m=$_GET['id_m'];
                                $get_n_m=$_GET['n_m'];
                                echo "<form id='form-cc' action='updateMesa.php' method='post'>";
                                        echo "<fieldset class='inputs'>";
                                        echo "<label for='id_m_em'>ID Mesa </label>";
                                        echo "<input type='text' id='editar_id_mesa' name='id_m_em' value=".$get_id_m." readonly />";
                                        echo "<label for='n_m_em'> Nombre Mesa </label>";
                                        echo "<input type='text' id='editar_nombre_mesa' name='n_m_em' value='".$get_n_m."' required autofocus />";
                                        echo "</fieldset>";
                                        echo "<br />";
                                        echo "<input type='submit' value='Aceptar' class='boton' />";
                                echo "</form>";
                        }
	elseif (isset ($_GET['isCreate'])){
		echo "<form id='form-cc' action='' method='post'>";
				$consulta = mysqli_query($con, "select * from concurso where estado_concurso='Abierto'");
                                echo "<fieldset class='inputs'>";
                                echo "<label for='n_m_cm'> Nombre Mesa </label>";
                                echo "<input type='text' id='crear_nombre_mesa' name='n_m_cm' required autofocus/>";
                                echo "<select name='id_c_cm'>";
                                while ($conc_abierto = mysqli_fetch_array($consulta)){
                                        $c_n = $conc_abierto['nombre_concurso'];
                                        $id_c = $conc_abierto['id_concurso'];
                                        echo "<option value='$id_c'>$c_n</option>";
                                }
                                echo "</select>";
                                echo "</fieldset>";
                                echo "<br />";
                                echo "<input type='submit' value='Aceptar' class='boton' />";
                        echo "</form>";
	}

	if (isset($_POST['n_m_cm'])) {
		$nom = $_POST['n_m_cm'];
		$id_c = $_POST['id_c_cm'];
        	$insert="insert into mesa(id_mesa,id_concurso_mesa,nombre_mesa) values(null,$id_c,'$nom')";
                mysqli_query($con, $insert) or die (mysqli_error($con));
                header("Location: tables.php");
        }
	?>
	<!-- inside -->
	</div>
