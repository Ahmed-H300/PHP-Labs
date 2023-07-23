<?php

$username = $_POST["username"];
$password = $_POST["password"];

$error = [];
if (empty($username)) {
    $error["username"] = "Username is required";
}
if (empty($password)) {
    $error["password"] = "Password is required";
}
if (empty($error)) {
    $data = file('user.txt');
    $loggedIn = false;
    foreach ($data as $key => $value) {

        $user = explode(":", $value);
        $loggedIn1 = false;
        if ($user[7] == $username) {
            $loggedIn1 = true;
        }
        $loggedIn2 = false;
        if ($user[8] == md5($password)) {
            $loggedIn2 = true;
        }
        if ($loggedIn1 and $loggedIn2) {
            $loggedIn = true;
            $index = $key;
            break;
        }
    }
    if ($loggedIn) {
        // var_dump($index);
        // var_dump($username);
        // var_dump($loggedIn);
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["login"] = $loggedIn;
        $_SESSION["index"] = $index;
        // go to welcom page
        header("Location: home.php");
    } else {
        // show error
        $error["login"] = 'Invalid Username or Password';
        $formerror = json_encode($error);
        $_POST["password"] = "";
        $cdata = json_encode($_POST);
        header("Location: login.php?errors=$formerror&data=$cdata");
    }
    exit();
}
$formerror = json_encode($error);
$_POST["password"] = "";
$cdata = json_encode($_POST);
header("Location: login.php?errors=$formerror&data=$cdata");
