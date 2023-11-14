<?php
session_start();

if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

header("Location: login.php");
