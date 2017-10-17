<?php
if (isset($_POST['submit'])) {
    include_once('db.php');
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    //Error handling
    //Empty fields
    /*if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($repassword)) {
        header("Location: ../index.php?signup=empty");
        exit();
    } else*/if (strlen($password) < 8) {
      header("Location: ../index.php?signup=password_too_short");
      exit();
      if (!ctype_upper($password) && !ctype_lower($password)) {
        header("Location: ../index.php?signup=password_not_complex");
        exit();
      }
    } else if (!preg_match("/^[a-zA-Z]*$/", $username)) {
        header("Location: ../index.php?signup=invalid");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?signup=email");
        exit();
    } /*elseif (!($password == $repassword)) {
      header("Location: ../index.php?signup=password_dont_match");
      exit();
    }*/else {
        //checking if the username exists
        $sql = "SELECT * FROM users WHERE user_name = '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0)
        {
            header("Location: ../index.php?signup=exists");
            exit();
        } else {
            //randomising the com_code for user verification
            $com_code = hash('whirlpool', rand(0, 10000));
            $active = 0;
            //hashing the password
            $hashedPw = password_hash($passwd, PASSWORD_DEFAULT);
            //Insert the user into the database
            $sql = "INSERT INTO users (username, email, password, com_code, active) VALUES ('$username', '$email', '$password', '$com_code', '$active');";
            mysqli_query($conn, $sql);
            //sending the mail
            $to = $email;
            $subject = "Hello world";
            $msg = "Hello world";
            $headers = 'From: joseph.ngoma0707@gmail.com';
            mail($to, $subject, $msg, $headers);
            header("Location: ../index.php?signup=verify");
            exit();
        }
    }
}
else {
    header("Location: ../index.php?failed");
}
?>
