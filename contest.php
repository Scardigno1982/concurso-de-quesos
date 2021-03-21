		<div id="inside">	
		<?php
			$concursos=mysqli_query($con,"select * from concurso where estado_concurso='Abierto'");
			echo "<br />";
			echo "<br />";
			echo "<table class='data'>";
			echo "<th> Nombre <span class='informacion'>(Click para editar)</span></th>";
			echo "<th> Lugar </th>";
			echo "<th> Estado </th>";
			//echo "<th> En curso";
			while($concurso = mysqli_fetch_array($concursos)){
				echo "<tr>";
				echo "<td>";
				echo "<a href='crearConcurso2.php?id_c=".$concurso['id_concurso']."&nom_c=".$concurso['nombre_concurso']."&l_c=".$concurso['lugar_concurso']."&e_c=".$concurso['estado_concurso']."'>".$concurso['nombre_concurso']."</a>";
				echo "</td>";
				echo "<td>";
				echo $concurso['lugar_concurso'];
				echo "</td>";
				echo "<td>";
				echo $concurso['estado_concurso'];
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<button class='boton-crear'><a href='crearConcurso2.php?isCreate=1' id='bcc'>Crear Concurso Nuevo</a></button>";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			
		
	if ( isset($_GET['id_c'])){		
		$id_c = $_GET['id_c'];
		$nom_c = $_GET['nom_c'];
		$l_c = $_GET['l_c'];
		$e_c = $_GET['e_c'];
		echo "
		<form action='updateConcurso.php' method='POST' id='form-cc'>
			<fieldset class='inputs'>
			<input type='hidden' name='id_c_ec' value=$id_c />
			<label for='nombre_concurso'>Nombre Concurso:</label>
			<input type='text' id='nombre_concurso' value='$nom_c' name='n_c_ec' autofocus required/>
			<label for='lugar_concurso'>Lugar: </label>
			<input type='text' id='lugar_concurso' value='$l_c' name='l_c_ec' required/>";

			echo "</fieldset>
			<br />
			
			<input type='submit' class='boton' value='Guardar' class='guardar_concurso' />
                        <input type='reset' class='boton' value='Limpiar' class='limpiar_concurso' />
			<br />
			<br />
			<br />
			<br />
			<button class='boton-crear2'><a href='#' onclick='borrarc()'>ELIMINAR CONCURSO!!</a></button>
		
		</form>";

		
			
	}
	elseif (isset ($_GET['isCreate'])){
		echo "
		<form action='' method='POST' id='form-cc'>
                        <fieldset class='inputs'>
                        <label for='nombre_concurso'>Nombre Concurso: </label>
                        <input type='text' id='nombre_concurso' name='nombre_concurso' autofocus required/>

                        <label for='lugar_concurso'>Lugar: </label>
                        <input type='text' id='lugar_concurso' name='lugar_concurso' required/>

                        <!--<label for='fecha_concurso'>Fecha: </label>
                        <input type='date' id='fecha_concurso' name='fecha_concurso' required/>-->
                        </fieldset>
                        <br />

                        <input type='submit' class='boton' value='Guardar' class='guardar_concurso' />
                        <input type='reset' class='boton' value='Limpiar' class='limpiar_concurso' />
                </form>";
	}

	if (isset($_POST['nombre_concurso'])) {
		$concursos_abiertos = mysqli_query($con,"select * from concurso where estado_concurso='Abierto'");
		if(mysqli_num_rows($concursos_abiertos) == 0){
			$nom = $_POST['nombre_concurso'];
			$lugar= $_POST['lugar_concurso'];
        	$insert="insert into concurso values(null,'$nom','Abierto','$lugar')";
            mysqli_query($con, $insert) or die (mysqli_error($con));
        }
        else{
        	echo "<br />";
        	echo "No puede crear un concurso hasta cerrar el que ya esta abierto";
        	exit();
        }
                header("Location: crearConcurso2.php");
    }
	?>
	<!-- inside -->
	</div>
