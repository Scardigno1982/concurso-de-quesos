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
        function abrir(){
                open('agregarNuevoCampo.php','','top=300,left=300,width=300,height=150');
        }
        </script>
</head>
<body>

<div id="header"> 
                <img src="images/header.gif" id="banner" />
        </div>

        <div id="inside">
 
        <?php 

        include "sidebar2.php" ;
        echo "<br />";
        echo "<br />";
        echo "<br />";
        include "conexiones.php";
        if(isset($_GET['id_mesa'])){
                $id_mesa=$_GET['id_mesa'];
                $id_queso=$_GET['id_queso'];

                echo "<form action='updateCampos.php' method='post'>";

                echo "<input type='hidden' name='id_mesa' value='$id_mesa' />";
                echo "<input type='hidden' name='id_queso' value='$id_queso' />";

                $qms = mysqli_query($con,"select distinct q.id_queso, t.descripcion_tipo,q.codigo_queso, m.id_mesa 
                                                from puntaje p
                                                inner join queso q on (q.id_queso = p.id_queso)
                                                inner join tipo t on (q.id_tipo_queso = t.id_tipo)  
                                                inner join mesa m on (m.id_mesa = p.id_mesa)                                      
                                                where m.id_mesa=$id_mesa");

                if(mysqli_num_rows($qms) != 0){

                        $campos = mysqli_query($con,"select * from puntaje p 
                                inner join queso q on (q.id_queso = p.id_queso)
                                inner join mesa m on (m.id_mesa = p.id_mesa)
                                inner join categoria c on (c.id_categoria = q.id_categoria_queso)
                                inner join concurso con on (con.id_concurso = m.id_concurso_mesa)
                                where q.id_queso = $id_queso
                                and con.estado_concurso = 'Abierto'
                                group by p.id_queso");

                                while($campo = mysqli_fetch_array($campos)){
                                        echo "<div id='muchos_select'>"; //DIV MUCHOS SELECT
                                                
                                                for($i=1; $i<25; $i++){
                                                        if($campo['campo'.$i] != null){
                                                                if($i<=2){
                                                                        echo "<label for='s$i'>Apariencia Externa</label>";
                                                                }
                                                                elseif($i>2 && $i<=9){
                                                                        echo "<label for='s$i'>Apariencia Interna</label>";
                                                                }
                                                                elseif($i>9 && $i <=18){
                                                                        echo "<label for='s$i'>Flavor</label>";
                                                                }
                                                                elseif($i>18 && $i <=24){
                                                                        echo "<label for='s$i'>Textura</label>";
                                                                }
                                                                
                                                                $campos2 = mysqli_query($con,"select * from planilla_campo 
                                                                                        where nombre_campo <> '".$campo['campo'.$i]."'");

                                                                echo "<select name='s$i'>";
                                                                echo "<option>";
                                                                echo "-";
                                                                echo "</option>";
                                                                echo "<option selected='selected'>";
                                                                echo $campo['campo'.$i];
                                                                echo "</option>";

                                                                while($campo2 = mysqli_fetch_array($campos2)){
                                                                        
                                                                        if($campo2['seccion_campo'] == 'AE' && $i<=2){
                                                                                echo "<option>";
                                                                                echo $campo2['nombre_campo'];
                                                                                echo "</option>";
                                                                        }
                                                                        elseif($campo2['seccion_campo'] == 'AI' && $i>2 && $i<=9){
                                                                                echo "<option>";
                                                                                echo $campo2['nombre_campo'];
                                                                                echo "</option>";
                                                                        }
                                                                        elseif($campo2['seccion_campo'] == 'F' && $i>9 && $i <=18){
                                                                                echo "<option>";
                                                                                echo $campo2['nombre_campo'];
                                                                                echo "</option>";
                                                                        }
                                                                        elseif($campo2['seccion_campo'] == 'T' && $i>18 && $i <=24){
                                                                                echo "<option>";
                                                                                echo $campo2['nombre_campo'];
                                                                                echo "</option>";
                                                                        }
                                                                        
                                                                }
                                                                echo "</select>";
                                                        }
                                                } //FOR
                                                echo "</div>";//FIN DIV MUCHOS SELECT
                                                echo "<br />";
                                                echo "<br />";
                                                echo "<input type='submit' value='Aceptar' />";
                                                echo "<input type='button' onclick='abrir()'' value='Nuevo Campo' />";
                                                echo "</form>";

                                        }//WHILE
                                        } //CIERRA IF
        }//CIERRA ISSET

?>

</div>

        <?php include "footer.php" ?>
</body>
</html>
