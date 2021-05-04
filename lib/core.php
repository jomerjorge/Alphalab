<?php 

function getConnection() {
    $host = "127.0.0.1";
    $user = "root";
    $password = "javascript69";
    $database = "alphadb";
    $connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // epal
    return $connection;
}

?> 