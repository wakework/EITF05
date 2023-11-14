<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    if (!empty($user_name)) {
        //save to database
        $user_id = random_num(20);
        $query = "insert into users (user_id,user_name,password,address) values ('$user_id','$user_name','$password','$address')";

        mysqli_query($con, $query);

        header("Location: loginXSS.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Signup2</title>
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
            <div style="font-size: 20px;margin: 10px;color: white;text-align: center;">Signup</div>
			<div style="font-size: 15px;margin: 10px;color: white;">Username</div>
            <input id="text" type="text" name="user_name"><br>
			<div style="font-size: 15px;margin: 10px;color: white;">Password</div>
            <input id="text" type="password" name="password"><br>
			<div style="font-size: 15px;margin: 10px;color: white;">Address</div>
			<input id="text" type="text" name="address"><br><br>

            <input id="button" type="submit" value="Signup"><br><br>

            <a href="login.php">Click to Login</a><br><br>
        </form>
    </div>
</body>

</html>