<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
$studentid = htmlspecialchars(trim($_POST["hidden_id"]));
$semester = htmlspecialchars(trim($_POST["hidden_semester"]));
if($_SERVER['REQUEST_METHOD'] == "POST"){
    try{
        $delete = "DELETE FROM semester_enrollments WHERE student_id = :id AND semester = :semester";
        $stmt = $conn->prepare($delete);
        $stmt->bindParam(":id",$studentid,PDO::PARAM_INT);
        $stmt->bindParam(":semester",$semester,PDO::PARAM_STR);
        $stmt->execute();
        header("Location:students_enrolled.php");
        exit();
    }
    catch(PDOException $exception){
        echo "Error during Delete process!!! ".$exception->getMessage();
    }
}