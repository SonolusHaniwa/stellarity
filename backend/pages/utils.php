<?php
function quote($data) {
	return str_replace("\"", "\\\"", 
		str_replace("\\", "\\\\", $data)
	);
}

function getUser() {
	global $error_json;
	if (!array_key_exists("HTTP_SONOLUS_SESSION_ID", $_SERVER) ||
		!array_key_exists("HTTP_SONOLUS_SESSION_DATA", $_SERVER)) { echo json($error_json[401]); exit; }
	$sessionId = $_SERVER["HTTP_SONOLUS_SESSION_ID"];
	$sessionData = $_SERVER["HTTP_SONOLUS_SESSION_DATA"];
	$sql = "SELECT * FROM UserSession WHERE id = \"$sessionId\"";
	$res = query($sql);
	if (count($res) == 0) { echo json($error_json[401]); exit; }
	$json = openssl_decrypt($sessionData, "aes-256-cbc", $res[0]["aesKey"], 0, $res[0]["aesIv"]);
	$obj = json_decode($json, true)["userProfile"];
	foreach($obj as $key => $value) $obj[$key] = quote(json($value));
	$sql = "SELECT id FROM UserProfile WHERE id = \"" . $obj["id"] . "\"";
	if (count(query($sql)) == 0) $sql = "INSERT INTO UserProfile VALUES " . 
		"(\"" . $obj["id"] . "\", \"" . $obj["handle"] . "\", \"" . $obj["name"] . "\", \"" . $obj["avatarForegroundColor"] . "\", " .
		"\"" . $obj["avatarBackgroundColor"] . "\", \"" . $obj["aboutMe"] . "\", \"" . $obj["socialLinks"] . "\", \"" . $obj["favorites"] . "\", \"\")";
	else $sql = "UPDATE UserProfile SET ".
		"handle = \"" . $obj["handle"] . "\", name = \"" . $obj["name"] . "\", avatarForegroundColor = \"" . $obj["avatarForegroundColor"] . "\", " .
		"avatarBackgroundColor = \"" . $obj["avatarBackgroundColor"] . "\", aboutMe = \"" . $obj["aboutMe"] . "\", " .
		"socialLinks = \"" . $obj["socialLinks"] . "\", favorites = \"" . $obj["favorites"] . "\" WHERE id = \"" . $obj["id"] . "\"";
	execute($sql);
	return json_decode($json, true)["userProfile"];
}

function getGUIUser() {
	global $error_json;
	if (!array_key_exists("HTTP_AUTHORIZATION", $_SERVER)) { echo json($error_json[401]); exit; }
	$sessionId = $_SERVER["HTTP_AUTHORIZATION"];
	$sql = "SELECT * FROM LoginRequest WHERE session = \"$sessionId\" AND userId != \"\"";
	$res = query($sql);
	if (count($res) == 0) { echo json($error_json[401]); exit; }
	$sql = "SELECT * FROM UserProfile WHERE id = \"" . $res[0]["userId"] . "\"";
	$res = query($sql);
	return $res[0];
}

function getMixUser() {
	global $error_json;
	if (array_key_exists("HTTP_SONOLUS_SESSION_ID", $_SERVER) &&
		array_key_exists("HTTP_SONOLUS_SESSION_DATA", $_SERVER)) return getUser();
	if (array_key_exists("HTTP_AUTHORIZATION", $_SERVER)) return getGUIUser();
	echo json($error_json[401]); exit;
}
?>
