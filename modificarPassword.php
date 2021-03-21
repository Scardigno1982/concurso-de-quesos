<?php
        session_start();
        if(isset($_SESSION['login']) && !$_SESSION['is_Admin'])
                header("Location: index.php");
        else if (!isset($_SESSION['login']))
                header("Location: login.php");
?>
<html>



<head>
	<title>Concurso</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">	
	<link rel="stylesheet" type="text/css" href="css/style.css">	



</head>
<body>
<?php
	if(isset($_GET['id_u'])){

		$id_u = $_GET['id_u'];

		if(isset($_POST['pass_j'])){
			include "conexiones.php";
			$pass_j = $_POST['pass_j'];
			$id_u = $_POST['id_u'];
			$update = mysqli_query($con,"update usuario set pass_usuario = md5('$pass_j') where id_usuario = $id_u") or die(mysqli_error($con));
			echo "<script>";
			echo "window.opener.location.reload();";
			echo "window.self.close();";
			echo "</script>";
		}

		

			echo "<div id='inside'>";
			echo "<div id='peque'>";
			echo "<form action='' method='post'>";
				echo "<input type='hidden' value='$id_u' name='id_u' />";
				echo "<label for='pass_j'>Nuevo Password</label>";
				echo "<br />";
				echo "<input type='password' name='pass_j' />";
				echo "<br />";
				echo "<br />";
				echo "<input type='submit' value='Aceptar' />";
			echo "</form>";
			echo "</div>";
			echo "</div>";

			
		}
	

?>

</body>
</html>