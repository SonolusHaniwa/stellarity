<?php
$path = substr($path, 8);

require_once __DIR__ . "/utils.php";

// 路由匹配
if ($path == "/info") { require_once __DIR__ . "/sonolus/info.php"; return; }
if ($path == "/levels/list") { require_once __DIR__ . "/sonolus/levels_list.php"; return; }
if ($path == "/levels/create") { require_once __DIR__ . "/sonolus_gui/levels_create.php"; return; }
if (substr($path, 0, 8) == "/levels/") { require_once __DIR__ . "/sonolus/levels_info.php"; return; }
if ($path == "/skins/list") { require_once __DIR__ . "/sonolus/skins_list.php"; return; }
if (substr($path, 0, 7) == "/skins/") { require_once __DIR__ . "/sonolus/skins_info.php"; return; }
if ($path == "/backgrounds/list") { require_once __DIR__ . "/sonolus/backgrounds_list.php"; return; }
if (substr($path, 0, 13) == "/backgrounds/") { require_once __DIR__ . "/sonolus/backgrounds_info.php"; return; }
if ($path == "/effects/list") { require_once __DIR__ . "/sonolus/effects_list.php"; return; }
if (substr($path, 0, 9) == "/effects/") { require_once __DIR__ . "/sonolus/effects_info.php"; return;  }
if ($path == "/particles/list") { require_once __DIR__ . "/sonolus/particles_list.php"; return; }
if (substr($path, 0, 11) == "/particles/") { require_once __DIR__ . "/sonolus/particles_info.php"; return; }
if ($path == "/engines/list") { require_once __DIR__ . "/sonolus/engines_list.php"; return; }
if (substr($path, 0, 9) == "/engines/") { require_once __DIR__ . "/sonolus/engines_info.php"; return; }
if ($path == "/authenticate") { require_once __DIR__ . "/sonolus/authenticate.php"; return; }
if ($path == "/user/mine") { require_once __DIR__ . "/sonolus_gui/user_mine.php"; return; }
if ($path == "/user/login") { require_once __DIR__ . "/sonolus_gui/user_login.php"; return; }
if ($path == "/server/info") { require_once __DIR__ . "/sonolus_gui/server_info.php"; return; }

echo json($error_json[404]);
?>
