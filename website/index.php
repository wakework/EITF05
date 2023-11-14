<?php
session_start();

include("connection.php");
include("check_login.php");

$user_data = check_login($con);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome, <?php echo htmlspecialchars($user_data['user_name']); ?>.</title>
</head>

<body>

    <a href="logout.php">Logout</a>
    <h1>This is the index page</h1>
    <br>
    Hello, <?php echo htmlspecialchars($user_data['user_name']); ?>.<br>
    <a href="store.php">Go to the shop</a>
</body>

</html>