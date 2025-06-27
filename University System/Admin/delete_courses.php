<?php
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
require "../Database/connection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $course_name = $_POST["course_name"];
    try{
        $delete = "DELETE FROM courses WHERE course_name = :course";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(":course",$course_name);
        $stmt->execute();
        header("Location:Courses.php");
        exit();
    }
    catch(PDOException $exception){
        echo "Can not delete,something wrong!!! ".$exception->getMessage();
    }
}