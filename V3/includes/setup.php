<?php

 require_once ('database.php');

try
{
    $conn = new PDO('mysql:host=127.0.0.1', $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('DROP DATABASE camagru');

    $stmt->execute();
    echo "Database deleted <br/>";
    $found = 1;
}
catch (PDOException $e)
{
    $found = 0;
}
$conn = null;

try
{
    $conn = new PDO('mysql:host=127.0.0.1', $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('CREATE DATABASE camagru');

    $stmt->execute();
    if ($found == 1)
    {
        echo "Re-creating database <br/>";
    }
    else
    {
        echo "Creating database <br/>";
    }
    echo "Done! <br/>";

    try
    {
        $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare('CREATE TABLE users (
            id int(11) not null PRIMARY KEY AUTO_INCREMENT,
            first varchar(20) not null,
            last varchar(20) not null,
            email varchar(30) not null,
            uid int(20) not null,
            status varchar(20) not null,
            con_code varchar(20) not null,
            pwd varchar(20) not null
        );');

        $stmt->execute();
        echo "Table created!";
    }
    catch (PDOException $e)
    {
        echo "Unable to create table <br/>";
        echo "ERROR: ".$e->getMessage()."<br/>";
    }
}
catch (PDOException $e)
{
    echo "Unable to create database <br/>";
    echo "ERROR: ".$e->getMessage()."<br/>";
}
$conn = null;
?>
