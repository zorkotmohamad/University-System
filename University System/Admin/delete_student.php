<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $student_id = htmlspecialchars(trim($_POST["student_id"]));
    try{
        $delete = "DELETE FROM students WHERE student_id = :id";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(":id",$student_id);
        $stmt->execute();
        header("Location:Manage_Students.php");
    }
    catch(PDOException $exception){
        echo "Can not delete,something wrong !!! ".$exception->getMessage();
    }
}