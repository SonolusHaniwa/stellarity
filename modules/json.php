<?php
function json($arr) {
	return json_encode($arr, JSON_UNESCAPED_UNICODE);
}

$error_json = [
	400 => [ "code" => 400, "msg" => "400 Bad Request" ],
	404 => [ "code" => 404, "msg" => "404 Not Found" ]
]
?>
