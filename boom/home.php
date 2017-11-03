<?php

include_once ('config/database.php');

if (isset($_GET['verify']) && $_GET['verify'] == 1 && isset($_GET['name']) && isset($_GET['code']) && isset($_GET['com']))
{
$name = $_GET['name'];
$code = $_GET['code'];

try
{
    //
    $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = :username");
    $stmt->execute(array('username' => $name));

    //getting the row
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result))
    {
        //Checking if the code matches
        foreach($result as $row)
        {
            if ($row['con_code'] == $code)
            {
                try
                {
                //Updating user info from active = 0 to active = 1
                $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare('UPDATE users SET active = :active WHERE user_name = :username');
                $stmt->execute(array(':active' => '1', ':username' => $name));

                //Updating the con_code
                $new_code = hash('whirlpool', rand(0,100000));
                $stmt = $conn->prepare('UPDATE users SET con_code = :new_code WHERE user_name = :username');
                $stmt->execute(array(':new_code' => $new_code, ':username' => $name));
                echo ("<script>alert('Account is now active!')</script>");
                }
                catch(PDOException $e)
                {
                    header("Location: index.php?con=error");
                    exit();
                }
            }
            else
            {
                //if the code doesn't match
                header("Location: index.php?code=-1");
                exit();
            }
        }
    }
    else
    {
        //if user doesn't exist
        header("Location: index.php?code=-1");
        exit();
    }
}
catch(PDOException $e)
{
    //connection error
    header("Location: index.php?con=error");
    exit();
}
}
?>

<!DOCTYPE html>
<html>
<?php include_once 'head.php'; ?>
<body>
    <div class="pen-title">
        <h1>PixelX</h1>
    </div>

    <div class="module form-module">
        <div class="toggle">
        </div>
        <div class="form">
            <h2>You can now log in to your account :)</h2>
            <form action="" method="POST">
                <button formaction="login.php">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
