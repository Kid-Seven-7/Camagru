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
<html >
<head>
  <meta charset="UTF-8">
  <title>
    DS Homepage
  </title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
  include_once 'header.php';
?>
</body>
</html>
