<?php
function json($arr, $autoRespondCode = true) {
	if (!is_array($arr) && !is_object($arr)) return $arr;
	if (is_object($arr)) return json_encode($arr, JSON_UNESCAPED_UNICODE);
	if (array_key_exists("code", $arr) && array_key_exists("msg", $arr) && $autoRespondCode) 
		http_response_code($arr["code"]);
	return json_encode($arr, JSON_UNESCAPED_UNICODE);
}

$error_json = [
	201 => [ "code" => 201, "msg" => "201 Created" ],
	400 => [ "code" => 400, "msg" => "400 Bad Request" ],
	401 => [ "code" => 401, "msg" => "401 Unauthorized" ],
	404 => [ "code" => 404, "msg" => "404 Not Found" ]
]
?>
