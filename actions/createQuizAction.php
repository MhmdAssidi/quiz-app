<?php


require "../actions/connection.php";

session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ../pages/index.php"); 
    exit;
}
if($_SERVER['REQUEST_METHOD'] != 'POST'){ 
    die("you should submit the form of creation a quiz");
    exit;
}

$title=trim($_POST['title']);
$desc=trim($_POST['desc']);

if (empty($title)|| empty($desc)) {
    echo "Missing parameter";
    exit; 
}

else{
    try{
     
$sql="SELECT * FROM quizzes WHERE title=:title AND description=:description";
$stmt=$pdo->prepare($sql);
    $stmt->bindParam(":title",$title);
    $stmt->bindParam(":description",$desc);
    $stmt->execute();
    $quiz=$stmt->fetch();
    
    if($quiz){
    $_SESSION['error']='you already have this quiz';
    header("Location:../pages/createQuiz.php");

    exit;
    }
          
        $sql = "INSERT INTO quizzes (title, description) VALUES (:title, :description)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $desc);
   
        $stmt->execute();

        $quizId = $pdo->lastInsertId();
        if($quizId){
            $question1=trim($_POST['question1trim']);
            $option1Q1=trim($_POST['option1Q1']);
            $option2Q1=trim($_POST['option2Q1']);
            $option3Q1=trim($_POST['option3Q1']);
            $correct1=trim($_POST['correct1']);

            $question2=trim($_POST['question2']);
            $option1Q2=trim($_POST['option1Q2']);
            $option2Q2=trim($_POST['option2Q2']);
            $option3Q2=trim($_POST['option3Q2']);
            $correct2=trim($_POST['correct2']);

            $question3=trim($_POST['question3']);
            $option1Q3=trim($_POST['option1Q3']);
            $option2Q3=trim($_POST['option2Q3']);
            $option3Q3=trim($_POST['option3Q3']);
            $correct3=trim($_POST['correct3']);

           $sql2 = "INSERT INTO questions (quiz_id, question, option_a, option_b, option_c, correct_option) VALUES (:quiz_id, :question, :option_a, :option_b, :option_c, :correct_option)";
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->bindParam(':quiz_id', $quizId);  
  $stmt2->bindParam(':question', $question1);
  $stmt2->bindParam(':option_a', $option1Q1);
  $stmt2->bindParam(':option_b', $option2Q1);
  $stmt2->bindParam(':option_c', $option3Q1);
  $stmt2->bindParam(':correct_option', $correct1);
  $stmt2->execute();


  $stmt3 = $pdo->prepare($sql2); 
  $stmt3->bindParam(':quiz_id', $quizId);
  $stmt3->bindParam(':question', $question2);
  $stmt3->bindParam(':option_a', $option1Q2);
  $stmt3->bindParam(':option_b', $option2Q2);
  $stmt3->bindParam(':option_c', $option3Q2);
  $stmt3->bindParam(':correct_option', $correct2);
  $stmt3->execute();


  $stmt4 = $pdo->prepare($sql2); 
  $stmt4->bindParam(':quiz_id', $quizId);
  $stmt4->bindParam(':question', $question3);
  $stmt4->bindParam(':option_a', $option1Q3);
  $stmt4->bindParam(':option_b', $option2Q3);
  $stmt4->bindParam(':option_c', $option3Q3);
  $stmt4->bindParam(':correct_option', $correct3);
  $stmt4->execute();
  $_SESSION['success'] ='quiz create successfully';
  header("Location:../pages/createQuiz.php");
  exit(); 
        }
        
    } catch(PDOException $exc) {  
        echo "error adding user: " . $exc->getMessage();
    }
}

