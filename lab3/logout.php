<?php
session_start();

session_unset();

$cookie_value = $_COOKIE["PHPSESSID"];

setcookie("PHPSESSID", $cookie_value, time() - 3600, "/");

session_destroy();

header("Location: login.php");
