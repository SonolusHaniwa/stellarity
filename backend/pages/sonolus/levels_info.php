<?php
$name = substr($path, 8);
if (substr($name, 0, 9) == "wbs-auth-") {
	$code = substr($name, 9);
	$no = new LevelItem("wbs-auth-$code", 0, "Login Failed", "Please see the error info below!", "System", 
		$message_engine, new UseItem(true), new UseItem(true), new UseItem(true), new UseItem(true), 
		new SRL($SRLType->LevelCover, "/data/" . $no_sha1, $no_sha1), [], [], [], "");
	$yes = new LevelItem("wbs-auth-$code", 0, "Login Success", "You can go to your browser to see the result!", "System",
		$message_engine, new UseItem(true), new UseItem(true), new UseItem(true), new UseItem(true),
		new SRL($SRLType->LevelCover, "/data/" . $yes_sha1, $yes_sha1), [], [], [], "");
	if (strlen($code) != 8) {
		$no->description = "The length of the Login Request Code must be 8";
		echo json(new ItemDetails($no, $no->description, [])); exit;
	}

	$user = getUser();
	$sql = "SELECT code FROM LoginRequest WHERE code = \"$code\" AND time > " . (time() - 300) . " AND userId = \"\" LIMIT 1";
	if (count(query($sql)) == 0) { 
		$no->description = "Invalid Login Request Code!";
		echo json(new ItemDetails($no, $no->description, [])); exit;
	}
	
	$sql = "UPDATE LoginRequest SET userId = \"" . $user["id"] . "\" WHERE code = \"$code\" AND time >= " . (time() - 300) . " AND userId = \"\"";
	execute($sql);
	echo json(new ItemDetails($yes, $yes->description, [])); exit;
}
$res = query("SELECT * FROM Levels WHERE name=\"$name\" LIMIT 1");
if (count($res) == 0) { echo json($error_json[404]); return; }
if ($res[0]["isPublic"] == 0) {
	$usr = getMixUser();
	$name = $usr["name"] . "#" . $usr["handle"];
	if ($name != $res[0]["author"]) { echo json($error_json[401]); return; }
}
$res2 = query("SELECT * FROM Levels WHERE isPublic = true AND author = \"" . $res[0]["author"] . "\" ORDER BY publishTime DESC LIMIT 5");
$recommended = [];
for ($i = 0; $i < count($res2); $i++) $recommended[] = getLevelData($res2[$i]);
$json = json(new ItemDetails(getLevelData($res[0]), $res[0]["description"], $recommended));
$obj = json_decode($json, true);
$obj["rawItem"] = $res[0];
$obj["recommendedRawItems"] = $res2;
echo json($obj);
?>
