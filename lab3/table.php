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
    <title>Table</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <header>
        <br>
        <br>
        <nav style="display: flex; justify-content: space-around; align-items: center; font-size: 25px;">
            <a style="text-decoration: none; color: #901b20;" href="table.php">Click here to go to Table</a>
            <a style="text-decoration: none; color: #901b20;" href="registration.php">Click here to go to Registration</a>
            <a style="text-decoration: none; color: #901b20;" href="logout.php">Click here to logout</a>
        </nav>
        <hr>

    </header>

</body>

</html>

<?php

$data = file('user.txt');

if (empty($data)) {

    echo '<h1 style="margin-left: 25%; color: #901b20;">No Data Found</h1>';
    exit();
}

echo "

<table class='table'>

    <thead>
        <tr>

        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Country</th>
        <th>Gender</th>
        <th>Skills</th>
        <th>Username</th>
        <th>Password</th>
        <th>Department</th>
        <th>Room</th>
        <th>Image</th>
        <th>Edit</th>
        <th>Delete</th>

        </tr>

        </thead>
    <tbody>

";

foreach ($data as $index => $value) {

    $arr = explode(':', $value);

    echo "<tr>";

    foreach ($arr as $key => $value) {

        if (empty($value)) $value = "NO DATA";
        if ($key === (count($arr) - 1)) {
            echo "<td><img src='$value' width='50px' height='50px'></td>";
        } else {

            echo "<td>$value</td>";
        }
    }

    echo "<td><a class='btn btn-warning' href='edit.php?index=$index'>Edit</a></td>";
    echo "<td><a class='btn btn-danger' href='delete.php?index=$index'>Delete</a></td>";

    echo "</tr>";
}


echo "

    
    </tbody>
 

</table>


";

?>