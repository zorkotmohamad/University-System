<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $newsemester = htmlspecialchars(trim($_POST["new_semester"]));
    $old_semester = htmlspecialchars(trim($_POST["old_semester"]));
    if(empty($newsemester)){
        $_SESSION["semester"] = "Please enter the new semester name";
        header("Location:Semesters.php");
        exit();
    }
    try{
            $select = "SELECT semester_name FROM semesters WHERE semester_name = :newsemester";
            $stmt = $conn->prepare($select);
            $stmt->bindParam(":newsemester",$newsemester,PDO::PARAM_STR);
            $stmt->execute();
            $semester = $stmt->fetch(PDO::FETCH_ASSOC);
            if($semester){
                $_SESSION["semester_exists"] = "Semester Already exists";
                header("Location:Semesters.php");
                exit();
            }
            else{
                $update = "UPDATE semesters SET semester_name = :new_semester WHERE semester_name = :old_semester";
                $stmt = $conn->prepare($update);
                $stmt->bindParam(":new_semester",$newsemester );
                $stmt->bindParam(":old_semester",$old_semester );
                $stmt->execute();
                header("Location:Semesters.php");
                exit();
            }
    }
    catch(PDOException $exception){
        echo "Error during Update process ".$exception->getMessage();
    }
}