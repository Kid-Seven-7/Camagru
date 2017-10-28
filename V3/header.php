<header>
  <nav>
    <div class="head-wrapper">
      <ul>
        <li>
          <a href="index.php">
            Home
          </a>
        </li>
        <li>
          <a href="password.php">
            Forgot Password?
          </a>
        </li>
      </ul>
      <div class="nav-login">
        <form action="includes/validate.inc.php" method="post">
          <input type="text" name="uid"  placeholder="username/email">
          <input type="password" name="pwd"  placeholder="password">
          <button type="submit" name="submit">
            Login
          </button>
        </form>
      </div>
    </div>
  </nav>
</header>
