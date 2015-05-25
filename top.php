<?php
session_start();
require_once('db_access.php');
$dbh = accessDB();

$data[0]=$_POST["h_name"];
$data[1]=$_POST["entry_address"];
$data[2]=$_POST["sex"];
$data[3]=$_POST["entry_pass1"];
$data[4]=$_POST["entry_pass2"];
$entry_flag=$_POST["entry_flag"];

?>
<html>
<head>
	<meta charset="UTF-8">
	<?php
	if($_SESSION['login_check']=="success")
		echo '<meta http-equiv="refresh" content="0;URL=../php_homework04/index.php"/>';
	?>


	<title>ログイン・新規登録</title>
</head>
<body>
	<h2>ログイン</h2>
	<?php
	if($_SESSION['login_check']=="failed"){ ?>
	<font color="red">メールアドレス・パスワードが間違っています</font>
	<?php } ?>
	<form method="post" action="login_check.php">
		メールアドレス：<input type="text" name="login_address"><br>
		パスワード：<input type="password" name ="login_pass"><br>
		<input type="submit" value="ログイン"><br>
	</form>
	<hr>
	<h2>新規登録</h2>
	<?php
	if($data[3] !== $data[4] && $_POST["entry_flag"]=="entry"){ ?>
	<font color="red">パスワードが一致しません</font>
	<?php }else if((empty($data[0]) || empty($data[1]) || empty($data[2]) || empty($data[3]) || empty($data[4])) && $_POST["entry_flag"]=="entry"){ ?>
	<font color="red">入力していないフォームがあります</font>

	<?php }else if(!empty($data[0]) && !empty($data[1]) && !empty($data[2]) && !empty($data[3] && $_POST["entry_flag"]=="entry")){
		$change_pass = md5($data[3]);
		$sql = "INSERT INTO `user_info` (`h_name`,`mail_address`,`sex`,`pass`) 
		VALUES ('".sec($data[0],$dbh)."','".sec($data[1],$dbh)."','".sec($data[2],$dbh)."','".sec($change_pass,$dbh)."');";
		$stmt = $dbh -> query($sql);
		echo "登録完了";
	} ?>

	<form method="post" action = "top.php">
		ハンドルネーム：<input type="text" name="h_name"><br>
		メールアドレス：<input type = "text" name ="entry_address"><br>
		性別：<input type="radio" name="sex" value="男" checked="checked">男
		<input type="radio" name="sex" value="女">女<br>
		パスワード：<input type="password" name ="entry_pass1"><br>
		パスワード(確認用)：<input type="password" name ="entry_pass2"><br>
		<input type="hidden" name="entry_flag" value="entry">
		<input type="submit" value="新規登録"><br>
	</form>
</body>
</html>
