	<?php
session_start();

include("connection.php");
include("check_login.php");
if (empty($_SESSION['key'])) {
    $_SESSION['key'] = bin2hex(random_bytes(32));
}

$csrf = hash_hmac('sha256', 'signup.php', $_SESSION['key']);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (hash_equals($csrf, $_POST['csrf'])) {



        $user_name = htmlspecialchars($_POST['user_name']);
        $password = htmlspecialchars($_POST['password']);
        $address = htmlspecialchars($_POST['address']);

        $length = strlen($user_name) > 5;
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChar = preg_match('@[^\w]@', $password);

        $query = sprintf(
            "select * from users where user_name = '%s'",
            mysqli_real_escape_string($con, $user_name)
        );
        $result = mysqli_query($con, $query);

        if ($result->num_rows) {
            echo "User already exist, try choosing a different username";
            } elseif (strpos(file_get_contents("blacklist.txt"),$password) !== false ) {
    	echo "Your password is too common";
        } else {
            if (!empty($user_name) && !empty($password) && !is_numeric($user_name) && $uppercase && $lowercase && $number && $specialChar && $length) {
                $password_hash = hash("sha256", $password);
                $query = "insert into users (user_name,password,address) values ('$user_name','$password_hash','$address')";
                mysqli_query($con, $query);
                header("Location: login.php");
                die;
            } else {
                echo "Please enter some valid information! 
            Your password must be at least 8 characters long and contain at least of each of the following: uppercase letter, lowercase letter, digit and special character";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
</head>

<body>



    <div align="center">

        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: black;">Signup</div>
            <div style="font-size: 15px;margin: 10px;color: black;">Username</div>
            <input type="text" name="user_name"><br>
            <div style="font-size: 15px;margin: 10px;color: black;">Password</div>
            <input type="password" name="password"><br>
            <div style="font-size: 15px;margin: 10px;color: black;">Address</div>
            <input type="text" name="address"><br><br>
            <input type="hidden" name="csrf" value="<?php echo $csrf ?>">
            <input type="submit" value="Signup"><br><br>

            <a href="login.php">Click to Login</a><br><br>
        </form>
    </div>
</body>

</html>
