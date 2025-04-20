<?php

$server = "localhost";  
$username = "root";     
$password = "";
$db = "quizApp";    

try {
    
    $pdo = new PDO("mysql:host=$server;port=3307;dbname=$db", $username, $password);  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
   
} catch (PDOException $exception) {    
    echo "Connection to database failed the error is: " . $exception->getMessage();
     exit();  
}