<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $student_id = htmlspecialchars(trim($_POST["id"]));
    $student_name = htmlspecialchars(trim($_POST["name"]));
    $student_major = htmlspecialchars(trim($_POST["major"]));
    $student_email = htmlspecialchars(trim($_POST["email"]));
    $semester = htmlspecialchars(trim($_POST["semester"]));

    if(empty($student_id)){
        $_SESSION["id"] = "Please enter student ID";
        header("Location:students_enrolled.php");
    }
    if(empty($student_name)){
        $_SESSION["name"] = "Please enter student Name";
        header("Location:students_enrolled.php");
    }
    if(empty($student_major)){
        $_SESSION["major"] = "Please enter student Major";
        header("Location:students_enrolled.php");
    }
    if(empty($student_email)){
        $_SESSION["email"] = "Please enter student Email";
        header("Location:students_enrolled.php");
    }
    if(empty($semester)){
        $_SESSION["semester"] = "Please enter Semester";
        header("Location:students_enrolled.php");
    }
    try{
        //check if the student exists
        $select_student = "SELECT student_id 
        FROM students 
        WHERE student_id = :id AND name = :name AND major = :major AND email =:email";
        $stmt = $conn->prepare($select_student);
        $stmt->bindParam(":id",$student_id,PDO::PARAM_INT);
        $stmt->bindParam(":name",$student_name,PDO::PARAM_STR);
        $stmt->bindParam(":major",$student_major,PDO::PARAM_STR);
        $stmt->bindParam(":email",$student_email,PDO::PARAM_STR);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        //check if the semester exists
        $select_semester = "SELECT semester_name FROM semesters WHERE semester_name = :semester";
        $stmt_semester = $conn->prepare($select_semester);
        $stmt_semester->bindParam(":semester",$semester,PDO::PARAM_STR);
        $stmt_semester->execute();
        $semester_name = $stmt_semester->fetch(PDO::FETCH_ASSOC);

        //check if the student is already enrolled in the semester
        $select_enrollments = "SELECT student_id,student_name,student_major,student_email
                                FROM semester_enrollments 
                                WHERE student_id = :studentid AND 
                                student_name = :studentname AND
                                student_major  = :studentmajor AND
                                student_email = :studentemail AND
                                semester = :student_semester";
        $stmt_student = $conn->prepare($select_enrollments);
        $stmt_student->bindParam(":studentid",$student_id,PDO::PARAM_INT);
        $stmt_student->bindParam(":studentname",$student_name,PDO::PARAM_STR);
        $stmt_student->bindParam(":studentmajor",$student_major,PDO::PARAM_STR);
        $stmt_student->bindParam(":studentemail",$student_email,PDO::PARAM_STR);
        $stmt_student->bindParam(":student_semester",$semester,PDO::PARAM_STR);
        $stmt_student->execute();
        $student_already_enrolled = $stmt_student->fetch(PDO::FETCH_ASSOC);

        if(!$student){
            $_SESSION["student_not_found"] = "Student not found";
            header("Location:students_enrolled.php");
        }
        if(!$semester_name){
            $_SESSION["semester_not_found"] = "The semester doesn't exists in your semesters list";
            header("Location:students_enrolled.php");
        }
        if($student_already_enrolled){
            $_SESSION["student_already_enrolled"] = "Student already enrolled in this semester";
            header("Location:students_enrolled.php");
        }
        if($student && $semester_name && !$student_already_enrolled){
            $insert = "INSERT INTO semester_enrollments(student_id,student_name,student_major,student_email,semester)
                        VALUES (:id,:name,:major,:email,:semester)";
            $stmt = $conn->prepare($insert);
            $stmt->bindParam(":id",$student_id,PDO::PARAM_INT);
            $stmt->bindParam(":name",$student_name,PDO::PARAM_STR);
            $stmt->bindParam(":major",$student_major,PDO::PARAM_STR);
            $stmt->bindParam(":email",$student_email,PDO::PARAM_STR);
            $stmt->bindParam(":semester",$semester,PDO::PARAM_STR);
            $stmt->execute();
            header("Location:students_enrolled.php");
            exit();
        }

    }
    catch(PDOException $exception){
        echo "Error during enrollment process!!! ".$exception->getMessage();
    }
}

try{
    $select = "SELECT student_id,student_name,student_major,student_email,semester
                FROM semester_enrollments";
    $stmt = $conn->query($select);
    $students_enrolled = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql_semester = "SELECT semester_name FROM semesters";
    $stmtSemester = $conn->query($sql_semester);
    $semesters_name = $stmtSemester->fetchAll(PDO::FETCH_ASSOC);

    
    $sql_major ="SELECT major_name FROM majors";
    $stmtMajor = $conn->query($sql_major);
    $Majors = $stmtMajor->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $exception){
    echo "Error during fetch process!!! ".$exception->getMessage();
}