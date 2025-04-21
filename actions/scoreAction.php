<?php
require "./connection.php";
session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ./index.php"); 
    exit();
}

$userId=$_SESSION['user_id'];
$quizId=$_POST['quizId'];

$checkUserSql="SELECT user_id FROM scores WHERE user_id=:user_id AND quiz_id=:quiz_id";

$stmt =$pdo->prepare($checkUserSql);
    $stmt->bindParam(':user_id',$userId);
    $stmt->bindParam(':quiz_id',$quizId);
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        die("you already did this quiz");
        exit;
    }

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
$_SESSION['quizId']=$quizId;
$_SESSION['score']=$score;

$score=0;
unset($questionIds);
header("Location: ../pages/score.php");

exit;