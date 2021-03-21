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

	<script type='text/javascript' src='js/jquery-2.1.1.min.js'></script>
	<script type='text/javascript' src='js/jquery-ui.js'></script>
	<script type='text/javascript' src='js/main.js'></script>

	<script>

	function borrarj(id_j,id_m){
			if(confirm('Esta seguro que desea eliminar el Jurado de la mesa?')){
				window.location.href = "eliminarJuradoMesa.php?id_j="+id_j+"&id_m="+id_m;
			}
	}

	function borrarq(id_q,id_m){
			if(confirm('Esta seguro que desea eliminar el Queso de la mesa?')){
				window.location.href = "eliminarQuesoMesa.php?id_q="+id_q+"&id_m="+id_m;
			}
	}

	function abrir(idm){
			open("ordenJura.php?id_m="+idm,'','top=300,left=300,width=300,height=200');
	}

	function abrir2(idm){
			open("ordenQueso.php?id_m="+idm,'','top=300,left=300,width=300,height=200');
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
		<?php include "configure.php" ?>
	</div>

	<?php include "footer.php" ?>
</body>
</html>
