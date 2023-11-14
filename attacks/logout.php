<?php
session_start();

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

header("Location: loginxss.php");
?>

<!DOCTYPE html>
<html>
    You are now logged out.
</html>