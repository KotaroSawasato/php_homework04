<?php

function sec($input,$mysqli){
	//XSS対策
	$input_sec = htmlspecialchars($input, ENT_QUOTES, "UTF-8");
	//SQLインジェクション対策
	return $mysqli->real_escape_string($input_sec);
}

?>