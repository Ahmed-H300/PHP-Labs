<?php

session_start();
if (!$_SESSION["login"]) {
    header("Location: login.php");
    exit;
}

$index = $_GET["index"];
$errors = array();
$data = array();
if (isset($_GET["errors"])) {
    $errors = json_decode($_GET["errors"], true);
    $data = json_decode($_GET["data"], true);
} else {
    include('dbManager.php');
    $data = $dbManager->getUser($index);
    if (!empty($data["skill"])) {
        $data["skill"] = json_decode($data["skill"]);
    }
    $data["password"] = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ITI Smart Village</title>
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <header>
            <img class="header__logo" src="iti-logo.png" alt="iti-logo" />
            <h1 class="header__text">ITI Smart Village</h1>
        </header>
        <hr>
        <main>
            <section>
                <h2>Edit User: press Save to save your edit</h2>
                <form id="regform" <?php echo "action='save.php?index=$index'" ?> method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Regestiration Form</legend>
                        <fieldset>
                            <legend>Personal Information</legend>
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" placeholder="Your first name.." <?php if (isset($data["fname"]) and !empty($data["fname"])) echo "value=" . $data["fname"] ?>>
                            <span style="color: #a94442;"><?php if (isset($errors["fname"])) echo $errors["fname"] ?></span>
                            <br>
                            <br>
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="Your last name.." <?php if (isset($data["lname"]) and !empty($data["lname"])) echo "value=" . $data["lname"] ?>>
                            <span style="color: #a94442;"><?php if (isset($errors["lname"])) echo $errors["lname"] ?></span>
                            <br>
                            <br>
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="Your email.." <?php if (isset($data["email"]) and !empty($data["email"])) echo "value=" . $data["email"] ?>>
                            <span style="color: #a94442;"><?php if (isset($errors["email"])) echo $errors["email"] ?></span>
                            <br>
                            <br>
                            <label style="display: block; font-weight: bold" for="Address">Address</label>
                            <br>
                            <textarea id="Address" name="Address" placeholder="Write your Address.." cols="30" rows="10"><?php if (isset($data["Address"]) and !empty($data["Address"])) echo $data["Address"] ?></textarea>
                            <br>
                            <br>
                            <label for="country">Country</label>
                            <select id="country" name="country">
                                <option value="egypt" <?php if (isset($data["country"]) and !empty($data["country"])) {
                                                            if ($data["country"] == "egypt") echo "selected";
                                                        }  ?>>Egypt</option>
                                <option value="usa" <?php if (isset($data["country"]) and !empty($data["country"])) {
                                                        if ($data["country"] == "usa") echo "selected";
                                                    }  ?>>USA</option>
                                <option value="uk" <?php if (isset($data["country"]) and !empty($data["country"])) {
                                                        if ($data["country"] == "uk") echo "selected";
                                                    }  ?>>UK</option>
                            </select>
                            <br>
                            <br>
                            <label for="room">Room</label>
                            <select id="room" name="room">
                                <option value="application1" <?php if (isset($data["room"]) and !empty($data["room"])) {
                                                                    if ($data["room"] == "application1") echo "selected";
                                                                }  ?>>Application1</option>
                                <option value="application2" <?php if (isset($data["room"]) and !empty($data["room"])) {
                                                                    if ($data["room"] == "application2") echo "selected";
                                                                }  ?>>Application2</option>
                                <option value="cloud" <?php if (isset($data["room"]) and !empty($data["room"])) {
                                                            if ($data["room"] == "cloud") echo "selected";
                                                        }  ?>>Cloud</option>
                            </select>
                            <br>
                            <br>
                            <p id="label_specific">Gender</p>
                            <label for="male">Male</label>
                            <input value="male" type="radio" <?php if (isset($data["gender"]) and !empty($data["gender"])) {
                                                                    if ($data["gender"] == "male") echo "checked";
                                                                }  ?> name="gender" id="male">
                            <label for="female">Female</label>
                            <input value="female" type="radio" <?php if (isset($data["gender"]) and !empty($data["gender"])) {
                                                                    if ($data["gender"] == "female") echo "checked";
                                                                }  ?> name="gender" id="female">
                            <span style="color: #a94442;"><?php if (isset($errors["gender"])) echo $errors["gender"] ?></span>
                            <br>
                            <br>
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image">
                            <span style="color: #a94442;"><?php if (isset($errors["image"])) echo $errors["image"] ?></span>
                            <br>
                            <br>
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend>Skills</legend>
                            <br>
                            <input type="checkbox" name="skill[]" value="PHP" <?php if (isset($data["skill"]) and !empty($data["skill"])) {
                                                                                    if (in_array("PHP", $data["skill"])) echo "checked";
                                                                                }  ?>> PHP
                            <input type="checkbox" name="skill[]" value="JS" <?php if (isset($data["skill"]) and !empty($data["skill"])) {
                                                                                    if (in_array("JS", $data["skill"])) echo "checked";
                                                                                }  ?>> JS <br> <br>
                            <input type="checkbox" name="skill[]" value="MySQL" <?php if (isset($data["skill"]) and !empty($data["skill"])) {
                                                                                    if (in_array("MySQL", $data["skill"])) echo "checked";
                                                                                }  ?>> MySQL
                            <input type="checkbox" name="skill[]" value="PostgreSQL" <?php if (isset($data["skill"]) and !empty($data["skill"])) {
                                                                                            if (in_array("PostgreSQL", $data["skill"])) echo "checked";
                                                                                        }  ?>> PostgreSQL
                            <br>
                            <br>
                        </fieldset>
                        <br>
                        <fieldset>
                            <br>
                            <legend>User Login Information</legend>
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Your username.." <?php if (isset($data["username"]) and !empty($data["username"])) echo "value=" . $data["username"] ?>>
                            <span style="color: #a94442;"><?php if (isset($errors["username"])) echo $errors["username"] ?></span>
                            <br>
                            <br>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Your password.." <?php if (isset($data["password"]) and !empty($data["password"])) echo "value=" . $data["password"] ?>>
                            <span style="color: #a94442;"><?php if (isset($errors["password"])) echo $errors["password"] ?></span>
                            <br>
                            <br>
                            <label for="dep">department</label>
                            <input type="text" id="dep" name="dep" placeholder="open source" <?php if (isset($data["dep"]) and !empty($data["dep"])) echo "value=" . $data["dep"] ?>>
                            <br>
                            <br>
                        </fieldset>
                        <br>
                        <br>
                        <input type="submit" value="Save" />
                        <br>
                        <br>
                    </fieldset>
                </form>
                <br />
            </section>
        </main>
        <footer>
            <p>&copy; 2023 ITI Smart Village</p>
        </footer>
    </body>

    </html>