<?php
$name = substr($path, 11); $id = -1;
for ($i = 0; $i < count($particles); $i++) if ($particles[$i]->name == $name) $id = $i;
if ($id != -1) { echo json(new ItemDetails($particles[$id], $particles[$id]->description)); return; }
echo json(error_json[404]); return;
?>
