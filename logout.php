<?php
session_start();
require_once('db_access.php');
$dbh = accessDB();
?>
<html>
<head>

	<meta charset="UTF-8">
	<title>ログアウト</title>
</head>
<body>
	<?php
	if($_POST["logout_flag"]=="logout"){
		$SESSION[]=array();
		session_destroy();
		echo 'ログアウト中です。２秒後にトップページへ移動します';
		echo '<meta http-equiv="refresh" content="2;URL=../php_homework04/top.php"/>';
	}

	?>
	
</body>
</html>