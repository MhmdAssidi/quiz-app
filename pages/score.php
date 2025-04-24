
<?php
require "../actions/connection.php";


session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ./index.php"); 
    exit();
}
if($_SERVER['REQUEST_METHOD']=="GET"){
    die("do a quiz first");
}
$userId=$_SESSION['user_id'];
$quizId=$_SESSION['quizId'];
$score=$_SESSION['score'];

$sql="INSERT INTO scores (user_id, quiz_id, score) VALUES (:user_id, :quiz_id, :score)";
    $stmt =$pdo->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':quiz_id', $quizId);
    $stmt->bindParam(':score', $score);
    $stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Score</title>
</head>
<body>
    <h1>your score on the quiz:<?php echo $score  ?></h1>

    <a href="../actions/logoutAction.php">logout</a>
</body>
</html>