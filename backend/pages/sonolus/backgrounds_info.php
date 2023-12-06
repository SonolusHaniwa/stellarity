<?php
$name = substr($path, 13); $id = -1;
for ($i = 0; $i < count($backgrounds); $i++) if ($backgrounds[$i]->name == $name) $id = $i;
if ($id != -1) { echo json(new ItemDetails($backgrounds[$id], $backgrounds[$id]->description)); return; }
$res = query("SELECT * FROM Levels WHERE name=\"$name\"");
if (count($res)) {
	echo json(new ItemDetails(getBackgroundData($res[0]), $res[0]["description"])); return;
} echo json($error_json[404]); return;
?>
