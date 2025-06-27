<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $studentid = htmlspecialchars(trim($_POST["id_student"]));
    $old_name = htmlspecialchars(trim($_POST["old_name"]));
    $new_name = htmlspecialchars(trim($_POST["new_name"]));
    $new_major = htmlspecialchars(trim($_POST["new_major"]));
    $old_major = htmlspecialchars(trim($_POST["old_major"]));
    $old_email = htmlspecialchars(trim($_POST["old_email"]));
    $new_email = htmlspecialchars(trim($_POST["new_email"]));
    if(empty($new_name) || empty($new_major) || empty($new_email)){
        $_SESSION["empty_fields"] = "All fields must be filled";
        header("Location:Manage_Students.php");
        exit();
    }
    try{
        //check if the new email exist in the others records not our actual record
        $select_student = "SELECT email FROM students WHERE email = :newemail AND NOT student_id = :id";
        $stmt_student = $conn->prepare($select_student);
        $stmt_student->bindParam(":newemail",$new_email,PDO::PARAM_STR);
        $stmt_student->bindParam(":id",$studentid,PDO::PARAM_INT);
        $stmt_student->execute();
        $student = $stmt_student->fetch(PDO::FETCH_ASSOC);


        $select_major = "SELECT major_name FROM majors WHERE major_name = :newmajor";
        $stmt_major = $conn->prepare($select_major);
        $stmt_major->bindParam(":newmajor",$new_major,PDO::PARAM_STR);
        $stmt_major->execute();
        $major = $stmt_major->fetch(PDO::FETCH_ASSOC);
        if($major){
            if($student){
                $_SESSION["student_exist"]= "Student Email already exists";
                header("Location:Manage_Students.php");
                exit();
            }
            else{
                $update_student = "UPDATE students 
                SET name = :newname,major = :newmajor,email = :newemail
                WHERE student_id = :id";
                $stmt = $conn->prepare($update_student);
                $stmt->bindParam(":newname",$new_name,PDO::PARAM_STR);
                $stmt->bindParam(":newmajor",$new_major,PDO::PARAM_STR);
                $stmt->bindParam(":newemail",$new_email,PDO::PARAM_STR);
                $stmt->bindParam(":id",$studentid,PDO::PARAM_INT);
                $stmt->execute();
                header("Location:Manage_Students.php");
                exit();
            }
        }
        else{
            $_SESSION["major_not_exist"] = "This major doesn't exist in your majors list";
            header("Location:Manage_Students.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "Error during update process!!! ".$exception->getMessage();
    }
}