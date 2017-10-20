<?php
if (isset($_POST['sumbit'])) {
  $sql = "SELECT * FROM users WHERE user_email='$email'";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);
  if ($resultcheck > 0) {
    sql = "SELECT * FROM users WHERE user_id='$uid'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if ($resultcheck > 0) {
      header("Location: ../signedin.php?signin=invalid_email/password");
      exit();
    } else {
      //CHECK PASSWORD
    }
  } else {
    //CHECK PASSWORD
  }
}
