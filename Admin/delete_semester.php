<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    try{
        $semester_name = htmlspecialchars(trim($_POST["semester_name"]));
        $delete = "DELETE FROM semesters WHERE semester_name = :semester";
        $stmt=$conn->prepare($delete);
        $stmt->bindParam(":semester",$semester_name);
        $stmt->execute();
        header("Location:Semesters.php");
    }
    catch(PDOException $exception){
        echo "can not delete ".$exception->getMessage();
    }
}