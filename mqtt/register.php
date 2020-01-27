<?php
require_once "navbar.php";
require_once "common_funcs.php";
blockLoggedIn();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($_POST["username"]);
    if(checkIssets(Array(
        $_POST["username"],
        $_POST["password"]
    )) && strlen($_POST["username"]) < 15 && strlen($_POST["username"]) > 3 && !$user->exists() && strlen($_POST["password"]) > 3) 
    {
        header("Location: index.php");
        if(!$user->create($_POST["password"])) {
            echo "<script>alert('Sikertelen regisztárció');</script>";
        }

    } else {
        echo "<script>alert('Sikertelen regisztárció');</script>";
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
<form action="register.php" method="POST">
<input type="text" name="username" placeholder="Felhasználónév" pattern=".{5,10}" required>
<input type="password" name="password" placeholder="Jelszó" pattern=".{5,}" required>
<button type="submit" style="float:left;">Regisztrálás!</button>
</form>
</div>
</div>
</body>


<html>