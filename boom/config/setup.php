<?php
//AUTHOR : amatshiy

require_once ('database.php');

//checking if the database exists
try
{
    $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $found = 1;
}
catch(PDOException $e)
{
    $found = 0;
}

//Deleting the database if it exists...
if ($found == 1)
{
    try
    {
        $conn = new PDO('mysql:host=127.0.0.1', $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Preparing the query
        $stmt = $conn->prepare('DROP DATABASE mydata');
        
        //executing the query
        $stmt->execute();
        echo "Database deleted <br/>";
        $found = 1;
    }
    catch (PDOException $e)
    {
        $found = 0;
        echo "Database not found ";
        echo "Error: ".$e->getMessage()."<br/>";
    }
    $conn = null;
}

//Re-creating the database
try
{
    $conn = new PDO('mysql:host=127.0.0.1', $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Preparing the query
    $stmt = $conn->prepare('CREATE DATABASE mydata');
    
    //executing the query
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

    //Creating table users
    try
    {
        $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Preparing the query
        echo "Creating table <br/>";
        $stmt = $conn->prepare('CREATE TABLE users (
            id int(11) not null PRIMARY KEY AUTO_INCREMENT,
            user_name varchar(255) not null,
            email varchar(255) not null,
            passwd varchar(255) not null,
            active int(1) not null DEFAULT 0,
            con_code varchar(255) not null
            );'
        );
        //executing the query
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