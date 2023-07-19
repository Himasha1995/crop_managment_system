<?php
$hostName ="localhost";
$dbUser ="root";
$dbPassword = "";
$dbName ="crop_managment";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if(!$conn)
{
    die("Something went wrong;");
}
?>