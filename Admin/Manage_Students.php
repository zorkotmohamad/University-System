<?php
    require "add_students.php";
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Admin/manage_student.css">
    <link rel="stylesheet" href="../CSS/Admin/navbar.css">
    <link rel="stylesheet" href="../CSS/Admin/modal.css">
    <link rel="stylesheet" href="../CSS/Admin/edit_modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
</head>
<body>
    <?php include 'navbar.php';?>
    <main class="main">
        <div class="first-container">
            <h1>Student Management</h1>
            <form method="POST" action="add_students.php" enctype="multipart/form-data">
                <div class="data-input">
                    <div class="child">
                        <div>
                            <label class="label" for="studentid">Student ID</label><br/><br/>
                            <input class="input" id="studentid" type="number" min="1" placeholder="Enter Student ID" name="student_id"><br/><br/>
                            <?php
                                if(isset($_SESSION["studentid"])){
                                    echo '<p style="color:#f24040;">'.$_SESSION["studentid"].'</p>';
                                    $_SESSION["studentid"]="";
                                }
                                if(isset($_SESSION["invalid_ID"])){
                                    echo '<p style="color:#f24040;">'.$_SESSION["invalid_ID"].'</p>';
                                    $_SESSION["invalid_ID"]="";
                                }
                            ?>
                            <label class="label" for="studentname">Student Name</label><br/><br/>
                            <input class="input" id="studentname" type="text" placeholder="Enter Student Name" name="student_name"><br/><br/>
                            <?php
                               if(isset($_SESSION["studentname"])){
                                echo '<p style="color:#f24040;">'.$_SESSION["studentname"].'</p>';
                                $_SESSION["studentname"]="";
                               }
                            ?>
                        </div>
                    </div>
                    <div class="child">
                        <div>
                            <label class="label" for="studentmajor">Student Major</label><br/><br/>
                            <select class="dropdown-list" name="student_major">
                                <?php foreach($Majors as $Major) : ?>
                                    <option value="<?php echo $Major["major_name"];?>"><?php echo $Major["major_name"];?></option>
                                <?php endforeach ?>
                            </select>
                             <label class="label" for="studentemail">Student Email</label><br/><br/>
                            <input class="input" id="studentemail" type="email" placeholder="Enter Student Email" name="student_email"><br/><br/>
                            <?php
                               if(isset($_SESSION["studentemail"])){
                                echo '<p style="color:#f24040;">'.$_SESSION["studentemail"].'</p>';
                                $_SESSION["studentemail"]="";
                               }
                                if(isset($_SESSION["invalid_format"])){
                                echo '<p style="color:#f24040;">'.$_SESSION["invalid_format"].'</p>';
                                $_SESSION["invalid_format"]="";
                               }
                            ?>
                        </div>
                    </div>
                    <div class="child">
                        <div>
                            <label class="label" for="student_image">Upload Student Image</label>
                            <input id="student_image" type="file" name="student_image">
                            <?php
                                if(isset($_SESSION["image_format"])){
                                    echo '<p style="color:#f24040;">'.$_SESSION["image_format"].'</p>';
                                    $_SESSION["image_format"]="";
                               }
                                if(isset($_SESSION["not_real"])){
                                    echo '<p style="color:#f24040;">'.$_SESSION["not_real"].'</p>';
                                    $_SESSION["not_real"]="";
                               }
                                if(isset($_SESSION["large_size"])){
                                    echo '<p style="color:#f24040;">'.$_SESSION["large_size"].'</p>';
                                    $_SESSION["large_size"]="";
                               }
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="btn"><i class="fa-solid fa-plus"></i>Add</button>
                </div>
            </form>
            <?php
                if(isset($_SESSION["studentexist"])){
                    echo '<p style="color:#f24040;">'.$_SESSION["studentexist"].'</p>';
                    $_SESSION["studentexist"]="";
                }
                if(isset($_SESSION["major_not_found"])){
                    echo '<p style="color:#f24040;">'.$_SESSION["major_not_found"].'</p>';
                    $_SESSION["major_not_found"]="";
                }
            ?>
        </div>
        <div class="second-container">
            <?php
                if(isset($_SESSION["empty_fields"])){
                    echo '<p class="txt">'.$_SESSION["empty_fields"].'</p>';
                    $_SESSION["empty_fields"] ="";
                }
                if(isset($_SESSION["major_not_exist"])){
                    echo '<p class="txt">'.$_SESSION["major_not_exist"].'</p>';
                    $_SESSION["major_not_exist"] ="";
                }
                if(isset($_SESSION["student_exist"])){
                    echo '<p class="txt">'.$_SESSION["student_exist"].'</p>';
                    $_SESSION["student_exist"] ="";
                }
            ?>
            <table class="tbl">
                <tr>
                    <td>Profile</td>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Major</th>
                    <th>Email</th>
                    <th>Creation Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php foreach($students as $student) : ?>
                        <tr>
                            <td><img class="std-profile" src="../uploads/<?php echo $student["student_profile"];?>" alt="Student Profile"></td>
                            <td><?php echo $student["student_id"];?></td>
                            <td><?php echo$student["name"];?></td>
                            <td><?php echo $student["major"];?></td>
                            <td><?php echo $student["email"];?></td>
                            <td><?php echo $student["date_created"];?></td>
                            <td>
                                <button class="edit-btn" 
                                data-student_email="<?php echo $student["email"];?>" 
                                data-student_major="<?php echo $student["major"];?>" 
                                data-student_name="<?php echo$student["name"];?>" 
                                data-student_id="<?php echo $student["student_id"];?>">
                                    <i class="fa-solid fa-pen"></i>Edit
                                </button>
                            </td>
                            <td><button class="delete-btn" data-student_id="<?php echo $student["student_id"];?>"><i class="fa-solid fa-trash"></i>Delete</button></td>
                        </tr>
                <?php endforeach ?>
            </table>
        </div>
        <?php require "student_modal.php";?>
        <?php require "student_edit.php";?>
    </main>
    <script src="../JavaScript/student_modal.js"></script>
</body>
</html>