<?php


session_start(); 
require "./connection.php";

if(!isset($_SESSION['loggedIn']) || $_SESSION['email'] != 'admin@quiz.com'){
    header("Location: ../pages/index.php"); 
    exit();
}
$question_id=$_GET['question_id'];
$quiz_id=$_GET['quiz_id'];

if($quiz_id && $question_id){
    $sql ="DELETE FROM questions WHERE id =:question_id AND quiz_id=:quiz_id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':question_id', $question_id);
    $stmt->bindParam(':quiz_id', $quiz_id);
    
    if ($stmt->execute()){
        $_SESSION['success']="question deleted successfully.";
         header("Location: ../pages/editQuiz.php?id=$quiz_id"); 
    exit();
}  else{
         $_SESSION['error'] = "Failed to delete the quiz.";
         header("Location: ../pages/editQuiz.php?id=$quiz_id"); 

      exit();
       }
}

