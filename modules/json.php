<?php
function json($arr) {
	return json_encode($arr, JSON_UNESCAPED_UNICODE);
}

$error_json = [
	404 => [ "code" => 404, "msg" => "404 Not Found" ]
]
?>
