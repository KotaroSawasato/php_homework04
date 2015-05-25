<?php
session_start();
require_once('db_access.php');
$dbh = accessDB();
require_once('function.php');


//ログインフォームの値がデータベースの内容と一致するか調べる
$login_data['mail_address']=$_POST["login_address"];
$login_data['pass'] = md5($_POST["login_pass"]);
//フォームの値でデータベース検索	

$sql = "SELECT * FROM `user_info` where mail_address='".sec($login_data['mail_address'],$dbh)."' AND pass='".sec($login_data['pass'],$dbh)."';";


$stmt = $dbh->query($sql);

if(empty($stmt->fetch_assoc())){
	$_SESSION["login_check"] ="failed";

}else{
	$_SESSION["login_check"] ="success";
	//データベースに登録してある内容を表示
	foreach($dbh->query($sql) as $row){
		$_SESSION['h_name'] = $row['h_name'];
	}



}

?>
<html>
<head>
	<meta charset="UTF-8">
	<?php
	if($_SESSION["login_check"]=="success") {?>
	<meta http-equiv="refresh" content="0;URL=../php_homework04/index.php">
	<?php }else if($_SESSION["login_check"]=="failed"){ ?>
	<meta http-equiv="refresh" content="0;URL=../php_homework04/top.php">
	<?php } ?>
</head>
<body>
</body>
</html>