<?php
    if (!$_POST["login"] === "" || $_POST["passwd"] === "" || $_POST["submit"] !== "OK")
    {
        echo "Please fill in all fields\n";
        return ;
    }

    if (!file_exists("../private") || !file_exists("../private/passwd"))
       mkdir ("../private");

    if (file_exists("../private/passwd"))
    {
        $arr_lp = unserialize(file_get_contents("../private/passwd"));
        foreach ($arr_lp as $user)
        {
            if ($user["login"] === $_POST["login"])
            {
                echo "That username has already been taken\n";
                return ;
            }
        }
    }

    $tab["login"] = $_POST["login"];
    $tab["passwd"] = hash('whirlpool', $_POST["passwd"]);
    $arr_lp[] = $tab;
    file_put_contents("../private/passwd", serialize($arr_lp));
    header("Location: ../index.php");
