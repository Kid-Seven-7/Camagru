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
  <header class="nav">
    <div class="navbar">
      <a href="index.php">
        Home
      </a>
    </div>
    <div class="regdiv">
      <form action="includes/signup.php" method="POST" class="regbar">
        <input type="text" name="user_name" placeholder="Username"/>
        <input type="email" name="email" placeholder="Email Address"/>
        <input type="password" name="passwd" placeholder="Password"/>
        <button type="submit" name="submit">Register</button>
        <button formaction="login.php">Login</button>
      </form>
    </div>
  </header>
</body>
</html>
