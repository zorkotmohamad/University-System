<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $coursename = htmlspecialchars(trim($_POST["course_name"]));
    $coursecode = htmlspecialchars(trim($_POST["course_code"]));
    $coursemajor = htmlspecialchars(trim($_POST["course_major"]));
    $coursecredits = htmlspecialchars(trim($_POST["course_credits"]));
    $semester_name = htmlspecialchars(trim($_POST["semester"]));
    if(empty($coursename)){
        $_SESSION["coursename"] = "Please enter the course name";
        header("Location:Courses.php");
        exit();
    }
    if(empty($coursecode)){
        $_SESSION["coursecode"] = "Please enter the course code";
        header("Location:Courses.php");
        exit();
    }
    if($coursecredits <= 0){
        $_SESSION["credits"] = "Invalid credit number";
        header("Location:Courses.php");
        exit();
    }
    try{
        //verify if the course name or course code exist
        $select_course = "SELECT course_code,course_name 
                            FROM courses 
                            WHERE course_code= :code OR course_name= :name";
        $stmt1 = $conn->prepare($select_course);
        $stmt1->bindParam(":code",$coursecode,PDO::PARAM_STR);
        $stmt1->bindParam(":name",$coursename,PDO::PARAM_STR);
        $stmt1->execute();
        $course = $stmt1->fetch(mode: PDO::FETCH_ASSOC);
            if($course){
                $_SESSION["course_exist"] = "Course code or Course name Already exist";
                header("Location:Courses.php");
                exit();
            }
                $insert = "INSERT INTO courses(course_code,course_name,course_credits,course_major,semester)
                VALUES(:code,:name,:credits,:major,:semester)";
                $stmt2 = $conn->prepare($insert);
                $stmt2->bindParam(":code",$coursecode,PDO::PARAM_STR);
                $stmt2->bindParam(":name",$coursename,PDO::PARAM_STR);
                $stmt2->bindParam(":credits",$coursecredits,PDO::PARAM_INT);
                $stmt2->bindParam(":major",$coursemajor,PDO::PARAM_STR);
                $stmt2->bindParam(":semester",$semester_name,PDO::PARAM_STR);
                $stmt2->execute();
                header("Location:Courses.php");
                exit();
    }
    catch(PDOException $exception){
        echo "Error during insert process !!! ".$exception->getMessage();
    }
}
try{
    $select = "SELECT course_code,course_name,course_credits,course_major,semester,date_created FROM courses";
    $stmt = $conn->query($select);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


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