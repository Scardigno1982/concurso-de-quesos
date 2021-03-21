<?php

function allJuries(){
	$query = "select * from jurado";
	$juries = mysqli_query($con,$query);
	return $juries;
}

?>
