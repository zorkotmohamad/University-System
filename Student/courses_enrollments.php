<?php
require "../Database/connection.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $course_code = htmlspecialchars(trim($_POST["course_code"]));
    if(empty($course_code)){
        $_SESSION["empty_course"] = "Please enter course code";
        header("Location:Enroll.php");
        exit();
    }
    try{
        // check if the course entered by the student refer to the ideal major and if it exists and if it is available in his actual semester
        $select = "SELECT course_code,course_name,course_credits
            FROM courses 
            WHERE course_major = :major AND course_code = :code AND semester = :semester";
        $stmt = $conn->prepare($select);
        $stmt->bindParam(":major",$_SESSION["student_major"],PDO::PARAM_STR);
        $stmt->bindParam(":code",$course_code,PDO::PARAM_STR);
        $stmt->bindParam(":semester",$_SESSION["enrolled_semester"],PDO::PARAM_STR);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);

        //get total number of credits for the student
        $select_credits = "SELECT SUM(credits) 
        FROM courses_enrollments 
        WHERE student_id = :student_id";
        $stmt_credits = $conn->prepare($select_credits);
        $stmt_credits->bindParam(":student_id",$_SESSION["student_id"],PDO::PARAM_INT);
        $stmt_credits->execute();
        $student_credits = $stmt_credits->fetchColumn();
        //total credits of the student + new course credits
        $total_credits = $student_credits + $course["course_credits"];
        //enroll one time on each course in the actual student semester
        $select_enrollment = "SELECT student_id
        FROM courses_enrollments
        WHERE student_id = :id_student AND course_code = :course_code AND semester = :student_semester";
        $stmt1 = $conn->prepare($select_enrollment);
        $stmt1->bindParam(":id_student",$_SESSION["student_id"],PDO::PARAM_INT);
        $stmt1->bindParam(":course_code",$course_code,PDO::PARAM_STR);
        $stmt1->bindParam(":student_semester",$_SESSION["enrolled_semester"],PDO::PARAM_STR);
        $stmt1->execute();
        $search_student = $stmt1->fetch(PDO::FETCH_ASSOC);
        //if already enrolled in the course
        if($search_student){
            $_SESSION["already_enrolled"] = "You are already enrolled in this course";
            header("Location:Enroll.php");
            exit();
        }
        if($total_credits > 30){
            $_SESSION["limit_reached"] = "You have reached the maximum number of allowed credits, or the new enrollment would exceed the permitted limit.";
            header("Location:Enroll.php");
            exit();
        }
        if($course && !$search_student && $total_credits <= 30){
            $insert = "INSERT INTO courses_enrollments(student_name,student_id,course_code,course_name,semester,credits)
                        VALUES (:name,:id,:code,:course_name,:semester,:credits)";
            $stmt = $conn->prepare($insert);
            $stmt->bindParam(":name",$_SESSION["student_name"],PDO::PARAM_STR);
            $stmt->bindParam(":id",$_SESSION["student_id"],PDO::PARAM_INT);
            $stmt->bindParam(":code",$course_code,PDO::PARAM_STR);
            $stmt->bindParam(":course_name",$course["course_name"],PDO::PARAM_STR);
            $stmt->bindParam(":semester",$_SESSION["enrolled_semester"],PDO::PARAM_STR);
            $stmt->bindParam(":credits",$course["course_credits"],PDO::PARAM_INT);
            $stmt->execute();
            header("Location:Enroll.php");
            exit();
        }
        //course doesn't appear in the list of student available courses
        else{
            $_SESSION["invalid_course"] = "Invalid course";
            header("Location:Enroll.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "Error during enrollment process!!! ".$exception->getMessage();
    }
}
try{
    //check if the student is enrolled in any semester
    $select_semester = "SELECT semester 
        FROM semester_enrollments
        WHERE student_id = :studentid";
        $stmt1 = $conn->prepare($select_semester);
        $stmt1->bindParam(":studentid",$_SESSION["student_id"],PDO::PARAM_INT);
        $stmt1->execute();
        $semester = $stmt1->fetch(PDO::FETCH_ASSOC);
        $courses = [];//display nothing if he is not enrolled in a semester


            //if the student is enrolled in a semester , 
            // display the available courses in this semester
            //  but only the courses of his major
        if($semester){
            $select = "SELECT course_code,course_name,course_credits
            FROM courses 
            WHERE course_major = :major AND semester =:semester";
            $stmt = $conn->prepare($select);
            $stmt->bindParam(":major",$_SESSION["student_major"],PDO::PARAM_STR);
            $stmt->bindParam(":semester",$_SESSION["enrolled_semester"],PDO::PARAM_STR);
            $stmt->execute();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}
catch(PDOException $exception){
    echo "Error during search process!!! ".$exception->getMessage();
}