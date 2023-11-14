<?php
session_start();

include("connection.php");
include("functions.php");

$url = $_SERVER['REQUEST_URI'];
$id = explode("%", $url, 2);

?>

<!DOCTYPE html>
<html>

<head>
    <title>HACKED SITE</title>
</head>

<body>
    <a href="index.php">Webshop</a>
    <h1>Welcome user, you just got hacked!</h1>

    This is your SessionID <?php echo $id[1]; ?>
    <br>
</body>

</html>