<?php

    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_pass = 'joseph07';
    $db_name = 'gallery';

    try {
        $db_conn = new PDO("mysql:host=($db_host);dbname=($db_name)",$db_user,$db_pass);
        $db_conn->setAttribte(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>>