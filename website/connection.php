<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "websecurity";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {

    die("failed to connect");
}
