<?php
session_start();
require_once('db_access.php');
$dbh = accessDB();
require_once('function.php');


$update_data['update_id'] = $_POST['update_id'];
$update_data['update_comment'] = $_POST['update_comment'];

if(!empty($update_data['update_comment'])){

	$sql = "UPDATE `comment` SET `comment` = '".sec($update_data['update_comment'],$dbh)."' WHERE id=".$update_data['update_id'].";";

	$stmt = $dbh -> query($sql);
	echo $sql;
	$_SESSION['update_check']="success";
}else{
	$_SESSION['update_check']="failed";
}


?>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="0;URL=../php_homework04/index.php">
</head>
<body>
</body>
</html>