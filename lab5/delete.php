<?php


session_start();
if (!$_SESSION["login"]) {
    header("Location: login.php");
    exit;
}

include('dbManager.php');
$index = $_GET["index"];
$user = $dbManager->getUser($index);
$imgName = $user["image"];
unlink($imgName);
$dbManager->delUser($index);
// go back to table.php
header("Location: table.php");
