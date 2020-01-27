<?php
$ip = "localhost";
$user = "mqtt";
$pass = "gnyGvtp8ppR6ptFE";
$db = "diymqtt";

$prefix = "/mqtt/";

require_once "classes/user_class.php";
require_once "classes/channel_funcs.php";
session_start();


function ifPage($page) {
    global $prefix;
    if($_SERVER['PHP_SELF'] == $prefix . $page) {
        return true;
    }
    return false;
}

function acquireSqlCon() {
    $ip = "localhost";
    $user = "mqtt";
    $pass = "gnyGvtp8ppR6ptFE";
    $db = "diymqtt";
    $mysqli = mysqli_connect($ip, $user, $pass, $db);
    
    if(!$mysqli) {
        echo "Adatbázis csatlakozás sikertelen! Kérlek próbáld meg később.";
        die();
    }
    $mysqli->set_charset("utf8mb4_bin");
    return $mysqli;

}

function redirectToError() {
    header("Location: error.html");
    die();
}

function simpleSTMT($sql, $types="", $bind=[]) {
    $mysqli = acquireSqlCon();

    $stmt = $mysqli->prepare($sql);
    if($stmt == false) redirectToError();
    if($types != "" && $bind != [])
    $stmt->bind_param($types, ...$bind);
    if(!$stmt->execute()) redirectToError();
    $result = $stmt->get_result();
    if($result == false) return null;
    return $result;

}

function getFirstFoundQuery($sql, $types="", $bind=[]) {
$result = simpleSTMT($sql, $types, $bind);
while($arr = $result->fetch_assoc) return $arr;
return false;
}


function sessionCheck() {

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] = true && isset($_SESSION["username"])) {

    $r = simpleSTMT("SELECT id FROM user WHERE username = ? AND banned = 1", "s", [$_SESSION["username"]]);
    if($r->num_rows > 0) {
        $_SESSION["loggedin"] = false;
        return false;
    }

    return true;
}
return false;
}


function blockLoggedIn() {
    if(sessionCheck()) {
        header("Location: index.php");
        die();
    }
}

function blockNonAdmin() {
    if(sessionCheck()) {
        $user = new User($_SESSION["username"]);
        if($user->isAdmin()) return;
    }
    header("Location: index.php");
    die();
}

function blockNotLoggedIn() {
    if(!sessionCheck()) {
        header("Location: index.php");
        die();
    }
}


function checkIssets($arr) {
    foreach($arr as $v) {
        if(!isset($v)) return false;
    }
    return true;
}

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function alertMsg($msg) {
    echo "<script>alert('".htmlspecialchars($msg, ENT_QUOTES)."')</script>";
}




?>