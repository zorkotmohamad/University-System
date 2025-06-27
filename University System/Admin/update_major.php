<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $newmajor = htmlspecialchars(trim($_POST["newmajor"]));
    $oldmajor = htmlspecialchars(trim($_POST["oldmajor"]));
    if(empty($newmajor)){
        header("Location:Majors.php");
        exit();
    }
    try{
        $select = "SELECT major_name FROM majors WHERE major_name = :newmajor";
        $stmt = $conn->prepare($select);
        $stmt->bindParam(":newmajor",$newmajor,PDO::PARAM_STR);
        $stmt->execute();
        $major = $stmt->fetch(PDO::FETCH_ASSOC);
        if($major){
            $_SESSION["major_exist"] = "Major Already exists";
            header("Location:Majors.php");
            exit();
        }
        else{
            $update = "UPDATE majors SET major_name = :newmajor WHERE major_name = :oldmajor";
            $stmt = $conn->prepare($update);
            $stmt->bindParam(":newmajor",$newmajor, PDO::PARAM_STR);
            $stmt->bindParam(":oldmajor",$oldmajor,PDO::PARAM_STR);
            $stmt->execute();
            header("Location:Majors.php");
            exit();
        }

    }
    catch(PDOException $exception){
        echo "Error during Update process!!! ".$exception->getMessage();
    }
}