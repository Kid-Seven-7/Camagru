<?php

session_start();
require_once('config/database.php');

if (isset($_GET['code']) && isset($_GET['email']) && isset($_GET['com']))
{
    $email = $_GET['email'];
    $code = $_GET['code'];

    try
    {
        $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(array(':email' => $email));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result))
        {
            foreach($result as $row)
            {
                if ($row['con_code'] == $code)
                {
                    $new_code = hash('whirlpool', rand(0, 1000000));
                    try
                    {
                        //changing the con_code in the database
                        $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = $conn->prepare("UPDATE users
                        SET con_code = :code
                        WHERE email = :email");

                        $stmt->execute(array('code' => $new_code, 'email' => $email));
                        $_SESSION['new_code'] = $new_code;
                        $_SESSION['email'] = $email;
                    }
                    catch (PDOException $e)
                    {
                        header("Location: forgot.php?con=error");
                        exit();
                    }
                }
                else
                {
                    //Code doesn't match
                    header("Location: forgot.php?code=-1");
                    exit();
                }
            }
        }
        else
        {
            //User doesn't exist
            header("Location: forgot.php?email_not_found");
            exit();
        }
    }
    catch(PDOException $e)
    {
        header("Location: forgot.php?con=error");
        exit();
    }
}
else if (isset($_GET['pas']) && $_GET['pas'] == "weak")
{
  echo ("<script>alert('Password too short. Password must be 8 or more characters, have atleast one lowercase and one uppercase letter');</script>");
}
else if (isset($_GET['empty']))
{
  echo ("<script>alert('Fields are empty')</script>");
}
else if (isset($_GET['match']))
{
  echo ("<script>alert('Password does not match')</script>");
}
else
{
    //if the page is not entered correctly
    header("Location: forgot.php");
    exit();
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
    <div class="toggle"><i class="fa fa-times fa-pencil"></i>
</div>
<div class="form">
    <h2>Create a new password</h2>
    <form action="config/update.php" method="POST">
        <input type="password" name="newpd" placeholder="Enter new password"/>
        <input type="password" name="conpd" placeholder="Confirm password"/>
        <button type="submit" name="submit" value="GO">Go!</button>
        <button formaction="login.php">Login</button>
    </form>
</div>
</div>
</body>
</html>
