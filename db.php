<?php

$server = "localhost";
$dbName = "test";
$user = "root";
$pass = "";

try{
    $conn = new PDO("mysql:host=$server;dbname=$dbName", $user, $pass);
}catch(Exception $ex){
    echo $ex->getMessage();
}

?>