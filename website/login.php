<?php
session_start();

include("connection.php");
include("check_login.php");


if (empty($_SESSION['key']))
    $_SESSION['key'] = bin2hex(random_bytes(32));


$csrf = hash_hmac('sha256', 'login.php', $_SESSION['key']);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$sleeper = time_nanosleep(2, 10);
    if (hash_equals($csrf, $_POST['csrf'])) {
	

        $user_name = htmlspecialchars($_POST['user_name']);
        $password = htmlspecialchars($_POST['password']);

        if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
            $password = hash("sha256", $password);
            $query = sprintf("select * from users where user_name = '%s' limit 1", mysqli_real_escape_string($con, $user_name));

            $result = mysqli_query($con, $query);

            if ($result) {
                if ($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['password'] === $password) {
                        $_SESSION['id'] = $user_data['id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            echo htmlspecialchars("wrong username or password!");
        } else {
            echo htmlspecialchars("wrong username or password!");
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>



    <div align="center">

        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: black;">Login</div>
            <div style="font-size: 15px;margin: 2px;color: black;">Username</div>
            <input type="text" name="user_name"><br>
            <div style="font-size: 15px;margin: 2px;color: black;">Password</div>
            <input type="password" name="password"><br><br>
            <input type="hidden" name="csrf" value="<?php echo $csrf ?>">
            <input type="submit" value="Login"><br><br>

            <a href="signup.php">Click to Signup</a><br><br>
        </form>
    </div>
</body>

</html>
