<?php
$name = substr($path, 7); $id = -1;
for ($i = 0; $i < count($skins); $i++) if ($skins[$i]->name == $name) $id = $i;
if ($id != -1) { echo json(new ItemDetails($skins[$id], $skins[$id]->description)); return; }
echo json($error_json[404]); return;
?>
