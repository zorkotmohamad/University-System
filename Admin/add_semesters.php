<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $new_semester = htmlspecialchars(trim($_POST["semester_name"]));
    if(empty($new_semester)){
        $_SESSION["semester"] = "Please enter the Semester name";
        header("Location:Semesters.php");
        exit();
    }
    try{
        $select = "SELECT semester_name FROM semesters WHERE semester_name = :newsemester";
        $stmt = $conn->prepare($select);
        $stmt->bindParam(":newsemester",$new_semester,PDO::PARAM_STR);
        $stmt->execute();
        $semester = $stmt->fetch(PDO::FETCH_ASSOC);
        if($semester){
            $_SESSION["semester_found"] = "Semester Already exists";
            header("Location:Semesters.php");
            exit();
        }
        else{
            $insert = "INSERT INTO semesters (semester_name) VALUES (:newsemester)";
            $stmt = $conn->prepare($insert);
            $stmt->bindParam(":newsemester",$new_semester,PDO::PARAM_STR);
            $stmt->execute();
            header("Location:Semesters.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "Error during insert process ".$exception->getMessage();
    }
}
try{
    $select = "SELECT semester_name,date_created FROM semesters";
    $stmt = $conn->query($select);
    $semesters = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $exception){
    echo $exception->getMessage();
}