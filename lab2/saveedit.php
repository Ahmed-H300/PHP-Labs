<?php

$index = $_GET["index"];

$error = array();

if (!isset($_POST["fname"]) or empty($_POST["fname"])) {

    $error["fname"] = 'First Name is Required';
}
if (!isset($_POST["lname"]) or empty($_POST["lname"])) {
    $error["lname"] = 'Last Name is Required';
}
if (!isset($_POST["email"]) or empty($_POST["email"])) {
    $error["email"] = 'Email is Required';
}
if (!isset($_POST["gender"]) or empty($_POST["gender"])) {
    $error["gender"] = 'Gender is Required';
}

if (empty($error)) {

    $skillsaved = isset($_POST["skill"])? json_encode($_POST["skill"]) : "";

    $line = $_POST["fname"] . ':' .  $_POST["lname"] . ':' .  $_POST["email"] . ':' .  $_POST["Address"] . ':' .  $_POST["country"] . ':' .  $_POST["gender"] . ':' .  $skillsaved . ':' .  $_POST["username"] . ':' .  $_POST["password"] . ':' .  $_POST["dep"] . "\n";

    $data = file('data.txt');
    $data[$index] = $line;
    $usersfile = fopen('data.txt', 'w');
    foreach ($data as $line) {
        fwrite($usersfile, $line);
    }
    fclose($usersfile);
    // go back to table.php

    header("Location: table.php");
    exit();
}

$formerror = json_encode($error);
$_POST["password"] = "";
$cdata = json_encode($_POST);

header("Location: edit.php?index=$index&errors=$formerror&data=$cdata");