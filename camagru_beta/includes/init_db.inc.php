<?php

require_once ('config.inc.php');

try {
  $conn = new PDO($DB_DNS, $DB_USER, $DB_PWD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $found = 1;
}
catch(PDOException $e) {
  $found = 0;
}

if ($found == 1) {
  try {
    $conn = new PDO($DB_HOST, $DB_USER, $DB_PWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $temp = $conn->prepare('drop database camagru');
    $temp->execute();
    echo "Database deleted<br>";
  }
  catch(PDOException $e) {
    $found = 0;
    echo "Database not found ";
    echo "ERROR: " . $e->getMessage() . "<br>";
  }
  $conn = null;
}

try {
  $conn = new PDO($DB_HOST, $DB_USER, $DB_PWD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $temp = $conn->prepare('create database camagru');
  $temp->execute();
  if ($found == 1) {
    echo "Recreating the database<br>";
  } else {
    echo "Creating the database<br>";
  }
  echo "Database created successfully<br>";

  try
  {
      $conn = new PDO($DB_DNS, $DB_USER, $DB_PWD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //Preparing the query
      echo "Creating users table <br/>";
      $stmt = $conn->prepare('CREATE TABLE users (
          id int(11) not null PRIMARY KEY AUTO_INCREMENT,
          uid varchar(20) not null,
          email varchar(40) not null,
          pwd varchar(20) not null,
          active int(1) not null DEFAULT 0,
          con_code varchar(20) not null
          );'
      );
      //executing the query
      $stmt->execute();
      echo "Users table created!";

      echo "Creating comments table <br/>";
      $stmt = $conn->prepare('CREATE TABLE comments (
          id int(11) not null PRIMARY KEY AUTO_INCREMENT,
          comment varchar(255) not null,
          uid varchar(20) not null
          );'
      );
      //executing the query
      $stmt->execute();
      echo "Comments table created!";

      echo "Creating images table <br/>";
      $stmt = $conn->prepare('CREATE TABLE images (
          id int(11) not null PRIMARY KEY AUTO_INCREMENT,
          image_name varchar(20) not null
          );'
      );
      //executing the query
      $stmt->execute();
      echo "Images table created!";
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
