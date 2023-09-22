<?php
$name = substr($path, 9); $id = -1;
for ($i = 0; $i < count($engines); $i++) if ($engines[$i]->name == $name) $id = $i;
if ($id != -1) { echo json(new ItemDetails($engines[$id], $engines[$id]->description)); return; }
echo json($error_json[404]); return;
?>
