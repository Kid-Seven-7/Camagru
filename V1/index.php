<?php

session_start();

if (isset($_GET['signup']) && $_GET['signup'] == "exists")
{
  echo ("<script>alert('Username unavailable')</script>");
}
else if (isset($_GET['signup']) && $_GET['sugnup'] == "empty")
{
  echo ("<script>alert('Required fields are empty')</script>;");
}
else if (isset($_GET['signup']) && $_GET['signup'] == "verify")
{
  echo ("<script>alert('A verification link has been sent to your email')</script>");
}
else if (isset($_GET['signup']) && $_GET['signup'] == "invalid")
{
  echo "<script>alert('Invalid username entered');</script>";
}
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="description" content="My Camagru Page">
      <meta name="keywords" content="HTML,CSS,PHP">
      <meta name="author" content="jngoma">
      <title>
        DS Homepage
      </title>
      <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body>
<?php
  include_once 'header.php';
?>
<?php
  include_once 'footer.php';
?>
  </body>
</html>
