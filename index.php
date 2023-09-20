<?php
require_once "autoload.php";
$path = $_SERVER['REQUEST_URI'];

// 路由匹配
if ($path == "/" || $path == "/index") {
	require "./pages/index.php";
	return;
}
if (file_exists("." . $path)) {
	header("Content-Type: text/css");
	$fp = fopen("." . $path, "r");
	$dat = fread($fp, filesize("." . $path));
	echo $dat; fclose($fp);
	return;
}

// 空路由
phpinfo();
?>
