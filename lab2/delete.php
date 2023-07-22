<?php

$index = $_GET["index"];
$data = file('data.txt');
unset($data[$index]);
$usersfile = fopen('data.txt', 'w');
foreach ($data as $line) {
    fwrite($usersfile, $line);
}
fclose($usersfile);
// go back to table.php
header("Location: table.php");
