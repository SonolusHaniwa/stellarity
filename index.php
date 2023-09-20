<?php
require_once "autoload.php";
$path = $_SERVER['REQUEST_URI'];

// 路由匹配
if ($path == "/" || $path == "/index") {
	require "./pages/index.php";
	return;
}

// 空路由
phpinfo();
?>
