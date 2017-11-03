<?php
session_start();

if (isset($_GET['signup']) && $_GET['signup'] == "u_name")
{
  echo ("<script>alert('Username is not available')</script>");
}
else if (isset($_GET['signup']) && $_GET['signup'] == "email")
{
  echo ("<script>alert('The email entered has been used before')</script>;");
}
else if (isset($_GET['code']) && $_GET['code'] == -1)
{
  echo ("<script>alert('Error: Code is invalid')</script>;");
}
else if (isset($_GET['signup']) && $_GET['signup'] == "empty")
{
  echo ("<script>alert('Required fields are empty')</script>;");
}
else if (isset($_GET['verify']) && $_GET['verify'] == 0)
{
  echo ("<script>alert('A verification link has been sent to your email')</script>");
}
else if (isset($_GET['signup']) && $_GET['signup'] == "invalid")
{
  echo "<script>alert('Invalid username entered');</script>";
}
else if (isset($_GET['forgot']) && $_GET['forgot'] == 1)
{
  echo ("<script>alert('A reset link has been sent to your email');</script>");
}
else if (isset($_GET['user']) && $_GET['user'] == "res")
{
  echo ("<script>alert('Please login first');</script>");
}
else if (isset($_GET['pas']) && $_GET['pas'] == "weak")
{
  echo ("<script>alert('Password too short. Password must be 8 or more characters, have atleast one lowercase and one uppercase letter');</script>");
}
else if (isset($_GET['con']))
{
  echo ("<script>alert('Connection to the server failed');</script>");
}

?>

<!DOCTYPE html>
<html >
<?php include_once 'head.php'; ?>
<body>
<div class="pen-title">
    <h1>PixelX</h1><span> <i class='fa fa-code'></i> </span>
</div>

<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
  </div>
  <div class="form">
    <h2>Create an account</h2>
    <form action="config/signup.php" method="POST">
      <input type="text" name="user_name" placeholder="Username"/>
      <input type="password" name="passwd" placeholder="Password"/>
      <input type="email" name="email" placeholder="Email Address"/>
      <button type="submit" name="submit">Register</button><br/>
      <button formaction="login.php">Login</button>
    </form>
  </div>
</div>
</body>
</html>
