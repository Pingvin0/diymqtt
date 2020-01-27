<?php
require_once "navbar.php";
require_once "common_funcs.php";
blockNotLoggedIn();
$user = new User($_SESSION["username"]);
$id = $user->getId();
if($_SERVER["REQUEST_METHOD"] == "POST" && checkIssets([$_POST["name"]]) && strlen($_POST["name"]) > 3 && strlen($_POST["name"]) < 20) {
    if(!channelNameActive($_POST["name"], $_SESSION["username"])) {
    createChannel($id, $_POST["name"]);
    }
    else {
        alertMsg("Ezzel a névvel már létezik csatorna!");
    }
}
else {
    if($_SERVER["REQUEST_METHOD"] == "POST")
    alertMsg("Hiba a csatorna létrehozásakor! A névnek 4 - 19 karakternek kell lennie!");
}

?>

<!DOCTYPE HTML>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style2.css">
</head>


<body>
<div style="text-align:center;">
<div style="display:block;text-align:center;">
<?php
$result = simpleSTMT("SELECT * FROM channels WHERE active = 1");
if($result != null)
while($arr = $result->fetch_assoc()) {
    echo('
    <div style="display:block;">
    <p style="display:inline;">Csatornanév: '.htmlspecialchars($arr["name"]).' </p>
    <a href="channel.php?id='.$arr["id"].'" style="text-decoration:none;"><button style="display:inline;">Megnéz</button></a>
    <a href="deactivatech.php?id='.$arr["id"].'" style="text-decoration:none;"><button style="display:inline;background-color:#ff2222">Töröl</button></a>
    </div>
    ');
}
?>
</div>
<form action="channels.php" method="POST">
<input type="text" placeholder="Csatornanév" name="name">
<button type="submit">Új csatorna készítése</button>
</form>
</div>
</body>


<html>