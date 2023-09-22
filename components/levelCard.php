<?php
function replace($obj, $base, $key = "obj") {
	if (!is_array($obj) && !is_object($obj)) return str_replace("{{ " . $key . " }}", $obj, $base);
	foreach ($obj as $k => $v) $base = replace($v, $base, $key . "." . $k);
	return $base;
}
function getLevelCard($level) {
	$fp = fopen("./assets/html/levelCard.html", "r");
	$base = fread($fp, filesize("./assets/html/levelCard.html"));
	return replace($level, $base);
}
?>
