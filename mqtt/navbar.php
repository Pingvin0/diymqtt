<?php
require_once "common_funcs.php";
$active = 'class="active"';

$onlyNotLoggedIn = Array(
    Array("register.php", "Regisztrálás"),
    Array("login.php", "Bejelentkezés")
);

$onlyAll = Array(
    Array("index.php", "Kezdőlap"),
    Array("guide.php", "Útmutató")
);

$onlyLoggedIn = Array(
    Array("channels.php", "Csatornák"),
    Array("logout.php", "Kijelentkezés")
);

$onlyAdmin = Array(
    Array("admin.php", "Admin Panel")
);

?>

<!DOCTYPE HTML>
<html>

<head>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div class="topnav">

<?php
/*
<a href="index.php" <?php if(ifPage("index.php")) echo 'class="active"';?>>Kezdőlap</a>
<a href="guide.php" <?php if(ifPage("guide.php")) echo 'class="active"';?>>Útmutató</a>
if(!sessionCheck()) {
    if(ifPage("login.php")) {
        echo '
        <a href="login.php" '.$active.'> Bejelentkezés</a>';
    } else {
        echo '<a href="login.php"> Bejelentkezés</a>';
    }


    if(ifPage("register.php")) {
        echo '
        <a href="register.php" style="float:right;" '.$active.'>Regisztrálás</a>';
    } else {
        echo '<a href="register.php" style="float:right;">Regisztrálás</a>';
    }

} else {
    echo '
    <a href="logout.php" style="float:right;">Kijelentkezés</a>';
}*/

foreach($onlyAll as $lArr) {
    $active = "";
    if(ifPage($lArr[0])) {
        $active = 'class="active"';
    } 
    echo '<a href="'.$lArr[0].'" '.$active.'>'.$lArr[1].'</a>';
}

if(sessionCheck()) {
$user = new User($_SESSION["username"]);

if($user->isAdmin()) {

    foreach($onlyAdmin as $lArr) {
        $active = "";
        $float = "";
        if(ifPage($lArr[0])) {
            $active = 'class="active"';
        } 
    
        $float = 'style="float:right;"';
    
        echo '<a href="'.$lArr[0].'" '.$active.' '.$float.'>'.$lArr[1].'</a>';
    }
}


foreach($onlyLoggedIn as $lArr) {
    $active = "";
    $float = "";
    if(ifPage($lArr[0])) {
        $active = 'class="active"';
    } 

    if($lArr[0] == "logout.php") $float = 'style="float:right;"';

    echo '<a href="'.$lArr[0].'" '.$active.' '.$float.'>'.$lArr[1].'</a>';
}


} else {
    foreach($onlyNotLoggedIn as $lArr) {
        $active = "";
        $float;
        if(ifPage($lArr[0])) {
            $active = 'class="active"';
        } 
    
        $float = 'style="float:right;"';
    
        echo '<a href="'.$lArr[0].'" '.$active.' '.$float.'>'.$lArr[1].'</a>';
    }
}
?>

</div>
</body>


</html>