<?php
require "../actions/connection.php";

session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ./index.php"); 
    exit();
}
$userName=$_SESSION['userName'];

$userEmail=$_SESSION['email'];
$userPass=$_SESSION['password'];
            
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/homeStyle.css">

</head>
<body>
    <h1>Welcome <?php echo $userName ?></h1>
<div class="container">
    
    <?php
    foreach($quizzes as $quiz):
    ?>
        <div class="card" style="position: relative;">
         <h3><?php echo $quiz['title'];?></h3>
         <p><?php echo $quiz['description'];?></p>   
         
         <?php
         if($userEmail=="admin@quiz.com"):?>
         <i class="fa fa-trash-o" onclick="confirmDelete(<?php echo $quiz['id']; ?>)" style="
         font-size: 23px; 
    color: red;
    position: absolute;
    left: 83%;
    top: 8%;
    cursor:pointer;">
         
         </i>
         <a href="./quiz.php?id=<?php echo $quiz['id'];?>"><button>see questions</button></a>
         <a href="./editQuiz.php?id=<?php echo $quiz['id'];?>"><button>edit quiz</button></a>
         <?php else: ?>
         <a href="./quiz.php?id=<?php echo $quiz['id'];?>"><button>solve quiz</button></a>
         <?php endif; ?>
        </div>
   <?php endforeach; ?>
   </div>
   <?php 
if (isset($_SESSION['error'])){
    echo '<div> <p style="color:red; font-size:30px;">' . $_SESSION['error'] . '</p></div>';
    unset($_SESSION['error']); 
}
if (isset($_SESSION['success'])){
  echo '<div> <p style="color:green; font-size:30px;">' . $_SESSION['success'] . '</p> </div>';
  unset($_SESSION['success']); 
}
?>
   <script>
    function confirmDelete(quizId){
        var confirmed=confirm("Are you sure you want to delete this quiz?");
    
    if (confirmed){
        window.location.href = "../actions/deleteQuizAction.php?id="+quizId;
    }
    }
   </script>
</body>
</html>
