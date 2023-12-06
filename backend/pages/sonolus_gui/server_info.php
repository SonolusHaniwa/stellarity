<?php
$drive_api = "https://graph.microsoft.com/v1.0/me/drive";
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

$json = geturl($drive_api, [
	"Authorization: Bearer $access_token",
	"Content-Type: application/json"
]); $json = json_decode($json, true);

$res = array();
$res["git"]["repo"] = $_ENV['VERCEL_GIT_REPO_SLUG'];
$res["git"]["owner"] = $_ENV['VERCEL_GIT_REPO_OWNER'];
$res["git"]["branch"] = $_ENV['VERCEL_GIT_COMMIT_REF'];
$res["git"]["commit"] = $_ENV['VERCEL_GIT_COMMIT_SHA'];
$res["git"]["commit_message"] = $_ENV['VERCEL_GIT_COMMIT_MESSAGE'];
$res["drive"]["total"] = $json["quota"]["total"];
$res["drive"]["used"] = $json["quota"]["used"];
$res["drive"]["remaining"] = $json["quota"]["remaining"];

echo json($res);
?>
