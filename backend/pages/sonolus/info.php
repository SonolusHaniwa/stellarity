<?php
$level_db = query("SELECT * FROM Levels WHERE isPublic = true ORDER BY publishTime DESC LIMIT 5");
for ($i = count($level_db) - 1; $i >= 0; $i--) $levels = array_merge([getLevelData($level_db[$i])], $levels);
echo json_encode([
	"title" => $title,
    "banner" => $banner,
	"levels" => new ItemList(array_slice($levels, 0, $info_result_number), $level_search),
	"skins" => new ItemList(array_slice($skins, 0, $info_result_number)),
	"backgrounds" => new ItemList(array_slice($backgrounds, 0, $info_result_number)),
	"effects" => new ItemList(array_slice($effects, 0, $info_result_number)),
	"particles" => new ItemList(array_slice($particles, 0, $info_result_number)),
	"engines" => new ItemList(array_slice($engines, 0, $info_result_number))
], JSON_UNESCAPED_UNICODE);
?>
