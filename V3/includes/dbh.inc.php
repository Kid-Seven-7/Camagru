<?php
  $dsn = 'mysql:host=localhost;dbname=camagru';
  $username = 'root';
  $password = 'joseph07';

  try {
    $db = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit();
  }
?>
