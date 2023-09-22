<?php
$path = substr($path, 8);

// 路由匹配
if ($path == "/info") { require_once "./pages/sonolus/info.php"; return; }
if ($path == "/skins/list") { require_once "./pages/sonolus/skins_list.php"; return; }
if (substr($path, 0, 7) == "/skins/") { require_once "./pages/sonolus/skins_info.php"; return; }
if ($path == "/backgrounds/list") { require_once "./pages/sonolus/backgrounds_list.php"; return; }
if (substr($path, 0, 13) == "/backgrounds/") { require_once "./pages/sonolus/backgrounds_info.php"; return; }
if ($path == "/effects/list") { require_once "./pages/sonolus/effects_list.php"; return; }
if (substr($path, 0, 9) == "/effects/") { require_once "./pages/sonolus/effects_info.php"; return;  }
if ($path == "/particles/list") { require_once "./pages/sonolus/particles_list.php"; return; }
if (substr($path, 0, 11) == "/particles/") { require_once "./pages/sonolus/particles_info.php"; return; }
if ($path == "/engines/list") { require_once "./pages/sonolus/engines_list.php"; return; }
if (substr($path, 0, 9) == "/engines/") { require_once "./pages/sonolus/engines_info.php"; return; }

echo json_encode(["code" => 404, "msg" => "404 Not Found"]);
?>
