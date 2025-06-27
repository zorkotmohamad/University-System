<?php
require "../Database/connection.php";
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $major = htmlspecialchars(trim($_POST["major"]));
    if(empty($major)){
        header("Location:Majors.php?major=1");
        exit();
    }
    try{
        $select = "SELECT major_name FROM majors WHERE major_name = :major";
        $stmt = $conn->prepare($select);
        $stmt->bindParam(":major",$major,PDO::PARAM_STR);
        $stmt->execute();
        $exist_major = $stmt->fetch(PDO::FETCH_ASSOC);
        if($exist_major){
            $_SESSION["major"] = "Major Already exists";
            header("Location:Majors.php");
            exit();
        }
        else{
            $insert = "INSERT INTO majors (major_name) VALUES (:major_name)";
            $stmt = $conn->prepare($insert);
            $stmt->bindParam(":major_name",$major,PDO::PARAM_STR);
            $stmt->execute();
            header("Location:Majors.php");
        }
    }
    catch(PDOException $exception){
        echo "can not add something wrong !!! ".$exception->getMessage();
    }
}
try{
    $select = "SELECT major_name,date_created FROM majors";
    $stmt2 = $conn->query($select);
    //fetchAll(PDO::FETCH_ASSOC) return an array of associative arrays,
    // that means each row in the table majors is an associative array such as the column names
    //are the keys
    $majors = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $exception){
    $exception->getMessage();
}