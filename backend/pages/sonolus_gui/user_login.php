<?php
function getIP() {
    return $_SERVER['REMOTE_ADDR'];
}

$sessionId = bin2hex(random_bytes(16));
$code = "";
for ($i = 0; $i < 8; $i++) $code .= chr(rand(48, 57));
$sql = "INSERT INTO LoginRequest VALUES (\"$code\", \"$sessionId\", " . time() . ", \"\", \"\", \"" . getIP() . "\")";
execute($sql);
echo json(["sessionId" => $sessionId, "code" => $code]);
?>