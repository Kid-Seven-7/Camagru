<?php

if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
      header("Location: ../signup.php?signup=empty_field");
      exit();
    }
    else {
      if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
        header("Location: ../signup.php?signup=invalid_name");
        exit();
      } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
              header("Location: ../signup.php?signup=password_too_sh");
              exit();
            } else {
              $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
              $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hashedpwd');";
              mysqli_query($conn, $sql);
              header("Location: ../home.php?signup=success");
              exit();
            }
          }
        }
      }
    }
} else {
  header("Location: ../signup.php");
  exit();
}
