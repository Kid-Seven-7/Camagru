<?php
if (isset($_GET['login']) && $_GET['login'] == "invalid") {
    echo "<script>alert('Invalid username/password entered');</script>";
} else if (isset($_GET['verify']) && $_GET['verify'] === 0) {
    echo ("<script>alert('You need to verify your account before loggin');</script>");
}
//You need to check if verify == 1 so that you can log in the user
?>
