<?php
$name = substr($path, 9); $id = -1;
for ($i = 0; $i < count($effects); $i++) if ($effects[$i]->name == $name) $id = $i;
if ($id != -1) { echo json(new ItemDetails($effects[$id], $effects[$id]->description)); return; }
echo json($error_json[404]); return;
?>
