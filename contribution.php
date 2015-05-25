<?php
session_start();
require_once('db_access.php');
$dbh = accessDB();
require_once('function.php');

$contribution_data['h_name']=$_SESSION['h_name'];
$contribution_data['comment']=$_POST['comment'];

if(!empty($contribution_data['comment'])){
	$sql = "INSERT INTO `comment` (`h_name`,`comment`) 
	VALUES ('".sec($contribution_data['h_name'],$dbh)."','".sec($contribution_data['comment'],$dbh)."');";
	$stmt = $dbh -> query($sql);
	$_SESSION['contribution_check']="success";
}else{
	$_SESSION['contribution_check']="failed";
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