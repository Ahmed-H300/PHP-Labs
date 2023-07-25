<?php


$errors = array();
$data = array();
if (isset($_GET["errors"])) {
    $errors = json_decode($_GET["errors"], true);
    $data = json_decode($_GET["data"], true);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header style="display: flex; justify-content: center; align-items: center;">
        <img class="header__logo" src="iti-logo.png" alt="iti-logo">
        <h1 class="header__text" style="margin-top: 20px; font-family: serif, 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">ITI Smart Village</h1>
    </header>
    <hr>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <!-- Change the class from "bg-primary" to "bg-custom" -->
                    <div class="card-header bg-custom text-white" style="background-color: #901b20; border-color: #901b20;">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="validate.php" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <span style="color: #a94442;"><?php if (isset($errors["username"])) echo $errors["username"] ?></span>
                                <input type="text" class="form-control" id="username" name="username" <?php if (isset($data["username"]) and !empty($data["username"])) echo "value=" . $data["username"] ?>>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <span style="color: #a94442;"><?php if (isset($errors["password"])) echo $errors["password"] ?></span>
                                <input type="password" class="form-control" id="password" name="password" <?php if (isset($data["password"]) and !empty($data["password"])) echo "value=" . $data["password"] ?>>
                            </div>
                            <span style="color: #a94442;"><?php if (isset($errors["login"])) echo $errors["login"] ?></span><br>
                            <!-- Add inline styles for background and button color -->
                            <button type="submit" class="btn btn-primary" style="background-color: #901b20; border-color: #901b20;">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>