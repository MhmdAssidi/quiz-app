<?php

require("./connection.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    $name =trim($_POST['name']);
    $email =trim($_POST['email']);
    $password =htmlspecialchars(trim($_POST['password']));

    if($name=="" || $password=="" || $email==""){
        $_SESSION['error']='missing parameters';
        header("Location:../pages/index.php");
        exit;
    }
    else{
        try{
         
    $sql="SELECT * FROM users WHERE name=:name AND email=:email";
    $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $user=$stmt->fetch();
        
        if($user){
            $_SESSION['error']='you already have an account, Login';

            header("Location:../pages/index.php");
        exit;
        }
            $hashed_password=password_hash($password,PASSWORD_BCRYPT);
            if ($hashed_password === false){
                $_SESSION['error']='failed hashing';
            header("Location:../pages/index.php");
                exit();
            }
            
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            $stmt->execute();
            $_SESSION['success'] ='you register correctly, login now';
         

            header("Location:../pages/index.php");
            exit(); 
        } catch(PDOException $exc) {  
            echo "error adding user: " . $exc->getMessage();
        }
    }
}
