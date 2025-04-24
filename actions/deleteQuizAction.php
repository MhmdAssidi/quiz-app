<?php

session_start(); 
require "./connection.php";


if(!isset($_SESSION['loggedIn']) || $_SESSION['email'] != 'admin@quiz.com'){
    header("Location: ../pages/index.php"); 
    exit();
}
$quiz_id=$_GET['id'];

if($quiz_id){
    $sql ="DELETE FROM quizzes WHERE id =:quizId";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':quizId', $quiz_id);
    
    if ($stmt->execute()){
        $_SESSION['success']="Quiz deleted successfully.";
         header("Location: ../pages/home.php"); 
    exit();
}  else{
         $_SESSION['error'] = "Failed to delete the quiz.";
       header("Location: ../pages/home.php");
      exit();
       }
}
