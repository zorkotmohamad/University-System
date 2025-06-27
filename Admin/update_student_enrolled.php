<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $student_id = htmlspecialchars(trim($_POST["student_id"]));
    $new_name = htmlspecialchars(trim($_POST["newname"]));
    $old_name = htmlspecialchars(trim($_POST["oldname"]));
    $new_major = htmlspecialchars(trim($_POST["newmajor"]));
    if(empty($new_name)){
        $_SESSION["name"] = "Please enter student name";
        header("Location:students_enrolled.php");
        exit();
    }
    try{
        $select_student = "SELECT student_id,name 
        FROM students 
        WHERE student_id = :id AND name = :name";
        $stmt = $conn->prepare($select_student);
        $stmt->bindParam(":id",$student_id,PDO::PARAM_INT);
        $stmt->bindParam(":name",$new_name,PDO::PARAM_STR);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);





        $select_major = "SELECT major_name FROM majors WHERE major_name = :newmajor";
        $stmt_major = $conn->prepare($select_major);
        $stmt_major->bindParam(":newmajor",$new_major,PDO::PARAM_STR);
        $stmt_major->execute();
        $major = $stmt_major->fetch(PDO::FETCH_ASSOC);

        if(!$major){
            $_SESSION["major_not_found"] = "The major doesn't exist in your majors list";
            header("Location:students_enrolled.php");
            exit();
        }

        if($student){
            $update = "UPDATE semester_enrollments 
            SET student_name = :newname,student_major = :major
            WHERE student_id = :id";
            $stmt = $conn->prepare($update);
            $stmt->bindParam(":newname",$new_name,PDO::PARAM_STR);
            $stmt->bindParam(":major",$new_major,PDO::PARAM_STR);
            $stmt->bindParam(":id",$student_id,PDO::PARAM_INT);
            $stmt->execute();
            header("Location:students_enrolled.php");
            exit();
        }
        else{
            $_SESSION["invalid_name"] = "student name doesn't match with the ID";
            header("Location:students_enrolled.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "Error during Update process!!! ".$exception->getMessage();
    }
}