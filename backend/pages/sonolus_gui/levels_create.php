<?php
$usr = getGUIUser();
$author = $usr["name"] . '#' . $usr["handle"];
$id = array_key_exists("id", $_POST) ? $_POST["id"] : bin2hex(random_bytes(16));

$name = "wbs-$id";
$isOlivier = $_POST["isOlivier"];
$level = $_POST["level"];
$title = quote($_POST["title"]);
$artists = quote($_POST["artists"]);
$composer = quote($_POST["composer"]);
// $author = quote($_POST["author"]);
$description = quote($_POST["description"]);
$isPublic = $_POST["isPublic"];
$createTime = time();
$publishTime = ($isPublic ? time() : 0);
$lastEdited = time();
$coverHash = $_POST["coverHash"];
$backgroundHash = $_POST["backgroundHash"];
$musicHash = $_POST["musicHash"];
$dataHash = $_POST["dataHash"];
$susHash = $_POST["susHash"];

if (array_key_exists("id", $_POST)) {
	$res = query("SELECT * FROM levels WHERE name=\"$name\"");
	if (count($res) == 0) { echo json($error_json[404]); exit; }
	$createTime = $res[0]["createTime"];
	if ($isPublic == 1) $publishTime = $res[0]["publishTime"] == 0 ? time() : $res[0]["publishTime"];
	else $publishTime = $res[0]["publishTime"];
	$sql = "UPDATE levels SET " . 
	"name = \"$name\", isOliver = $isOlivier, level = \"$level\", " . 
	"title = \"$title\", artists = \"$artists\", composer = \"$composer\", author = \"$author\", " .
	"description = \"$description\", isPublic = $isPublic, " .
	"createTime = $createTime, publishTime = $publishTime, lastEdited = $lastEdited, " . 
	"coverHash = \"$coverHash\", backgroundHash = \"$backgroundHash\", musicHash = \"$musicHash\", " .
	"dataHash = \"$dataHash\", susHash = \"$susHash\" WHERE name = \"$name\"";
	execute($sql);
	echo json([ "status" => "updated", "id" => $id ]);
} else {
	$sql = "INSERT INTO levels VALUES " . 
	"(\"$name\", $isOlivier, \"$level\", \"$title\", \"$artists\", \"$composer\", \"$author\", " .
	"\"$description\", $isPublic, $createTime, $publishTime, $lastEdited, " . 
	"\"$coverHash\", \"$backgroundHash\", \"$musicHash\", \"$dataHash\", \"$susHash\")";
	execute($sql);
	echo json([ "status" => "created", "id" => $id ]);
}
?>
