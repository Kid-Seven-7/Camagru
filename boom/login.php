<?php

session_start();
require_once ('config/database.php');

if (isset($_GET['login']) && $_GET['login'] == "invalid")
{
    echo "<script>alert('Invalid username/password entered');</script>";
}
else if (isset($_GET['verify']) && $_GET['verify'] == 0)
{
    echo ("<script>alert('You need to verify your account before you can log in');</script>");
}
else if (isset($_GET['user']) && $_GET['user'] == "not_found")
{
    echo ("<script>alert('Login details did not match any of our records. Check your details carefully');</script>");
}
else if (isset($_GET['code']) && $_GET['code'] == -1)
{
    echo ("<script>alert('Error: Code is nolonger valid');</script>");
}
else if (isset($_GET['user']) && $_GET['user'] == "invalid")
{
    echo ("<script>alert('Error: Username / Password is incorrect');</script>");
}
else if (isset($_GET['not_active']))
{
    echo ("<script>alert('You need to activate your account');</script>");
}
else if (isset($_GET['con']) && $_GET['con'] == "error")
{
  echo ("<script>alert('Connection to the server failed');</script>");
}
else if (isset($_GET['reset']) && $_GET['reset'] == "suc")
{
  echo ("<script>alert('Password updated successfully');</script>");
}
else if (isset($_GET['verify']) && $_GET['verify'] == 1)
{
    if ($_SESSION['username'] && $_SESSION['email'])
    {
        $name = $_SESSION['username'];
        $email = $_SESSION['email'];

        try
        {
            //TODO
            $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(array(':email' => $email));

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result))
            {
                foreach($result as $row)
                {
                    //TODO
                    if ($row['active'] == 1)
                    {
                        $_SESSION['username'] = $row['user_name'];
                        $_SESSION['email'] = $row['email'];
                        header("Location: cam.php?login=1");
                        exit();
                    }
                    else
                    {
                        header("Location: login.php?not_active");
                        exit();
                    }
                }
            }
        }
        catch(PDOException $e)
        {
            //TODO
            header("Location: login.php?con=error");
            exit();
        }
    }
    else
    {
        header("Location: login.php?user=invalid");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="pen-title">
    <h1>PixelX</h1>
</div>

<div class="module form-module">
    <div class="toggle"><i class="fa fa-times fa-pencil"></i>
</div>
<div class="form">
    <h2>Login to your account</h2>
    <form action="config/login.inc.php" method="POST">
        <input type="email" name="email" placeholder="Email"/>
        <input type="password" name="passwd" placeholder="Password"/>
        <button type="submit" name="submit">Login</button>
        <button formaction="index.php">Register</button>
        <button formaction="forgot.php">Forgot Password?</button>
    </form>
</div>
</div>
</body>
</html>