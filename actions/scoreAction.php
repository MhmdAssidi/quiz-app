<?php
require "./connection.php";
session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ./index.php"); 
    exit();
}
$quizId=$_POST['quizId'];
$questionIds =$_POST['question_ids'];
$score=0;

for($i=0;$i<count($questionIds); $i++){

$sql2 ="SELECT correct_option FROM questions WHERE id=:questionId AND quiz_id = :quiz_id";
$stmt =$pdo->prepare($sql2);
$stmt->bindParam(':questionId',$questionIds[$i]);
    $stmt->bindParam(':quiz_id',$quizId);
    $stmt->execute();
    $correctOption=$stmt->fetch(PDO::FETCH_ASSOC);
    $userAnswer = $_POST["question_".$questionIds[$i]];
    if($userAnswer==$correctOption['correct_option']){
     $score+=1;
    }
  
}

$_SESSION['score']=$score;

$score=0;
unset($questionIds);
header("Location: ../pages/score.php");

exit;