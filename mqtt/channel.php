<?php
require_once "navbar.php";
require_once "common_funcs.php";
blockNotLoggedIn();


$user = new User($_SESSION["username"]);
$channel_id = $_GET["id"];
if(!channelActive($channel_id) || !channelBelongsToUser($channel_id, $user->getId())) {
    header("Location: channels.php");
    die();
}

$pathtoapi = "http://".$_SERVER['SERVER_NAME'].$prefix."api/";

?>

<!DOCTYPE HTML>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>


<body>
<div style="text-align:center;">
<?php
$r = simpleSTMT("SELECT * FROM channels WHERE id = ?", "i", [$channel_id]);

while($arr = $r->fetch_array()) {
echo "
<h1>".$arr["name"]."</h1>
<h3>API Kulcs: ".$arr["API_KEY"]."</h3>
<h3>Írás Link: <a href='".$pathtoapi."write.php?api=".$arr["API_KEY"]."&msg=0'>".$pathtoapi."write.php?api=".$arr["API_KEY"]."&msg=0</a></h3>
<h3>Olvasás Link: <a href='".$pathtoapi."read.php?api=".$arr["API_KEY"]."&count=1'>".$pathtoapi."read.php?api=".$arr["API_KEY"]."&count=1</a></h3>
<h2>Utolsó üzenetek</h2>
";
$messages = simpleSTMT("SELECT * FROM channelmsg WHERE channel_id = ? ORDER BY time DESC", "i", [$channel_id]);
while($array = $messages->fetch_assoc()) {
    echo '<h3>' . $array["time"] . ' - ' . $array["msg"] . '</h3>';
}
}


?>
</div>
</body>


<html>