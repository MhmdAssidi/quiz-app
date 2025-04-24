<?php
require "./connection.php";

session_start();
$quizId =$_POST['quizId'];


if($quizId){
    $title = $_POST['title'];
    $description = $_POST['desc'];

    $question1=trim($_POST['question1']);
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
   
    $questionId1=$_POST['questionId1'];
    $questionId2=$_POST['questionId2'];
    $questionId3=$_POST['questionId3'];

$sqlQuiz="UPDATE questions SET title=:title and description=:description";
$sqlQuiz = $pdo->prepare($sql);
$stmt1->bindParam(":title", $title);
$stmt1->bindParam(":description", $description);

$sql = "UPDATE questions SET 
                    question = :question,
                     option_a = :option_a,
                      option_b = :option_b,
                     option_c = :option_c,
                       correct_option = :correct_option 
                WHERE id = :questionId AND quiz_id = :quizId";

                $stmt1 = $pdo->prepare($sql);
                $stmt1->bindParam(":question", $question1);
                $stmt1->bindParam(":option_a", $option1Q1);
                $stmt1->bindParam(":option_b", $option2Q1);
                $stmt1->bindParam(":option_c", $option3Q1);
                $stmt1->bindParam(":correct_option", $correct1);
                $stmt1->bindParam(":questionId", $questionId1);
                $stmt1->bindParam(":quizId", $quizId);
                $stmt1->execute();

                //////

                $stmt2 = $pdo->prepare($sql);
                $stmt2->bindParam(":question", $question2);
                $stmt2->bindParam(":option_a", $option1Q2);
                $stmt2->bindParam(":option_b", $option2Q2);
                $stmt2->bindParam(":option_c", $option3Q2);

                $stmt2->bindParam(":correct_option", $correct2);
                $stmt2->bindParam(":questionId", $questionId2);
                $stmt2->bindParam(":quizId", $quizId);
                $stmt2->execute();


                ///
                $stmt3 = $pdo->prepare($sql);
                $stmt3->bindParam(":question", $question3);
                $stmt3->bindParam(":option_a", $option1Q3);
                $stmt3->bindParam(":option_b", $option2Q3);
                $stmt3->bindParam(":option_c", $option3Q3);
                $stmt3->bindParam(":correct_option", $correct3);
                $stmt3->bindParam(":questionId", $questionId3);
                $stmt3->bindParam(":quizId", $quizId);
                $stmt3->execute();

                $_SESSION['success'] ='quiz updated successfully';
                header("Location:../pages/home.php");
}


