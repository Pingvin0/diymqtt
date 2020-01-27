<?php
require_once "../common_funcs.php";
if(!isset($_GET["count"]) || !isset($_GET["api"])) die();
$key = $_GET["api"];
$count = $_GET["count"];

echo getLastMessages($key, $count);
?>