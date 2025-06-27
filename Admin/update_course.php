<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] =="POST"){
    $new_name = htmlspecialchars(trim($_POST["new_course"]));
    $new_code = htmlspecialchars(trim($_POST["new_coursecode"]));
    $old_name = htmlspecialchars(trim($_POST["old_course"]));
    $old_code = htmlspecialchars(trim($_POST["old_coursecode"]));
    $new_major = htmlspecialchars(trim($_POST["new_coursemajor"]));
    $old_major = htmlspecialchars(trim($_POST["old_coursemajor"]));
    $new_credits = htmlspecialchars(trim($_POST["new_coursecredits"]));
    $old_credits = htmlspecialchars(trim($_POST["old_coursecredits"]));
    $new_semester = htmlspecialchars(trim($_POST["new_semester"]));
    if(empty($new_name) || empty($new_code) || empty($new_credits) || empty($new_semester) || empty($new_major)){
        header("Location:Courses.php");
        exit();
    }
    try{
        $select_major = "SELECT major_name FROM majors WHERE major_name = :major";
        $stmt = $conn->prepare($select_major);
        $stmt->bindParam(":major",$new_major,PDO::PARAM_STR);
        $stmt->execute();
        $major = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $select_course = "SELECT course_code,course_name 
                            FROM courses 
                           WHERE (course_code= :newcode OR course_name= :newname)
                            AND NOT (course_code= :oldcode AND course_name=:oldname AND course_major = :oldmajor)";
        $stmt1 = $conn->prepare($select_course);
        $stmt1->bindParam(":newcode",$new_code,PDO::PARAM_STR);
        $stmt1->bindParam(":newname",$new_name,PDO::PARAM_STR);
        $stmt1->bindParam(":oldname",$old_name,PDO::PARAM_STR);
        $stmt1->bindParam(":oldcode",$old_code,PDO::PARAM_STR);
        $stmt1->bindParam(":oldmajor",$old_major,PDO::PARAM_STR);
        $stmt1->execute();
        $course = $stmt1->fetch(mode: PDO::FETCH_ASSOC);

        $select_semester = "SELECT semester_name 
        FROM semesters
        WHERE semester_name = :newsemester";
        $stmt_semester = $conn->prepare($select_semester);
        $stmt_semester->bindParam(":newsemester",$new_semester,PDO::PARAM_STR);
        $stmt_semester->execute();
        $semester = $stmt_semester->fetch(PDO::FETCH_ASSOC);
        if(!$semester){
            $_SESSION["semester_not_exist"] = "Semester doesn't exist in your semesters list";
            header("Location:Courses.php");
            exit();
        }
        if($major){
            if($course){
                $_SESSION["editcourse_exist"] = "Course code or Course name Already exist";
                header("Location:Courses.php");
                exit();
            }
            else{
                $update = "UPDATE courses 
                SET course_code = :new_code,course_name = :new_name,course_credits = :credits,course_major = :major,semester = :semester
                WHERE course_code = :oldcode AND course_name = :oldname";
                $stmt = $conn->prepare($update);
                $stmt->bindParam(":new_code",$new_code,PDO::PARAM_STR);
                $stmt->bindParam(":new_name",$new_name,PDO::PARAM_STR);
                $stmt->bindParam(":credits",$new_credits,PDO::PARAM_INT);
                $stmt->bindParam(":major",$new_major,PDO::PARAM_STR);
                $stmt->bindParam(":oldcode",$old_code,PDO::PARAM_STR);
                $stmt->bindParam(":oldname",$old_name,PDO::PARAM_STR);
                $stmt->bindParam(":semester",$new_semester,PDO::PARAM_STR);
                $stmt->execute();
                header("Location:Courses.php");
                exit();
            }

        }
        else{
            $_SESSION["editmajor_not_found"] = "the major doesn't exist in your majors list";
            header("Location:Courses.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "Can not update! ".$exception->getMessage();
    }
}