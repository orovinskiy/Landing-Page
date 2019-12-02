<?php
session_start();

//Error Reporting on
//ini_set("display_errors",1);
//error_reporting(E_ALL);

if(isset($_SESSION['username'])){
    header('location: admin.php');
}

if(isset($_POST['submit'])) {
    include 'cred.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (array_key_exists($username, $login) && $login[$username] === $password) {
        $_SESSION['username'] = $username;
        header('location: admin.php');
    }
    echo '<p>Invalid Login</p>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Log In</title>
</head>
<body>
<div class="container">
    <header>
        <div class="jumbotron">
            <h1 class="display-4">Admin Login</h1>
        </div>
    </header>
    <form method="post" action="#">

        <div class="form-group">
            <label>Username:
                <input class="form-control" type="text" name="username">
            </label><br>
        </div>

        <div class="form-group">
            <label>Password:
                <input class="form-control" type="password" name="password">
            </label><br>
        </div>

        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
    </form>
</div>
</body>
</html>
