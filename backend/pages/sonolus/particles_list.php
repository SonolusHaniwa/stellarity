<?php
$page = array_key_exists("page", $_GET) ? $_GET["page"] : 1;
$offset = ($page - 1) * $list_result_number;
echo json(new ItemList(array_slice($particles, $offset, $list_result_number)));
?>
