<?php
require "../actions/connection.php";

session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ./index.php"); 
    exit();
}
$quizId = $_GET['id'];


$sql="SELECT * FROM questions WHERE quiz_id=:quiz_id";
    $stmt =$pdo->prepare($sql);
    $stmt->bindParam(':quiz_id',$quizId);
    $stmt->execute();
    $questions=$stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($questions);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../styles/quizStyle.css">
</head>
<body>
    <div class="container">
    <form action="../actions/scoreAction.php" method="POST">
   <?php foreach ($questions as $question): ?>
    <h3><?php echo $question['question'] ?></h3>
   
    <div class="optionContainer">
        <div class="options">
        <input type="hidden" name="question_ids[]" value="<?php echo $question['id']; ?>">

    <input type="radio" name="question_<?php echo $question['id'];?>" value="a" required> <label><?php echo $question['option_a'];  ?> </label>
        </div>
        <div class="options">
    
        <input type="radio" name="question_<?php echo $question['id'];  ?>" value="b" required> <label><?php echo $question['option_b'];  ?> </label>
        </div>
        <div class="options">

        <input type="radio" name="question_<?php echo $question['id'];  ?>" value="c" required> <label><?php echo $question['option_c'];  ?> </label>
        </div>   
</div>
   <?php endforeach; ?>
   <input type="hidden" name="quizId" value="<?php echo $quizId  ?>">

<button type="submit" class="submitBtn">Submit Quiz</button>
   </form>
    </div>
    
</body>
</html>