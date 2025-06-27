<?php
    require "courses_enrollments.php";
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../Images/Harvard_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Student/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/Student/navbar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll</title>
</head>
<body>
    <?php include"../Components/student_navbar.php";?>
<main class="main">
    <div class="first-container">
            <h1>Courses Enrollments</h1>
            <form method="POST" action="courses_enrollments.php">
                <div class="data-input">
                    <div>
                        <label class="label" for="course">Course</label><br/><br/>
                        <input class="input" id="course" type="text" placeholder="Enter Course code" name="course_code"><br><br>
                        <button type="submit" class="btn"><i class="fa-solid fa-plus"></i> Enroll</button>
                        <?php
                            if(isset($_SESSION["empty_course"])){
                                echo '<p style = "color:#f24040;">'.$_SESSION["empty_course"].'</p>';
                                $_SESSION["empty_course"] = "";
                            }
                            if(isset($_SESSION["invalid_course"])){
                                echo '<p style = "color:#f24040;">'.$_SESSION["invalid_course"].'</p>';
                                $_SESSION["invalid_course"] = "";
                            }
                            if(isset($_SESSION["already_enrolled"])){
                                echo '<p style = "color:#f24040;">'.$_SESSION["already_enrolled"].'</p>';
                                $_SESSION["already_enrolled"] = "";
                            }
                            if(isset($_SESSION["limit_reached"])){
                                echo '<p style = "color:#f24040;">'.$_SESSION["limit_reached"].'</p>';
                                $_SESSION["limit_reached"] = "";
                            }
                        ?>
                    </div>
                </div>
            </form>
    </div>
    <h2 class="tbl-title"><?php echo $_SESSION["enrolled_semester"];?></h2>
    <div class="second-container">
            <table class="tbl">
                <tr>
                    <th>Code</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                </tr>
                <?php foreach($courses as $course) : ?>
                    <tr>
                        <td><?php echo $course["course_code"];?></td>
                        <td><?php echo $course["course_name"];?></td>
                        <td><?php echo $course["course_credits"];?></td>
                    </tr>
                <?php endforeach ?>
            </table>
    </div>
</main>
</body>
</html>