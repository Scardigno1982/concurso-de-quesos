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

	<link rel="stylesheet" type="text/css" href="TableFilter/filtergrid.css" media="screen" />
    <script type="text/javascript" src="TableFilter/tablefilter.js"></script>	

    <script>
    function abrir1(){
            open('agregarNuevoTipo.php','','top=300,left=300,width=300,height=200');
    }
    function abrir2(){
            open('agregarNuevaCategoria.php','','top=300,left=300,width=300,height=200');
    }
    function abrir3(){
            open('traerQuesosAnteriores.php','','top=300,left=300,width=800,height=300');
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
		<?php include "cheese.php" ?>
	</div>

	<?php include "footer.php" ?>
</body>
</html>
