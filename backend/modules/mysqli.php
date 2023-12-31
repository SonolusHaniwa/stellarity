<?php
function query($sql) {
	global $mysql_address, $mysql_username, $mysql_password, $mysql_database, $error_json;
	$conn = mysqli_connect($mysql_address, $mysql_username, $mysql_password, $mysql_database);
	$res = $conn->query($sql); $ret = [];
	if ($res == false) {
		$ret = $error_json[400];
		$ret["dbmsg"] = $conn->error;
		echo json($ret); exit;
	} while ($row = $res->fetch_array(MYSQLI_ASSOC)) $ret[] = $row;
	return $ret;
}

function execute($sql) {
	global $mysql_address, $mysql_username, $mysql_password, $mysql_database, $error_json;
	$conn = mysqli_connect($mysql_address, $mysql_username, $mysql_password, $mysql_database);
	$res = $conn->query($sql);
	if ($res == false) {
		$ret = $error_json[400];
		$ret["dbmsg"] = $conn->error;
		echo json($ret); exit;
	} return $res;
}
?>
