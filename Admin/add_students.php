<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $studentid = htmlspecialchars(trim($_POST["student_id"]));
    $studentname = htmlspecialchars(trim($_POST["student_name"]));
    $studentmajor = htmlspecialchars(trim($_POST["student_major"]));
    $studentemail = htmlspecialchars(trim($_POST["student_email"]));
    $studentid = (string) $studentid;
    $studentpassword = $studentid . "@Harvard.edu";
    $student_hashed_password = password_hash($studentpassword,PASSWORD_BCRYPT);
    if(empty($studentid)){
        $_SESSION["studentid"] = "Student ID is required";
        header("Location:Manage_Students.php");
    }
    if(empty($studentname)){
        $_SESSION["studentname"] = "Student name is required";
        header("Location:Manage_Students.php");
    }
    if(empty($studentemail)){
        $_SESSION["studentemail"] = "Student Email is required";
        header("Location:Manage_Students.php");
    }
    if(!filter_var($studentemail,FILTER_VALIDATE_EMAIL)){
        $_SESSION["invalid_format"] = "Invalid Email format";
        header("Location:Manage_Students.php");
        exit();
    }
    if($studentid <= 0){
        $_SESSION["invalid_ID"] = "Invalid ID";
        header("Location:Manage_Students.php");
        exit();
    }

    //extract the file extension
    //strtolower() transform all characters to small letter
    $file_extension = strtolower(pathinfo($_FILES["student_image"]["name"],PATHINFO_EXTENSION));
    $image_name = "img_" . bin2hex(random_bytes(length: 10)) . "." . $file_extension;
    //we accept only png,jpg and jpeg image format
    if($file_extension != "png" && $file_extension != "jpg" && $file_extension != "jpeg"){
        $_SESSION["image_format"] = "Image format not accepted";
        header("Location:Manage_Students.php");
        exit();
    }
    //getimagesize() -> obtain image size (height and width) [return type -> boolean] check if real image
    if(!getimagesize($_FILES["student_image"]["tmp_name"])){
        $_SESSION["not_real"] = "Not a real picture";
        header("Location:Manage_Students.php");
        exit();
    }
    //check file size
    if($_FILES["student_image"]["size"] > 5000000){
        $_SESSION["large_size"] = "unsupported size";
        header("Location:Manage_Students.php");
        exit();
    }
    //check if the file exits
    while(file_exists("../uploads/" . $image_name)){
        $image_name = "img_" . bin2hex(random_bytes(10)) . "." . $file_extension;
    }
    try{
        move_uploaded_file($_FILES["student_image"]["tmp_name"],"../uploads/" . $image_name);
        $select_major = "SELECT major_name FROM majors WHERE major_name = :major";
        $stmtmajor = $conn->prepare($select_major);
        $stmtmajor->bindParam(":major",$studentmajor,PDO::PARAM_STR);
        $stmtmajor->execute();
        $major = $stmtmajor->fetch(PDO::FETCH_ASSOC);

        $select_student= "SELECT student_id,email 
                    FROM students 
                    WHERE student_id = :id OR email = :email";
        $stmt = $conn->prepare($select_student);
        $stmt->bindParam(":id",$studentid,PDO::PARAM_INT);
        $stmt->bindParam(":email",$studentemail,PDO::PARAM_STR);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        if($major){
            if($student){
                $_SESSION["studentexist"] = "ID or Email Already exist";
                header("Location:Manage_Students.php");
                exit();
            }
            else{
                $insert = "INSERT INTO students(student_profile,student_id,password,name,major,email) 
                            VALUES (:profile,:id,:pass,:name,:major,:email)";
                $stmt = $conn->prepare($insert);
                $stmt->bindParam(":profile",$image_name,PDO::PARAM_STR);
                $stmt->bindParam(":id",$studentid,PDO::PARAM_INT);
                $stmt->bindParam(":pass",$student_hashed_password,PDO::PARAM_STR);
                $stmt->bindParam(":name",$studentname,PDO::PARAM_STR);
                $stmt->bindParam(":major",$studentmajor,PDO::PARAM_STR);
                $stmt->bindParam(":email",$studentemail,PDO::PARAM_STR);
                $stmt->execute();
                header("Location:Manage_Students.php");
                exit();
            }
        }
        else{
            $_SESSION["major_not_found"] = "This major doesn't exist in your majors list";
            header("Location:Manage_Students.php");
            exit();
        }
    }
    catch(PDOException $exception){
        echo "can not insert data,something wrong!!! ".$exception->getMessage();
    }
}
try{
    $select = "SELECT student_profile,student_id,name,major,email,date_created FROM students";
    $stmt = $conn->query($select);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $sql_major ="SELECT major_name FROM majors";
    $stmtMajor = $conn->query($sql_major);
    $Majors = $stmtMajor->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $exception){
    echo "Error during fetch process!!! ".$exception->getMessage();
}