<?php
require_once "common_funcs.php";
blockNotLoggedIn();
$user = new User($_SESSION["username"]);
$id = $user->getId();
$channel_id = $_GET["id"];
if(!is_numeric($channel_id)) {
    header("Location: index.php");
    die(); 
}

$result = simpleSTMT("SELECT * FROM channels WHERE id = ? AND owner = ?", "ii", [$channel_id, $id]);
if($result->num_rows == 1) {
    simpleSTMT("UPDATE channels SET active = 0 WHERE id = ?", "i", [$channel_id]);
}
header("Location: channels.php");
die(); 
?>