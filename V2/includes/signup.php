<?php

if (isset($_POST['submit']))
{
    include_once('db.php');

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passwd = mysqli_real_escape_string($conn, $_POST['password']);

    //Error handling
    //Empty fields
    /*if (empty($username) || empty($email) || empty('password'))
    {
        header("Location: ../index.php?signup=empty");
        exit();
    }
    else*/ if (!preg_match("/^[a-zA-Z]*$/", $username)) //Checking if the username is characters only
    {
        header("Location: ../index.php?signup=invalid");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../index.php?signup=email");
        exit();
    }
    else
    {
        //checking if the username exists
        $sql = "SELECT * FROM users WHERE user_name = '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0)
        {
            header("Location: ../index.php?signup=exists");
            exit();
        }
        else
        {
            //randomising the com_code for user verification
            $com_code = hash('whirlpool', rand(0, 10000));
            //hashing the password
            $hashedPw = password_hash($passwd, PASSWORD_DEFAULT);
            //Insert the user into the database
            $sql = "INSERT INTO users (username, email, password, com_code) VALUES ('$username', '$email', '$hashedPw', '$com_code');";
            mysqli_query($conn, $sql);

            //sending the mail
            $subject = "verification";
            $msg = "Dear $username your verification code is $com_code";
            $headers = 'From: jngoma@student.wethinkcode.co.za';
            mail($email, $subject, $msg, $headers);
            header("Location: ../index.php?signup=verify");
            exit();
        }
    }
}
else
{
    header("Location: ../index.php");
}
?>
