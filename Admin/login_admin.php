<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
}
//password is Harvardadministration123
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    if(empty($username)){
        $_SESSION["username"] = "username is required";
        header("Location:Login.php");
    }
    if(empty($username)){
        $_SESSION["password"] = "password is required";
        header("Location:Login.php");
        exit();
    }
    try{
        $select = "SELECT username,password 
        FROM admin 
        WHERE username = :username";
        $stmt = $conn->prepare($select);
        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if($admin){
            if(password_verify($password,$admin["password"])){
                $_SESSION["loggedin"] = true;
                header("Location:home.php");
                exit();
            }
            else{
                 $_SESSION["wrong_password"] = "Wrong Password";
                header("Location:Login.php");
                exit();
            }

        }
        else{
            $_SESSION["not_admin"] = "You are not the Admin";
            header("Location:Login.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "You are not the Admin ".$exception->getMessage();
    }
}