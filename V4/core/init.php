<?php
    session_start();

$globals['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'joseph07',
        'db' => 'camagru'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user'
        )
    );

spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.class.php';   
});

require_once 'functions/sanitize.php';