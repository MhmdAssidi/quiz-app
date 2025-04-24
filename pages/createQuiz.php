<?php
session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: ../pages/index.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <link rel="stylesheet" href="../styles/createQuizStyle.css">
</head>
<body>
    
<form action="../actions/createQuizAction.php" method="POST">

<div>
    <label>Enter a title for the quiz: </label> <input type="text" placeholder="title" name="title">
    <label>Enter the description for the quiz: </label> <input type="text" placeholder="title" name="desc">
</div>

<?php 
$temp =1;  
for ($i = 1; $i <= 3;$i++): ?>
    <div>
           <label>Enter the question <?php echo $temp; ?> for the quiz: </label>
         <input type="text" placeholder="title" name="question<?php echo $temp;   ?>" required>
        
         <label>Enter the first option for the question <?php echo $temp; ?>: </label>
          <input type="text" placeholder="option" name="option1Q<?php echo $temp;   ?>" required>
        
        <label>Enter the second option for the question <?php echo $temp; ?>: </label>
           <input type="text" placeholder="option" name="option2Q<?php echo $temp; ?>" required>
        
           <label>Enter the third option for the question <?php echo $temp; ?>: </label>
         <input type="text" placeholder="option" name="option3Q<?php echo $temp;   ?>" required>
        
         <label>Enter the correct option for the question <?php echo $temp; ?> as a or b or c: </label>
          <input type="text" placeholder="correct option" name="correct<?php echo $temp;   ?>" required>
    </div>
<?php 
    $temp++;  
endfor;
?>

<div>
    <button type="submit">Create</button>
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
</form>
</body>
</html>