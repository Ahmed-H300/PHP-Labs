<?php

include('dbManager.php');

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
if (!isset($_POST["username"]) or empty($_POST["username"])) {
    $error["username"] = 'username is Required';
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

    $user  = array();
    $user["fname"] = $_POST["fname"];
    $user["lname"] = $_POST["lname"];
    $user["email"] = $_POST["email"];
    $user["Address"] = $_POST["Address"];
    $user["country"] = $_POST["country"];
    $user["gender"] = $_POST["gender"];
    $user["skill"] = $skillsaved;
    $user["username"] = $_POST["username"];
    $user["password"] = md5($_POST["password"]);
    $user["dep"] = $_POST["dep"];
    $user["room"] = $_POST["room"];
    $user["image"] = $newName;
    if (isset($_POST["captcha"])) {
        $checkusername = $dbManager->checkifusernameexist($user["username"]);
        if (empty($checkusername)) {
            // append to data
            $dbManager->insertUser($user);
            // go back to table.php
            header("Location: table.php");
            exit();
        } else {
            $error["username"] = 'username is already taken';
        }
    } else {
        $olduser = $dbManager->getUser($index);
        if (empty($newName)) {
            $user["image"] = $olduser["image"];
        }
        $checkusername = $dbManager->checkifusernameexist($user["username"]);
        // var_dump($checkusername);
        // var_dump($checkusername["id"]);
        // var_dump($olduser["id"]);
        // exit;
        if (empty($checkusername) or $checkusername["id"] === $olduser["id"]) {
            // var_dump($checkusername["username"]);
            // var_dump($user["username"]);
            // var_dump(empty($checkusername));
            // var_dump(empty($checkusername) or $olduser === $user["username"]);
            // exit;
            // append to data
            $dbManager->updateUser($index, $user);
            // go back to table.php
            header("Location: table.php");
            exit();
        } else {
            $error["username"] = 'username is already taken';
        }
    }
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
