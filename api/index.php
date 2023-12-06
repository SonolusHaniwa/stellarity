<?php
require_once __DIR__ . "/../backend/autoload.php";$path = $_SERVER['REQUEST_URI'];
if (strpos($path, "?") !== false) $path = substr($path, 0, strpos($path, "?"));
header("Sonolus-Version: 0.7.4");
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// 避免预检报错
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, Sonolus-Version");
	header("Access-Control-Max-Age: 86400");
	echo json("{}"); exit;
}

// 路由匹配
if (substr($path, 0, 9) == "/sonolus/") {
	require_once __DIR__ . "/../backend/pages/routes.php";
	return;
}
if (substr($path, 0, 6) == "/data/") {
	require_once __DIR__ . "/../backend/pages/data.php";
	return;
}
if (substr($path, 0, 8) == "/upload/") {
	require_once __DIR__ . "/../backend/pages/upload.php";
	return;
}
if (substr($path, 0, 8) == "/static/") {
	require_once __DIR__ . "/../backend/pages/static.php";
	return;
}

// 空路由
echo json($error_json[404]); exit;
?>
