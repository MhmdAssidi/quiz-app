
<?php
require "../actions/connection.php";

session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ./index.php"); 
    exit();
}
$userId=$_SESSION['user_id'];
if($_SESSION['email']!="admin@quiz.com" || $_SESSION['password']!="admin123"){
die("you are not an admin");
exit;
}

$sql="SELECT u.name, q.title AS quiz_title, s.score
  FROM scores AS s INNER JOIN users AS u ON s.user_id=u.id INNER JOIN quizzes AS q ON s.quiz_id=q.id
  ORDER BY u.name";
$stmt =$pdo->prepare($sql);
    $stmt->execute();
    $allScores=$stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($allScores);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="../styles/dashboardStyle.css">
</head>
<body>
  <div class="title">
  <h1>All Results for all Users:</h1>
  <a href="../actions/logoutAction.php">logout</a>
  </div>
  <div class="container">
   <?php foreach ($allScores as $score): ?>
    <div class="eachUser">
        <p>Username: <?php echo $score['name']  ?></p>
        <p>Title of the quiz: <?php echo $score['quiz_title']  ?></p>
        <p id="score">Score: <?php echo $score['score']  ?></p>

    </div>
   <?php endforeach; ?>
  </div>
</body>
</html>