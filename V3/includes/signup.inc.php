<?php

if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);

    if (!empty($pwd) && !empty($pwd1)) {
      if ($pwd != $pwd1) {
        header("Location: ../signup.php?signup=pwd_dont_match");
        exit();
      }
    }
    /*if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
      header("Location: ../signup.php?signup=empty_field");
      exit();
    }
    else {*/
      if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
        header("Location: ../signup.php?signup=invalid_name");
        exit();
      } else {
        $sql = "SELECT * FROM users WHERE user_email='$email'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        if ($resultcheck > 0) {
          header("Location: ../signup.php?signup=email_in_use");
          exit();
        } if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          header("Location: ../signup.php?signup=invalid_email");
          exit();
        } else {
          $sql = "SELECT * FROM users WHERE user_id='$uid'";
          $result = mysqli_query($conn, $sql);
          $resultcheck = mysqli_num_rows($result);
          if ($resultcheck > 0) {
            header("Location: ../signup.php?signup=username_taken");
            exit();
          } else {
            if (strlen($pwd) < 8) {
              header("Location: ../signup.php?signup=password_too_short");
              exit();
            } else {
              $confirmcode = rand();
              $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
              $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, com_code, confirmed) VALUES ('$first', '$last', '$email', '$uid', '$hashedpwd', '$confirmcode', '0');";
              mysqli_query($conn, $sql);
              $message = "
                Confirm your email
                Please click the link below to verify your email
                http://localhost:8080/V3/emailconfirm.php?username=$username&code=$confirmcode
              ";
              mail($email, "Email verification", $message, "From: DoNotReply@digitalsunset.org");
              header("Location: ../signup.php?signup=success");
              exit();
            }
          }
        }
      }
    //}
} else {
  header("Location: ../signup.php");
  exit();
}
