<?php
        // Create connection
        $db_charset = 'UTF8';

        $con=mysqli_connect("localhost","concurso-de-quesos","root","");
        mysqli_set_charset($con, $db_charset);
        // Check connection
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
?>
