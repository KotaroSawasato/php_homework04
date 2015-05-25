<?php
session_start();
require_once('db_access.php');
$dbh = accessDB();
require_once('function.php');


$delete_data['delete_id'] = $_POST['delete_id'];

if(!empty($delete_data['delete_id'])){
	$sql = "DELETE FROM `comment` WHERE id=".$delete_data['delete_id'].";";
	$stmt = $dbh -> query($sql);
	$_SESSION['delete_check']="success";
}else{
	$_SESSION['delete_check']="failed";
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