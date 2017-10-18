<header class="nav">
  <div class="navbar">
    <a href="index.php">
      Home
    </a>
  </div>
  <div class="regdiv">
    <form action="includes/signup.php" method="POST" class="regbar">
      <input type="text" name="user_name" placeholder="Username"/>
      <input type="email" name="email" placeholder="Email Address"/>
      <input type="password" name="passwd" placeholder="Password"/>
      <button type="submit" name="submit">Register</button>
      <button formaction="login.php">Login</button>
    </form>
  </div>
</header>
