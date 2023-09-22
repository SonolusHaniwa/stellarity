<?php
$level_db = query("SELECT * FROM Levels ORDER BY publishTime DESC LIMIT 5");
for ($i = count($level_db) - 1; $i >= 0; $i--) {
	$res = $level_db[$i];
	$levels = array_merge([new LevelItem(
		$res["name"], $res["isOliver"] ? 30 + $res["level"] : $res["level"], $res["title"],
 		$res["composer"] . " / " . $res["artists"], $res["author"],
		$engines[0], new UseItem(true), new UseItem(true), new UseItem(true), new UseItem(true),
		[], [], [], [], ""
	)], $levels);
}
echo json_encode([
	"title" => $title,
    "banner" => $banner,
	"levels" => new ItemList(array_slice($levels, 0, $info_result_number)),
	"skins" => new ItemList(array_slice($skins, 0, $info_result_number)),
	"backgrounds" => new ItemList(array_slice($backgrounds, 0, $info_result_number)),
	"effects" => new ItemList(array_slice($effects, 0, $info_result_number)),
	"particles" => new ItemList(array_slice($particles, 0, $info_result_number)),
	"engines" => new ItemList(array_slice($engines, 0, $info_result_number))
], JSON_UNESCAPED_UNICODE);
?>
