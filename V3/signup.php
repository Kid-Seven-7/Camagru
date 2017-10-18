<?php
  if (isset($_GET['signup']) && $_GET['signup'] == "email_in_use") {
    echo "<script>alert('This email address is already in use')</script>";
  }
  if (isset($_GET['signup']) && $_GET['signup'] == "empty_field") {
    echo "<script>alert('Please fill in all the fields')</script>";
  }
  if (isset($_GET['signup']) && $_GET['signup'] == "invalid_name") {
    echo "<script>alert('Please enter a valid first and last name')</script>";
  }
  if (isset($_GET['signup']) && $_GET['signup'] == "invalid_email") {
    echo "<script>alert('The email address you entered is not valid, please use a valid email address')</script>";
  }
  if (isset($_GET['signup']) && $_GET['signup'] == "username_taken") {
    echo "<script>alert('This username is already in use, Please choose another one')</script>";
  }
  if (isset($_GET['signup']) && $_GET['signup'] == "password_too_short") {
    echo "<script>alert('Please enter a password that is at least 8 characters long')</script>";
  }
  if (isset($_GET['signup']) && $_GET['signup'] == "pwd_dont_match") {
    echo "<script>alert('congratulation $first you registration was successful')</script>";
  }
  if (isset($_GET['signup']) && $_GET['signup'] == "success") {
    echo "<script>alert('congratulation $first you registration was successful')</script>";
  }
?>

<DOCTYPE html>
<html>
<?php
  include_once 'head.php'
?>
  <body>
<?php
  include_once 'header.php'
?>
    <section class="main-container">
        <div class="main-wrapper">
          <h2>
            Signup
          </h2>
          <form class="signup-form" action="includes/signup.inc.php" method="post">
            <input type="text" name="first" placeholder="Firstname">
            <input type="text" name="last" placeholder="Lastname">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd1" placeholder="Confirm Password">
            <button type="submit" name="submit">
              Sign up
            </button>
          </form>
        </div>
    </section>
<?php
    include_once 'footer.php'
?>
  </body>
</html>
