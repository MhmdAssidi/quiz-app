<?php
require "../actions/connection.php";

session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ./index.php"); 
    exit();
}
$userName=$_SESSION['userName'];

$sql="SELECT * FROM quizzes";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../styles/homeStyle.css">
</head>
<body>
    <h1>Welcome <?php echo $userName ?></h1>
<div class="container">
    
    <?php
    foreach($quizzes as $quiz):
    ?>
        <div class="card">
         <h3><?php echo $quiz['title'];?></h3>
         <p><?php echo $quiz['description'];?></p>   
         <a href="./quiz.php?id=<?php echo $quiz['id'];?>"><button>take quiz</button></a>
        </div>
   <?php endforeach; ?>
   </div>

   
</body>
</html>
