<?php

$captcha = '9h68G0';
if ($captcha != $_POST["captcha"]) {
    // Redirect browser
    header("Location: registration.php?status=false");
    exit();
}

function space()
{
    echo "<br>";
    echo "<br>";
}

$greet = $_POST["gender"] == "male" ? "Mr." : "Miss";
$name = $_POST["fname"] . $_POST["lname"];

space();
echo "Thanks $greet $name";
space();
echo "Please Review Your Information";
space();
echo "Name: " . $name;
space();
echo "Address: " . $_POST["Address"];
space();
echo "Country: " . $_POST["country"];
space();
echo "Your Skills: ";
if (isset($_POST["skill"])) {
    space();
    echo "<ul>";
    foreach ($_POST["skill"] as $skill) {
        echo "<li>$skill</li>";
        echo "<br>";
    }
    echo "</ul>";
}
else{
    echo "No Skills Selected";
}

space();
echo "Department: " . $_POST["dep"];
