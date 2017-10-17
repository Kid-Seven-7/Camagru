<?php

$dbServer = "localhost";
$dbUserName = "root";
$dbPasswd = "joseph07";
$dbName = "camagru";

$conn = mysqli_connect($dbServer, $dbUserName, $dbPasswd, $dbName);

//checking server connection
if (!$conn)
{
    header("Location: ../index.php?server=error");
    exit();
}
?>
