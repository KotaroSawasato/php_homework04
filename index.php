<?php
session_start();
require_once('db_access.php');
$dbh = accessDB();
require_once('function.php');



?>
<html>
<head>
	<meta charset="UTF-8">
	<title>掲示板</title>
</head>
<body>
	<!-- ログイン情報表示 -->
	ログインしています<br>
	ユーザーネーム：
	<?php 
	echo $_SESSION['h_name']."<br/>";

	// 投稿メッセージ
	if($_SESSION['contribution_check'] == "success"){ ?>
	<font color="red">コメントを投稿しました</font><br />
	<?php unset($_SESSION['contribution_check']);
}
if($_SESSION['contribution_check'] == "failed"){ ?>
<font color="red">コメントの投稿に失敗しました</font><br/>
<?php unset($_SESSION['contribution_check']);
}　?>

<!-- 投稿フォーム -->
<form method="post" action="contribution.php">
	<TEXTAREA name="comment" rows="3" cols="50">コメント</TEXTAREA><br/>
	<input type="submit" value="投稿">
</form>
<form method="post" action="logout.php">
	<input type="hidden" name = "logout_flag" value ="logout">
	<input type ="submit" value="ログアウト">
</form>
<hr>

<!--削除メッセージ-->
<?php
if($_SESSION['delete_check'] == "success"){ ?>
<font color="red">コメントを削除しました</font><br />
<?php unset($_SESSION['delete_check']);
}
if($_SESSION['delete_check'] == "failed"){ ?>
<font color="red">コメントの削除に失敗しました</font><br/>
<?php unset($_SESSION['delete_check']);
}
?>

<!--ソートフォーム-->
<form method="post" action="index.php">
	<SELECT name="sort">
		<OPTION value="h_name">名前</OPTION>
		<OPTION value="time">日付</OPTION>
		<input type="radio" name="sort2" value="DESC" checked="checked">降順
		<input type="radio" name="sort2" value="ASC">昇順
		<input type="hidden" name ="sort_flag" value="pushed">
		<input type='submit' value="ソート">
	</form>
	<?php
//ソートメッセージ
	if(!empty($_POST['sort_flag'])){ 
		echo '<font color="red">ソートしました</font><br />';
		$sql="SELECT * FROM `comment` ORDER BY `".sec($_POST['sort'],$dbh)."` ".sec($_POST['sort2'],$dbh)." LIMIT 0,20;";
		unset($sort_flag);
		if(empty($_POST['sort']) || empty($_POST['sort2'])){ 
			echo '<font color="red">ソートに失敗しました</font><br/>';
		}
	}else{
		$sql = "SELECT * FROM `comment` ORDER BY `id` DESC LIMIT 0,20 ;";
	}

//編集メッセージ
	if($_SESSION['update_check'] == "success"){ 
		echo '<font color="red"> コメントを編集しました</font><br />';
		unset($_SESSION['update_check']);
	}else if($_SESSION['update_check'] == "failed"){
		echo '<font color="red">コメントの編集に失敗しました</font><br/>';
		unset($_SESSION['update_check']);
	}


//コメント表示
	foreach($dbh->query($sql) as $row){
		echo $row['id'].":";
		echo $row['h_name'].":";
		echo $row['time']."<br/>";
		echo $row['comment']."<br/>";

		// コメント編集ボタン
		if($row['h_name'] == $_SESSION['h_name']){ ?>
		<form method="post" action="index.php">
			<input type="hidden" name ="update_id" value="<?php  echo $row['id']; ?>">
			<input type="hidden" name ="update_name" value="<?php  echo $row['h_name']; ?>">
			<input type="hidden" name ="update_check" value="pushed">
			<input type="submit" value="編集" >
		</form>
		<?php }

		// 編集用フォーム
		if($_POST['update_id'] == $row['id'] && !empty($_POST['update_check'])){ ?>
		<form method="post" action="update.php">
			<input type="text" name ="update_comment" >
			<input type="hidden" name ="update_id" value="<?php echo $_POST['update_id']; ?>">
			<input type="submit" value="編集完了" >
		</form>
		<?php }

		//削除ボタン
		if($row['h_name'] == $_SESSION['h_name']){ ?>
		<form method="post" action="delete.php">
			<input type="hidden" name ="delete_id" value="<?php  echo $row['id']; ?>">
			<input type="hidden" name ="delete_name" value="<?php  echo $row['h_name']; ?>">
			<input type="submit" value="削除" >
		</form>
		<?php } 
	} ?>
	<hr>
</body>
</html>
