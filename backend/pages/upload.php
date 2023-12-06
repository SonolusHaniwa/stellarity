<?php
require_once __DIR__ . "/utils.php";
$sha = substr($path, 8);
if (strlen($sha) != 40) {
	echo json($error_json[404]); return;
}

$usr = getGUIUser();

$drive_api = "https://graph.microsoft.com/v1.0/me/drive/root:";
$auth_api = "https://login.microsoftonline.com/common/oauth2/v2.0/token";
$json = posturl($auth_api, [], "client_id=$onedrive_client_id&redirect_uri=http://localhost" .
	"&client_secret=$onedrive_client_secret&refresh_token=$onedrive_refresh_token&grant_type=refresh_token");
$res = json_decode($json, true);
if (!array_key_exists("access_token", $res)) {
	echo json(array_merge($error_json[400], 
		[ "diskerr" => "Unable to fetch Access Token! Please report this issue to Developer." ]
	)); exit;
}
$access_token = $res["access_token"];

$json = posturl("$drive_api/data/$sha", [
	"Authorization: Bearer $access_token",
	"Content-Type: application/json"
], "{}");
$res = json_decode($json, true);
if (!array_key_exists("error", $res)) {
	echo json($error_json[201]); exit;
}

$json = posturl("$drive_api/data/$sha:/createUploadSession", [
	"Authorization: Bearer $access_token",
	"Content-Type: application/json"
], "{\"item\": {\"@microsoft.graph.conflictBehavior\": \"rename\", \"name\": \"$sha\"}}");
$res = json_decode($json, true);
if (array_key_exists("error", $res)) {
	echo json($error_json[404]); exit;
}
if (!array_key_exists("uploadUrl", $res)) {
	echo json(array_merge($error_json[400],
		[ "diskerr" => "Unknown error occurred in " . __FILE__ . " on line " . __LINE__ . "! Please report this issue to Developer." ]
	)); exit;
}

echo json([ "sha" => $sha, "uploadUrl" => $res["uploadUrl"], "token" => $access_token ]);
?>
