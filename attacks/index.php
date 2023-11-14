<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == $_POST) {
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome, <?php echo $user_data['user_name']; ?>.</title>
</head>

<body>
    <!-- Header -->
    <a href="logout.php">Logout</a>
    <h1>Welcome to the best Webshop in the world</h1><br>

    <!-- Information to user -->
    Hello, <?php echo $user_data['user_name']; ?>.
    <a href="store.php">Go to the shop</a><br><br>

    <!-- XSS -->
    Users active on the best webshop in the world: <br>
    <?php
    $query = "select * from users";
    $result = mysqli_query($con, $query);

    foreach ($result as $value) {
      echo nl2br("\n");
      echo $value['user_name'];
    }

    ?>

    <!-- CSRF -->
    <br><br> Post a review:
    <form method="post">
            <div style="font-size: 15px;margin: 2px;color: black;"></div>
            <input id="text" type="text" name="review"><br>
    </form>

    <br><br> Reviews: <br>
    <a href="csrf2.php" target="_blank">BLACK FRIDAY</a><br><br>

</body>

</html>