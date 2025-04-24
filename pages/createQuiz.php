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
<label for="">Enter a title for the quiz: </label><input type="text" placeholder="title" name="title">
<label for="">Enter the description for the quiz: </label><input type="text" placeholder="title" name="desc">
</div>

<div>
    <label>Enter the first question for the quiz: </label><input type="text" placeholder="title" name="question1" required>
    <label>Enter the first option for the first question: </label><input type="text" placeholder="option" name="option1Q1" required>
    <label>Enter the second option for the first question: </label><input type="text" placeholder="option" name="option2Q1" required>
    <label>Enter the third option for the first question:</label><input type="text" placeholder="Enter option C" name="option3Q1" required>
    <label>Enter the correct option for the first question as a or b or c: </label><input type="text" placeholder="correct option" name="correct1" required>
</div>


<div>
<label>Enter the second question for the quiz: </label><input type="text" placeholder="title" name="question2" required>
<label>Enter the first option for the second question: </label><input type="text" placeholder="option" name="option1Q2" required>
<label>Enter the second option for the second question: </label><input type="text" placeholder="option" name="option2Q2" required>
<label>Enter the third option for the second question: </label><input type="text" placeholder="option" name="option3Q2" required>
<label>Enter the correct option for the second question as a or b or c: </label><input type="text" placeholder="correct option" name="correct2" required>
</div>

<div>
<label>Enter the third question for the quiz: </label><input type="text" placeholder="title" name="question3" required>
<label>Enter the first option for the third question: </label><input type="text" placeholder="option" name="option1Q3" required>
<label>Enter the second option for the third question: </label><input type="text" placeholder="option" name="option2Q3" required>
<label>Enter the third option for the third question: </label><input type="text" placeholder="option" name="option3Q3" required>
<label>Enter the correct option for the third question as a or b or c: </label><input type="text" placeholder="correct option" name="correct3" required>
</div>

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