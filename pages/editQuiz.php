<?php

require("../actions/connection.php");
session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ../pages/index.php"); 
    exit;
}
if($_SERVER['REQUEST_METHOD'] != 'GET'){ 
    die("you should submit the form of edit a quiz");
    exit;
}
$quizId=$_GET['id'];

$sql = "SELECT q1.id AS question_id, q1.quiz_id, q1.question, q1.option_a, q1.option_b, q1.option_c, q1.correct_option, 
               q2.title, q2.description 
        FROM questions q1 
        INNER JOIN quizzes q2 ON q1.quiz_id = q2.id 
        WHERE q1.quiz_id = :quiz_id";
        $stmt=$pdo->prepare($sql);
$stmt->bindParam(":quiz_id",$quizId);
$stmt->execute();
$quizAnditsQuestions=$stmt->fetchAll(PDO::FETCH_ASSOC);
$firstRow = $quizAnditsQuestions[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                
    <link rel="stylesheet" href="../styles/createQuizStyle.css">
</head>
<body>

<form action="../actions/editQuizAction.php" method="POST">
    <input type="hidden" name="quizId" value="<?php echo $quizId  ?>">
<div>

<label for="">Enter a title for the quiz: </label><input type="text" placeholder="title" name="title" value="<?php echo $firstRow['title'] ?>">

<label for="">Enter the description for the quiz: </label><input type="text" placeholder="title" name="desc" value="<?php echo $firstRow['description'] ?>">
</div>
<?php 

$current=1;
foreach ($quizAnditsQuestions as $row):  ?>

<div style="position: relative;">
<input type="hidden" name="questionId<?php echo $current ?>" value="<?php echo $row['question_id'] ?>">

    <label>Enter the question <?php echo $current ?> for the quiz: </label><input type="text" placeholder="title" name="question<?php echo $current  ?>" value="<?php echo $row['question']  ?>" required>
    <label>Enter the option 1 for the question: </label><input type="text" placeholder="option" name="option1Q<?php echo $current  ?>" value="<?php echo $row['option_a']  ?>" required>
    <label>Enter the option 2 for the question: </label><input type="text" placeholder="option" name="option2Q<?php echo $current  ?>" value="<?php echo $row['option_b']  ?>" required>
    <label>Enter the option 3 for the question:</label><input type="text" placeholder="Enter option C" name="option3Q<?php echo $current  ?>" value="<?php echo $row['option_c']  ?>" required>
    <label>Enter the correct option for the question <?php echo $current ?> as a or b or c: </label><input type="text" placeholder="correct option" name="correct<?php echo $current  ?>" value="<?php echo $row['correct_option']  ?>" required>
    <i class="fa fa-trash-o" onclick="confirmDelete(<?php echo $row['question_id']; ?>, <?php echo $quizId; ?>)" style="
         font-size: 23px; 
    color: red;
    position: absolute;
    right:5%;
    cursor:pointer;"></i>
</div>
 <?php
        $current++;
    endforeach;
    ?>

<div>
<button type="submit">EDIT</button>
</div>

</form>

<script>
    function confirmDelete(questionId,quizId){
        var confirmed=confirm("Are you sure you want to delete this question?");
    
    if (confirmed){
        window.location.href = "../actions/deleteQuestionAction.php?question_id=" + questionId + "&quiz_id=" + quizId;
    }
    }
    </script>
</body>
</html>