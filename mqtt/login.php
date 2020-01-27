<?php
require_once "navbar.php";
require_once "common_funcs.php";
blockLoggedIn();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(checkIssets(Array($_POST["username"], $_POST["password"]))) {
        $user = new User($_POST["username"]);
        if($user->auth($_POST["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $_POST["username"];
            header("Location: index.php");
        } else {
            echo "<script>alert('Sikertelen bejelentkezés');</script>";
        }
    } else {
        echo "<script>alert('Sikertelen bejelentkezés');</script>";
    }
}

?>

<!DOCTYPE HTML>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>


<body>
<div style="text-align:center;">
<div style="display:inline-block;margin-top:20px;">
<form action="login.php" method="POST">
<input type="text" name="username" placeholder="Felhasználónév" pattern=".{5,10}" required>
<input type="password" name="password" placeholder="Jelszó" pattern=".{5,}" required>
<button type="submit" style="float:left;">Bejelentkezés</button>
</form>
</div>
</div>
</body>


<html>