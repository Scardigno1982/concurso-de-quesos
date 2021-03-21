<?php
        session_start();
        if (!isset($_SESSION['login']))
                header("Location: login.php");
?>

<?php
			
		include "conexiones.php";

		$jurados=mysqli_query($con, "select j.id_jurado 'id', j.nombre_jurado 'nombre'
										from jurado j
										inner join puntaje p on j.id_jurado = p.id_jurado
										where p.id_jurado <>".$_SESSION['id_jurado']); //cambiar el 1 por el id jurado del coordinador


		$aux2 = 1;
			while($jurado = mysqli_fetch_array($jurados)){
				$aux2++;
				$texto1='campo1'.$aux2;
				$texto2='campo2'.$aux2;
				$texto4='campo4'.$aux2;
				$texto5='campo5'.$aux2;
				$texto10='campo10'.$aux2;
				$texto13='campo13'.$aux2;
				$texto14='campo14'.$aux2;
				$texto15='campo15'.$aux2;
				$texto16='campo16'.$aux2;
				$texto17='campo17'.$aux2;
				$texto18='campo18'.$aux2;
				$texto19='campo19'.$aux2;
				$texto20='campo20'.$aux2;
				$texto21='campo21'.$aux2;
				$texto23='campo23'.$aux2;
				$texto24='campo24'.$aux2;
				$texto25='campo25'.$aux2;
				$texto26='campo26'.$aux2;
				$texto27='campo27'.$aux2;
				$texto28='campo28'.$aux2;
												
			$update2="update puntaje set ae_1=".$_POST[$texto1].", ae_2=".$_POST[$texto2]." 
									,ai_1=".$_POST[$texto4].", ai_2=".$_POST[$texto5].", ai_7=".$_POST[$texto10]."
									,flavor_1=".$_POST[$texto13].", flavor_2=".$_POST[$texto14].", flavor_3=".$_POST[$texto15].", flavor_4=".$_POST[$texto16].", flavor_5=".$_POST[$texto17].", flavor_6=".$_POST[$texto18].", flavor_7=".$_POST[$texto19].", flavor_8=".$_POST[$texto20].", flavor_9=".$_POST[$texto21]."
									,textura_1=".$_POST[$texto23].", textura_2=".$_POST[$texto24].", textura_3=".$_POST[$texto25].", textura_4=".$_POST[$texto26].", textura_5=".$_POST[$texto27].", textura_6=".$_POST[$texto28]."
									,obs1='".$_POST[$obs1]."', obs2='".$_POST[$obs2]."', obs3='".$_POST[$obs3]."', obs4='".$_POST[$obs4]."', obs5='".$_POST[$obs5]."', obs6='".$_POST[$obs6]."', obs7='".$_POST[$obs7]."', obs8='".$_POST[$obs8]."', obs9='".$_POST[$obs9]."', obs10='".$_POST[$obs10]."', obs11='".$_POST[$obs11]."', obs12='".$_POST[$obs12]."
									',obs13='".$_POST[$obs13]."', obs14='".$_POST[$obs14]."', obs15='".$_POST[$obs15]."', obs16='".$_POST[$obs16]."', obs17='".$_POST[$obs17]."', obs18='".$_POST[$obs18]."', obs19='".$_POST[$obs19]."', obs20='".$_POST[$obs20]."', obs21='".$_POST[$obs21]."', obs22='".$_POST[$obs22]."', obs23='".$_POST[$obs23]."', obs24='".$_POST[$obs24]."
									where id_mesa=".$_POST['id_mesa']."
									and id_queso=".$_POST['id_queso']."
									and id_jurado=".$jurado[0];
			mysqli_query($con, $update2);
			} 


		$id_coordinador=$_SESSION['id_jurado'];

		$campo1c=$_POST['campo1c'];
		$campo2c=$_POST['campo2c'];
		$campo4c=$_POST['campo4c'];
		$campo5c=$_POST['campo5c'];
		$campo10c=$_POST['campo10c'];
		$campo13c=$_POST['campo13c'];
		$campo14c=$_POST['campo14c'];
		$campo15c=$_POST['campo15c'];
		$campo16c=$_POST['campo16c'];
		$campo17c=$_POST['campo17c'];
		$campo18c=$_POST['campo18c'];
		$campo19c=$_POST['campo19c'];
		$campo20c=$_POST['campo20c'];
		$campo21c=$_POST['campo21c'];
		$campo23c=$_POST['campo23c'];
		$campo24c=$_POST['campo24c'];
		$campo25c=$_POST['campo25c'];
		$campo26c=$_POST['campo26c'];
		$campo27c=$_POST['campo27c'];
		$campo28c=$_POST['campo28c'];
		$obs1c=$_POST['obs1c'];
		$obs2c=$_POST['obs2c'];
		$obs3c=$_POST['obs3c'];
		$obs4c=$_POST['obs4c'];
		$obs5c=$_POST['obs5c'];
		$obs9c=$_POST['obs9c'];
		$obs11c=$_POST['obs11c'];
		$obs12c=$_POST['obs12c'];
		$obs13c=$_POST['obs13c'];
		$obs14c=$_POST['obs14c'];
		$obs15c=$_POST['obs15c'];
		$obs16c=$_POST['obs16c'];
		$obs17c=$_POST['obs17c'];
		$obs18c=$_POST['obs18c'];
		$obs19c =$_POST['obs19c'];
		$obs20c =$_POST['obs20c'];
		$obs21c =$_POST['obs21c'];
		$obs22c =$_POST['obs22c'];
		$obs23c =$_POST['obs23c'];
		$obs24c =$_POST['obs24c'];
	
		$update="update puntaje set ae_1=".$campo1c.", ae_2=".$campo2c." 
									,ai_1=".$campo4c.", ai_2=".$campo5c.", ai_7=".$campo10c."
									,flavor_1=".$campo13c.", flavor_2=".$campo14c.", flavor_3=".$campo15c.", flavor_4=".$campo16c.", flavor_5=".$campo17c.", flavor_6=".$campo18c.", flavor_7=".$campo19c.", flavor_8=".$campo20c.", flavor_9=".$campo21c."
									,textura_1=".$campo23c.", textura_2=".$campo24c.", textura_3=".$campo25c.", textura_4=".$campo26c.", textura_5=".$campo27c.", textura_6=".$campo28c."
									,obs1='".$obs1c."', obs2='".$obs2c."', obs3='".$obs3c."', obs4='".$obs4c."', obs5='".$obs5c."', obs9='".$obs9c."', obs10='".$obs10c."', obs11='".$obs11c."', obs12='".$obs12c."'
									,obs13='".$obs13c."', obs14='".$obs14c."', obs15='".$obs15c."', obs16='".$obs16c."', obs17='".$obs17c."', obs18='".$obs18c."', obs19='".$obs19c."', obs20='".$obs20c."', obs21='".$obs21c."', obs22='".$obs22c."', obs23='".$obs23c."', obs24='".$obs24c."'
									where id_mesa=".$_POST['id_mesa']."
									and id_queso=".$_POST['id_queso']."
									and id_jurado=".$id_coordinador;
		
			mysqli_query($con, $update) or die(mysqli_error($con));

			header("Location: index.php");


?>
