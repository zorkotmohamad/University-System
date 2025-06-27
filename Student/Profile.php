<?php
    require "../Database/connection.php";
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
    try{
        $select = "SELECT course_code,course_name,credits
                    FROM courses_enrollments
                    WHERE student_id = :id";
        $stmt = $conn->prepare($select);
        $stmt->bindParam(":id",$_SESSION["student_id"],PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        echo "Error during fetch process!!! ".$exception->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Student/navbar.css">
    <link rel="shortcut icon" href="../Images/Harvard_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Student/style.css">
    <link rel="stylesheet" href="../CSS/Student/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
</head>
<body>
    <?php include'../Components/student_navbar.php';?>
    <main class="main">
            <div class="student-profile">
                <div class="student-info">
                    <div>
                        <img class="student-image" src="../uploads/<?php echo $_SESSION["student_profile"];?>" alt="Student Profile">
                    </div>
                    <div class="student-details">
                        <h1>Student Profile</h1>
                        <p>ID: <?php echo $_SESSION["student_id"];?></p>
                        <p>Name: <?php echo $_SESSION["student_name"];?></p>
                        <p>Major: <?php echo $_SESSION["student_major"];?></p>
                        <p>Semester: <?php echo $_SESSION["enrolled_semester"];?></p>                        
                    </div>
                </div>
                <div class="student-courses">
                    <h2>Student Courses</h2>
                    <table class="table">
                        <tr>
                            <th>Code</th>
                            <th>Course Name</th>
                            <th>Course Credits</th>
                        </tr>
                        <?php foreach($courses as $course) :?>
                        <tr>
                            <td><?php echo $course["course_code"];?></td>
                            <td><?php echo $course["course_name"];?></td>
                            <td><?php echo $course["credits"];?></td>
                        </tr>
                        <?php endforeach?>
                    </table>
                </div>
            </div>
    </main>
</body>
</html>