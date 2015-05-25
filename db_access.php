<?php

function accessDB(){

	$db_host="localhost";
	$user_name="root";
	$user_pass="root";
	$db_name="php_homework04";
	
	try {
		return new mysqli($db_host,$user_name,$user_pass,$db_name);
	} catch (PDOException $e) {
		echo $e->getMessage();
		exit;
	}

}

?>