<?php

session_start();
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]==true){ 
die("you are already logged in");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Quiz App</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="../styles/indexStyle.css">
  <link
  href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>

<body>
  <div class="container" id="login-form">
    <div class="formTitle"> 
      <h2>Login</h2>
    </div>
      <div class="formContainer">
        <form action="../actions/loginAction.php" method="POST">
          <input type="email" placeholder="Enter your email" name="email" required>
           <input type="password" placeholder="Enter your password" name="password" required>
          <button>Login</button>
          <button id="signup">Signup</button>
        </form>
        
      </div>
 
  </div>

  <div class="container" style="display: none;" id="register-form">
    <div class="formTitle"> 
      <h2>Signup</h2>
    </div>
      <div class="formContainer">
        <form action="../actions/signupAction.php" method="POST">
          <input type="text" placeholder="Enter your fullname" name="name" required>
           <input type="email" placeholder="Enter your email" name="email" required>
          <input type="password" placeholder="Enter your password" name="password" required>
           <button>Signup</button>
           <button id="login">Login</button>
        </form>
        
      </div>
 
  </div>
  <?php 
if (isset($_SESSION['error'])){
    echo '<p style="color:red; font-size:30px; text-align: center;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']); 
}
if (isset($_SESSION['success'])){
  echo '<p style="color:green; font-size:30px; text-align: center;">' . $_SESSION['success'] . '</p>';
  unset($_SESSION['success']); 
}
?>
  <script src="../auth/scriptIndex.js"></script>
</body>
</html>
