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
	<script>
	function borrarc(){
                        if(confirm('Esta seguro que desea eliminar el CONCURSO completo? Esta accion no se puede volver atras')){
                        	if(confirm('REALMENTE ESTA SEGURO?')){
                                	window.location.assign('eliminarConcurso.php?b=1');
				}
                        }
        }
	</script>

</head>
<body>

	<?php include "conexiones.php" ?>
	<?php include "funciones.php" ?>
	
	<div id="header"> 
                <img src="images/header.gif" id="banner" />
	</div>

	<div id="content">
		<?php include "sidebar2.php" ?>	
		<?php include "contest.php" ?>
	</div>

	<?php include "footer.php" ?>

</body>
</html>
