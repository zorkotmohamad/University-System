<?php
require "add_courses.php";
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Admin/style.css">
    <link rel="stylesheet" href="../CSS/Admin/modal.css">
    <link rel="stylesheet" href="../CSS/Admin/edit_modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/Admin/navbar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
</head>
<body>
    <?php include 'navbar.php';?>
    <main class="main">
        <div class="first-container">
            <h1>Courses Management</h1>
            <div class="data-input">
                <div class="child">
                    <form action="add_courses.php" method="POST">
                        <div>
                            <label class="label" for="coursename">Course Name</label><br/><br/>
                            <input class="input" id="coursename" type="text" placeholder="Enter Course name" name="course_name"><br/><br/>
                            <?php
                                if(isset($_SESSION["coursename"])){
                                    echo '<p style="color:#f24040;font-family: "Roboto", sans-serif;">'.$_SESSION["coursename"].'</p>';
                                    $_SESSION["coursename"]="";
                                }
                            ?>
                        </div>
                        <div>
                            <label class="label" for="courseid">Course Code</label><br/><br/>
                            <input class="input" id="courseid" type="text" placeholder="Enter Course Code" name="course_code"><br/><br/>
                            <?php
                                if(isset($_SESSION["coursecode"])){
                                    echo '<p style="color:#f24040;font-family: "Roboto", sans-serif;">'.$_SESSION["coursecode"].'</p>';
                                    $_SESSION["coursecode"] ="";
                                }
                            ?>
                        </div>
                        <div>
                            <label class="label" for="coursecredits">Course Credits</label><br/><br/>
                            <input class="input" id="coursecredits" type="number" min="1" placeholder="Enter Course Credits" name="course_credits"><br/><br/>
                            <?php
                                if(isset($_SESSION["credits"])){
                                    echo '<p style="color:#f24040;font-family: "Roboto", sans-serif;">'.$_SESSION["credits"].'</p>';
                                    $_SESSION["credits"] ="";
                                }
                            ?>
                        </div>
                        <div>
                            <label class="label" for="semester">Semester</label><br/><br/>
                            <select class="dropdown-list" name="semester">
                                <?php foreach($semesters_name as $semester) : ?>
                                    <option value="<?php echo $semester["semester_name"];?>"><?php echo $semester["semester_name"];?></option>
                                <?php endforeach ?>
                            </select>
                            <br><br>                      
                        </div>
                        <div>
                            <label class="label" for="coursemajor">Course Major</label><br/><br/>
                            <select class="dropdown-list" name="course_major">
                                <?php foreach($Majors as $Major) : ?>
                                    <option value="<?php echo $Major["major_name"];?>"><?php echo $Major["major_name"];?></option>
                                <?php endforeach ?>
                            </select><br><br>
                            <button type="submit" class="btn"><i class="fa-solid fa-plus"></i>Add</button>
                        </div>
                    </form>
                    <?php
                        if(isset($_SESSION["course_exist"])){
                            echo '<p style="color:#f24040;font-family: "Roboto", sans-serif;">'.$_SESSION["course_exist"].'</p>';
                            $_SESSION["course_exist"]= "";
                        }
                    ?>
                </div>
            </div>
        </div>
        </div>
        <div class="second-container">
            <?php
                if(isset($_SESSION["editcourse_exist"])){
                    echo '<p class="txt">'.$_SESSION["editcourse_exist"].'</p>';
                    $_SESSION["editcourse_exist"]="";
                }
                if(isset($_SESSION["editmajor_not_found"])){
                    echo '<p class="txt">'.$_SESSION["editmajor_not_found"].'</p>';
                    $_SESSION["editmajor_not_found"]="";
                }
                if(isset($_SESSION["semester_not_exist"])){
                    echo '<p class="txt">'.$_SESSION["semester_not_exist"].'</p>';
                    $_SESSION["semester_not_exist"]="";
                }
            ?>
            <table class="tbl">
                <tr>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Semester</th>
                    <th>Course Major</th>
                    <th>Creation Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php foreach($courses as $course) : ?>
                    <tr>
                        <td><?php echo $course["course_name"];?></td>
                        <td><?php echo $course["course_code"];?></td>
                        <td><?php echo $course["course_credits"];?></td>
                        <td><?php echo $course["semester"];?></td>
                        <td><?php echo $course["course_major"];?></td>
                        <td><?php echo $course["date_created"];?></td>
                        <td>
                            <button class="edit-btn" 
                            data-course_semester = "<?php echo $course["semester"];?>"
                            data-course_credits ="<?php echo $course["course_credits"];?>" 
                            data-course_major="<?php echo $course["course_major"];?>" 
                            data-course_name = "<?php echo $course["course_name"];?>" 
                            data-course_code ="<?php echo $course["course_code"];?>">
                                <i class="fa-solid fa-pen">   
                                </i>
                                Edit
                        </button>
                        </td>
                        <td><button class="delete-btn" data-course="<?php echo $course["course_name"];?>"><i class="fa-solid fa-trash"></i>Delete</button></td>
                    </tr>
                <?php endforeach?>
            </table>
        </div>
        <?php require "courses_modal.php";?>
        <?php require "course_edit.php";?>
    </main>
    <script src="../JavaScript/courses_modal.js"></script>
</body>
</html>