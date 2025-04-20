<?php

session_start(); 
require "./connection.php";

$email=trim($_POST['email']);
$password=trim($_POST['password']);

if (empty($email)||empty($password)) {
    echo "Missing parameter";
    exit; 
}

try {
   
    $sql = "SELECT id,name,email, password FROM users WHERE email = :email";
    $stmt =$pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['id']=$user['id'];
  
    if ($user) {
         if(password_verify($password,$user['password'])){
        $_SESSION["loggedIn"] = true;
        $_SESSION['userName'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];

       if($user['email']=="admin@quiz.com"){
        header("Location: ../pages/dashboard.php");
       }
       else{
        header("Location: ../pages/home.php");

       }
        }else{
            $_SESSION['error'] = 'Incorrect email or password';
            header("Location: ../pages/index.php");

         }
    } else {  
  
        $_SESSION['error'] = 'no user found';
        header("Location: ../pages/index.php");

        exit;
    }
} catch (PDOException $exc) { 
  
    echo "Error in login: " . $exc->getMessage();
}

?>
