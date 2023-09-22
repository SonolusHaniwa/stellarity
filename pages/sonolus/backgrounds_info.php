<?php
$name = substr($path, 13); $id = -1;
for ($i = 0; $i < count($backgrounds); $i++) if ($backgrounds[$i]->name == $name) $id = $i;
if ($id != -1) { echo json(new ItemDetails($backgrounds[$id], $backgrounds[$id]->description)); return; }
$res = query("SELECT * FROM Levels WHERE name=\"$name\"");
if (count($res)) {
	echo json(new ItemDetails(new BackgroundItem(
		$name, $res[0]["title"], $res[0]["composer"] . " / " . $res[0]["artists"], $res[0]["author"],
		new SRL($SRLType->BackgroundThumbnail, "/data/" . $res[0]["coverHash"], $res[0]["coverHash"]),
		$backgroundData,
		new SRL($SRLType->BackgroundImage, "/data/" . $res[0]["backgroundHash"], $res[0]["backgroundHash"]),
		$backgroundConfiguration, $res[0]["description"]
	), $res[0]["description"])); return;
} echo json($error_json[404]); return;
?>
