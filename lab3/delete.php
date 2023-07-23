<?php


session_start();
if (!$_SESSION["login"]) {
    header("Location: login.php");
    exit;
}


$index = $_GET["index"];
$data = file('user.txt');
// delete image
$arrpos = strrpos($data[$index], ':');
$imgName = substr($data[$index], $arrpos + 1);
$imgName = rtrim($imgName, "\n");
unlink($imgName);
//delete user
unset($data[$index]);
$usersfile = fopen('user.txt', 'w');
foreach ($data as $line) {
    fwrite($usersfile, $line);
}
fclose($usersfile);
// go back to table.php
header("Location: table.php");
