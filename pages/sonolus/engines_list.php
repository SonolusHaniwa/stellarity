<?php
$page = $_GET["page"];
$offset = ($page - 1) * $list_result_number;
echo json(new ItemList(array_slice($engines, $offset, $list_result_number)));
?>
