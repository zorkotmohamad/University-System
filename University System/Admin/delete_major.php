<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    try{
        $major_name = htmlspecialchars(trim($_POST["major_name"]));
        $delete = "DELETE FROM majors WHERE major_name = :major";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(":major",$major_name);
        $stmt->execute();
        header("Location:Majors.php");
        exit();
    }
    catch(PDOException $exception){
        echo "Can not delete something wrong !!! ".$exception->getMessage();
    }
}