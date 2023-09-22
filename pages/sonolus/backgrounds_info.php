<?php
$name = substr($path, 13); $id = -1;
for ($i = 0; $i < count($backgrounds); $i++) if ($backgrounds[$i]->name == $name) $id = $i;
if ($id != -1) { echo json(new ItemDetails($backgrounds[$id], $backgrounds[$id]->description)); return; }
echo json(error_json[404]); return;
?>
