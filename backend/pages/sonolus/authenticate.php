<?php
$address = ($_SERVER['REQUEST_SCHEME'] == "" ? "https" : $_SERVER['REQUEST_SCHEME']) . "://" . $_SERVER['HTTP_HOST'];
$sonolus_public_key = 
"-----BEGIN PUBLIC KEY-----\n" .
"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA8DDWNplPkFiQI2QywLOT\n" .
"OLAsIA+H0kc9RjFK4pJV6MKJxvhAGsJ8uA18Wsug4YU7Kp93gV3Zv7/RlV0yMkWv\n" .
"CxhsQO/K9NI5MdyJSxTI7UcVukZDAQbiFBT+/1od28XKhn6eO2PqI3E7uXpN44Cd\n" .
"O7rgtLSYBBT1/+Aw/gJHn+u5fo60xusfPEYYpXNnIHEL52niNW52wmk/LGItZDlJ\n" .
"+oSwZH2qRFol6t63ymzFUNbred0DwJD+RmqWEq/J/57ofCaL65148BmD2KkJoA8k\n" .
"MR4hNOP9cYs7iQQguboCa0SsJPl4V2SOG+Mn6IkSkZJRfYkC3SXdjmxf+i4qA801\n" .
"RQIDAQAB\n" .
"-----END PUBLIC KEY-----";

$id = bin2hex(random_bytes(16));
$key = bin2hex(random_bytes(16));
$iv = bin2hex(random_bytes(8));

$sql = "INSERT INTO UserSession VALUES (\"$id\", \"$key\", \"$iv\", " . time() . ")";
execute($sql);
$session = [
	"id" => $id,
	"key" => base64_encode($key),
	"iv" => base64_encode($iv)
];
$err = openssl_public_encrypt(json($session), $enc, $sonolus_public_key, OPENSSL_PKCS1_OAEP_PADDING);

$val = [
	"session" => base64_encode($enc),
	"expiration" => (time() + 3600) * 1000,
	"address" => $address
];
echo json($val);
?>
