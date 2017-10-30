<form class="signup-form" action="includes/signup.inc.php" method="post">
  <input type="text" name="first" placeholder="Firstname" required>
  <input type="text" name="last" placeholder="Lastname" required>
  <input type="email" name="email" placeholder="E-mail" required>
  <input type="text" name="uid" placeholder="Username" required>
  <input type="password" pattern=".{8,20}" name="pwd" placeholder="Password (8-20 characters)" required>
  <input type="password" pattern=".{8,20}" name="pwd1" placeholder="Confirm Password" required>
  <button type="submit" name="submit">
    Sign up
  </button>
</form>
