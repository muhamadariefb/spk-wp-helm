<?php

$mysqli = new mysqli("localhost","root","","spk-wp-helm");
	if($mysqli->connect_errno){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}

?>