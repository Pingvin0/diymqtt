<?php
require_once "navbar.php";
require_once "common_funcs.php";
?>


<!DOCTYPE HTML>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>


<body>
<div style="text-align:center;">
<?php
if(!sessionCheck()) {


echo '
<h1>Üdv az MQTT szolgáltatón!</h1>
<h2>Jelentkezz be vagy készíts egy felhasználót!</h2>
';
}
else {
    
echo '
<h1>Üdv, '.htmlspecialchars($_SESSION["username"]).'</h1>
<h2>Menj az útmutatóhoz hogy megismerd a rendszert!</h2>
';
}
?>

</div>
</body>


<html>