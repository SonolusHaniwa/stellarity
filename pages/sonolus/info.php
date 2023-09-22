<?php
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
