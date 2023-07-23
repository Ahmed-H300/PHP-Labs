<?php

session_start();
if (!$_SESSION["login"]) {
    header("Location: login.php");
    exit;
}

function validateEmailUsingFilter($email)
{
    // Validate the email using filter_var function with FILTER_VALIDATE_EMAIL filter
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        return true; // Email is valid
    } else {
        return false; // Email is invalid
    }
}

function validateEmailUsingRegex($email)
{
    // Regular expression pattern for email validation
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    // Check if the email matches the pattern
    if (preg_match($pattern, $email)) {
        return true; // Email is valid
    } else {
        return false; // Email is invalid
    }
}

function validatePassword($password)
{
    // Check if the password is exactly 8 characters long
    if (strlen($password) !== 8) {
        return false;
    }

    // Check if the password contains any special characters (excluding underscore)
    if (preg_match('/[^a-zA-Z0-9_]/', $password)) {
        return false;
    }

    // Check if the password contains any capital letters
    if (preg_match('/[A-Z]/', $password)) {
        return false;
    }

    return true; // Password meets all requirements
}

if (isset($_POST["captcha"])) {
    $captcha = '9h68G0';
    $status = "true";
    if ($captcha !== $_POST["captcha"]) {
        $status = "false";
    }
}

if (isset($_GET["index"])) {
    $index = $_GET["index"];
}

$error = array();

if (!isset($_POST["fname"]) or empty($_POST["fname"])) {

    $error["fname"] = 'First Name is Required';
}
if (!isset($_POST["lname"]) or empty($_POST["lname"])) {
    $error["lname"] = 'Last Name is Required';
}
if (!isset($_POST["email"]) or empty($_POST["email"])) {
    $error["email"] = 'Email is Required';
} elseif (!validateEmailUsingRegex($_POST["email"])) {
    $error["email"] = 'Invalid email, Please Try Again!';
} elseif (!validateEmailUsingFilter($_POST["email"])) {
    $error["email"] = 'Invalid email, Please Try Again!';
}
if (!isset($_POST["gender"]) or empty($_POST["gender"])) {
    $error["gender"] = 'Gender is Required';
}
if (!isset($_POST["password"]) or empty($_POST["password"])) {
    $error["password"] = 'Password is Required';
} elseif ((!isset($_GET["index"])) and (!isset($_POST["confirmpassword"]) or empty($_POST["confirmpassword"]))) {
    $error["password"] = 'Confirm Password is Required';
} elseif ((!isset($_GET["index"])) and (strcmp($_POST["confirmpassword"], $_POST["password"]))) {
    $error["password"] = 'Confirm Password is Not the same as Password';
} elseif (!validatePassword($_POST["password"])) {
    $error["password"] = 'Password must be 8 chars - no special chars -only underscore allowed - no Capital characters';
}
$newName = '';
if (isset($_FILES["image"]) and !empty($_FILES["image"]["name"])) {

    $extension = pathinfo($_FILES["image"]["name"])['extension'];
    if (in_array($extension, array('jpg', 'png'))) {
        $newName = 'images/' . time() . '.' . $extension;
        move_uploaded_file($_FILES["image"]["tmp_name"], $newName);
    } else {
        $error["image"] = 'File type is invalid';
    }
} else if (!isset($_GET["index"])) {
    $error["image"] = 'image is Required';
}

if ((empty($error) and (isset($_GET["index"]))) or (empty($error) and ($status === "true"))) {

    $skillsaved = isset($_POST["skill"]) ? json_encode($_POST["skill"]) : "";

    $line = $_POST["fname"] . ':' .  $_POST["lname"] . ':' .  $_POST["email"] . ':' .  $_POST["Address"] . ':' .  $_POST["country"] . ':' .  $_POST["gender"] . ':' .  $skillsaved . ':' .  $_POST["username"] . ':' .  md5($_POST["password"]) . ':' .  $_POST["dep"] . ':' .  $_POST["room"] . ':' . $newName . "\n";

    if (isset($_POST["captcha"])) {
        // append to data
        $file = fopen('user.txt', 'a');
        fwrite($file, $line);
        fclose($file);
    } else {
        $data = file('user.txt');
        if (empty($newName)) {
            $line = rtrim($line, "\n");
            $arrpos = strrpos($data[$index], ':');
            $line = $line . substr($data[$index], $arrpos + 1);
        }
        $data[$index] = $line;
        $usersfile = fopen('user.txt', 'w');
        foreach ($data as $line) {
            fwrite($usersfile, $line);
        }
        fclose($usersfile);
    }


    // go back to table.php
    header("Location: table.php");
    exit();
}

if (isset($_POST["captcha"])) {
    $formerror = json_encode($error);
    $_POST["password"] = "";
    $_POST["captcha"] = "";
    $cdata = json_encode($_POST);
    header("Location: registration.php?status=$status&errors=$formerror&data=$cdata");
} else {
    $formerror = json_encode($error);
    $_POST["password"] = "";
    $cdata = json_encode($_POST);
    header("Location: edit.php?index=$index&errors=$formerror&data=$cdata");
}
