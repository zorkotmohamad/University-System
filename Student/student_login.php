<?php
require "../Database/connection.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = htmlspecialchars(trim($_POST["student_id"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    if(empty($id)){
        $_SESSION["error_id"] = "ID is required";
        header("Location:Login.php");
    }
    if(empty($password)){
        $_SESSION["error_password"] = "Password is required";
        header("Location:Login.php");
    }
    try{
        $select = "SELECT student_profile,student_id,password,name,major,email FROM students WHERE student_id = :id";
        $stmt = $conn->prepare($select);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        //check if the student is enrolled in any semester
        $select_semester = "SELECT semester 
        FROM semester_enrollments
        WHERE student_id = :studentid";
        $stmt1 = $conn->prepare($select_semester);
        $stmt1->bindParam(":studentid",$id,PDO::PARAM_INT);
        $stmt1->execute();
        $semester = $stmt1->fetch(PDO::FETCH_ASSOC);
        if($student){
            if(password_verify($password,$student["password"]) == true){
                $_SESSION["loggedin"] = true;
                $_SESSION["student_profile"] = $student["student_profile"];
                $_SESSION["student_id"] = $student["student_id"];
                $_SESSION["student_name"] = $student["name"];
                $_SESSION["student_major"] = $student["major"];
                $_SESSION["student_email"] = $student["email"];
                $_SESSION["enrolled_semester"] = "";
                if($semester){
                    $_SESSION["enrolled_semester"] = $semester["semester"];
                }
                else{
                    $_SESSION["enrolled_semester"] = "Not enrolled";
                }
                header("Location:Home.php");
                exit();
            }
            else{
                $_SESSION["wrong_pass"] = "Wrong Password";
                header("Location:Login.php");
                exit();
            }
        }
        else{
            $_SESSION["student_not_found"] = "You don't have an Account? contact your Administration";
            header("Location:Login.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "Error during Search process!!! ".$exception->getMessage();
    }

}