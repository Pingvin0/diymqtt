<?php
require_once "../common_funcs.php";
if(!isset($_GET["msg"]) || !isset($_GET["api"])) die();
$message = $_GET["msg"];
$key = $_GET["api"];

if(addMessage($key, $message)) echo "Success";
?>