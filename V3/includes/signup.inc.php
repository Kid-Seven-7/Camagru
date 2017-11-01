<?php

if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);

    $_SESSION['uid'] = $uid;

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
        } /*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          header("Location: ../signup.php?signup=invalid_email");
          exit();
        }*/ else {
          $sql = "SELECT * FROM users WHERE user_id='$uid'";
          $result = mysqli_query($conn, $sql);
          $resultcheck = mysqli_num_rows($result);
          if ($resultcheck > 0) {
            header("Location: ../signup.php?signup=username_taken");
            exit();
          } /*else {
            if (strlen($pwd) < 8) {
              header("Location: ../signup.php?signup=password_too_short");
              exit();
            }*/ else {
            try {
                $conn = new PDO($dsn, $username, $password);

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
                $sql = "INSERT INTO users (first, last, email, uid, status, con_code, pwd)
                VALUES ('$first, $last, $email, $uid, $status, $con_code, $pwd')";
                $conn->exec();
                 echo "Success";
            }
                catch(PDOException $e){
                  echo $sql . "<br>" . $e->getMessage();
                }
                $sql = null;
              $message = "
                Confirm your email
                Please click the link below to verify your email
                http://localhost:8080/V3/emailconfirm.php?username=$username&code=$confirmcode
              ";
              mail($email, "Email verification", $message, "From: DoNotReply@digitalsunset.org");
              $_SESSION['connect'] = 1;
              header("Location: ../signup.php?signup=success");
              exit();
            }
          }
        }
      //}
    //}
} else {
  header("Location: ../signup.php");
  exit();
}
