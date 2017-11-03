<?php

require_once('config/database.php');

if (isset($_GET['reset']) && $_GET['reset'] == 1)
{
    echo ("<script>alert('A reset link has been sent your email')</script>");
}
else if (isset($_GET['con']) && $_GET['con'] == "error")
{
  echo ("<script>alert('Connection to the server failed');</script>");
}
else if (isset($_GET['verify']) && $_GET['verify'] == -1)
{
  echo ("<script>alert('This account is not yet varified');</script>");
}
else if (isset($_GET['email']))
{
  echo ("<script>alert('Enter your email to get a reset link');</script>");
}
else if (isset($_GET['email_not_found']))
{
  echo ("<script>alert('This is not a registered email. Please register to get an account');</script>");
}
else if (isset($_GET['con']) && $_GET['con'] == "error")
{
  echo ("<script>alert('Connection to the server failed');</script>");
}
else if (isset($_GET['code']) && $_GET['code'] == -1)
{
  echo ("<script>alert('Invalid code entered. To reset your account enter your email and submit');</script>");
}
?>

<!DOCTYPE html>
<html>
<?php include_once 'head.php'; ?>
<body>
<div class="pen-title">
    <h1>PixelX</h1>
</div>

<div class="module form-module">
    <div class="toggle">
</div>
<div class="form">
    <h2>Enter your email</h2>
    <form action="config/forgot.inc.php" method="POST">
        <input type="email" name="email" placeholder="E-mail"/>
        <button type="submit" name="submit">Submit</button>
        <button formaction="login.php">Login</button>
    </form>
</div>
</div>
</body>
</html>
