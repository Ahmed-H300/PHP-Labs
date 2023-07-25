<?php
session_start();
if (!$_SESSION["login"]) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <header>
        <img class="header__logo" src="iti-logo.png" alt="iti-logo">
        <h1 class="header__text">ITI Smart Village</h1>
        <hr>
        <nav style="display: flex; justify-content: space-around; align-items: center; font-size: 25px;">
            <a style="text-decoration: none; color: #901b20;" href="table.php">Click here to go to Table</a>
            <a style="text-decoration: none; color: #901b20;" href="registration.php">Click here to go to Registration</a>
            <a style="text-decoration: none; color: #901b20;" href="logout.php">Click here to logout</a>
        </nav>
    </header>
    <hr>
    <main>
        <?php echo "<h1 >Hello {$_SESSION["username"]}</h1>" ?>
    </main>
</body>

</html>