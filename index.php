<?php
require_once "autoload.php";
$path = $_SERVER['REQUEST_URI'];
if (strpos($path, "?") !== false) $path = substr($path, 0, strpos($path, "?"));
header("Sonolus-Version: 0.7.3");

// 路由匹配
if ($path == "/" || $path == "/index") {
	require "./pages/index.php";
	return;
}
if (substr($path, 0, 9) == "/sonolus/") {
	header("Content-Type: application/json; charset=utf8");
	require_once "./pages/sonolus/routes.php";
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
