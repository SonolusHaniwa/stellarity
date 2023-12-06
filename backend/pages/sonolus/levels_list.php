<?php
// 判断是否为登录请求
if (array_key_exists("code", $_GET)) {
	$arr = new ItemList([new LevelItem(
		"wbs-auth-" . $_GET["code"], 0,
		"Login with code [ " . $_GET["code"] . " ] ?",
		"Do not use code by other people!", "System",
		new EngineItem("wbs-auth", "(Message)", "", "", $skins[0], $backgrounds[0], $effects[0], $particles[0], [], [], [], [], [], [], ""),
		new UseItem(true), new UseItem(true), new UseItem(true), new UseItem(true),
		new SRL($SRLType->LevelCover, "/data/$warn_sha1", $warn_sha1), [], [], [], ""
	)], $level_search);
	echo json($arr); return;
}
$page = array_key_exists("page", $_GET) ? $_GET["page"] : 0;
$offset = $page * $list_result_number;
$result_sql = "SELECT * FROM Levels "; $count_sql = "SELECT COUNT(*) FROM Levels "; $where = "";
if (array_key_exists("name", $_GET)) $where .= "name LIKE \"%" . $_GET["name"] . "%\" AND ";
if (array_key_exists("title", $_GET)) $where .= "title LIKE \"%" . $_GET["title"] . "%\" AND ";
if (array_key_exists("composer", $_GET)) $where .= "composer LIKE \"%" . $_GET["composer"] . "%\" AND ";
if (array_key_exists("artists", $_GET)) $where .= "artists LIKE \"%" . $_GET["artists"] . "%\" AND ";
if (array_key_exists("author", $_GET)) $where .= "author LIKE \"%" . $_GET["author"] . "%\" AND ";
if (array_key_exists("minLevel", $_GET)) $where .= "(CASE isOliver WHEN 1 THEN level + 30 ELSE level END) >= " . $_GET["minLevel"] . " AND ";
if (array_key_exists("maxLevel", $_GET)) $where .= "(CASE isOliver WHEN 1 THEN level + 30 ELSE level END) <= " . $_GET["maxLevel"] . " AND ";
if (array_key_exists("type", $_GET)) {
	if ($_GET["type"] == 0) $where .= "isPublic = true AND ";
	else if ($_GET["type"] == 1) {
		$user = getMixUser();
		$where .= "author = \"" . $user["name"] . "#" . $user["handle"] . "\" AND ";
	} else if ($_GET["type"] == 2) {
		$user = getMixUser();
		$where .= "isPublic = true AND ";
	}
} else $where .= "isPublic = true AND ";
if ($where != "") {
	$result_sql .= "WHERE " . substr($where, 0, strlen($where) - 5) . " ";
	$count_sql .= "WHERE " . substr($where, 0, strlen($where) - 5) . " ";
}
$result_sql .= "ORDER BY publishTime DESC LIMIT $list_result_number OFFSET $offset";
$res = query($result_sql);
$arr = new ItemList([], $level_search);
for ($i = 0; $i < count($res); $i++) $arr->append(getLevelData($res[$i]));
$json = json($arr);
$obj = json_decode($json, true);
$obj["pageCount"] = ceil(query($count_sql)[0]["COUNT(*)"] / $list_result_number);
for ($i = 0; $i < count($res); $i++) $obj["rawItems"][] = $res[$i];
echo json($obj);
?>
