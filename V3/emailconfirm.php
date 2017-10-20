<?php
if (isset($_GET['username']) && $_GET['username'] == $username) {
  if (isset($_GET['code']) && $_GET['code'] == $confirmcode) {
    echo "<script>alert('Your confirmation was successful')</script>";
  }
}
?>
<?php
  include_once 'head.php'
?>
<body>
<?php
include_once 'signedin.php'
?>
<?php
include_once 'camera.php'
?>
<?php
  include_once 'footer.php'
?>
</body>
</html>
