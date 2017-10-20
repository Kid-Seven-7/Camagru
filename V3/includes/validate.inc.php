<?php
if (isset($_POST['sumbit'])) {
  $sql = "SELECT * FROM users WHERE user_email='$email'";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);
  } else {
    //CHECK PASSWORD
  }
}
