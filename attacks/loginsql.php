<?php
session_start();

include("connection.php");
include("functions.php");

// Use username stella'-- &password=
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name)) {
        //read from database
        $query = "select * from users where user_name ='".$user_name."' and password = '".$password."' limit 1";

        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
              session_regenerate_id();

              header("Location: index.php");
              die;

            }
        }
        echo "wrong username or password!";
    } else {
        echo "wrong username or password!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>

    <style type="text/css">
        #text {

            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button {

            padding: 10px;
            width: 100px;
            color: white;
            background-color: lightblue;
            border: none;
        }

        #box {

            background-color: grey;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>

    <div id="box">

        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: white;text-align: center;">Login</div>
            <div style="font-size: 15px;margin: 2px;color: white;">Username</div>
            <input id="text" type="text" name="user_name"><br>
            <div style="font-size: 15px;margin: 2px;color: white;">Password</div>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="signup.php">Click to Signup</a><br><br>
        </form>
    </div>
</body>

</html>