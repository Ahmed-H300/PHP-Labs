<?php

include('dbManager.php');

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
    $password = md5($password);

    $user = $dbManager->selectUserbyusernameandpassword($username, $password);
    // var_dump($user);
    // var_dump($password);
    // exit;

    $loggedIn = false;
    if (!empty($user)) {
        $loggedIn = true;
        $index = $user["id"];
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
