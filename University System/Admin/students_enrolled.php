<?php
    require "enrolled_students.php";
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header(header: "Location:Login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Admin/style.css">
    <link rel="stylesheet" href="../CSS/Admin/edit_modal.css">
    <link rel="stylesheet" href="../CSS/Admin/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Students</title>
</head>
<body>
    <?php include 'navbar.php';?>
        <main class="main">
        <div class="first-container">
            <h1>Students Enrolled</h1>
            <form method="POST" action="enrolled_students.php">
                <label class="label" for="studentid">Student ID</label><br/><br/>
                <input class="input" id="studentid" type="number" min="1" placeholder="Enter student ID" name="id"><br><br>
                <?php
                    if(isset($_SESSION["id"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["id"].'</p>';
                        $_SESSION["id"] = "";
                    }
                    if(isset($_SESSION["student_not_found"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["student_not_found"].'</p>';
                        $_SESSION["student_not_found"] = "";
                    }
                ?>
                <label class="label" for="student_name">Student Name</label><br/><br/>
                <input class="input" id="student_name" type="text" placeholder="Enter student Name" name="name"><br><br>
                <?php
                    if(isset($_SESSION["name"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["name"].'</p>';
                        $_SESSION["name"] = "";
                    }
                ?>
                <label class="label" for="student_major">Student Major</label><br/><br/>
                <select class="dropdown-list" name="major">
                <?php foreach($Majors as $Major) : ?>
                    <option value="<?php echo $Major["major_name"];?>"><?php echo $Major["major_name"];?></option>
                <?php endforeach ?>
                </select>
                <br><br>
                <?php
                    if(isset($_SESSION["major"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["major"].'</p>';
                        $_SESSION["major"] = "";
                    }
                ?>
                <label class="label" for="student_email">Student Email</label><br/><br/>
                <input class="input" id="student_email" type="email" placeholder="Enter student Email" name="email"><br><br>
                <?php
                    if(isset($_SESSION["email"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["email"].'</p>';
                        $_SESSION["email"] = "";
                    }
                ?>


                <label class="label" for="semester">Semester</label><br/><br/>
                <select class="dropdown-list" name="semester">
                <?php foreach($semesters_name as $semester) : ?>
                    <option value="<?php echo $semester["semester_name"];?>"><?php echo $semester["semester_name"];?></option>
                <?php endforeach ?>
                </select>
                <br><br>
                <?php
                    if(isset($_SESSION["semester"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["semester"].'</p>';
                        $_SESSION["semester"] = "";
                    }
                    if(isset($_SESSION["semester_not_found"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["semester_not_found"].'</p>';
                        $_SESSION["semester_not_found"] = "";
                    }
                ?>
                <button type="submit" class="btn"><i class="fa-solid fa-plus"></i> Enroll</button>
            </form>
        </div>
        <div class="second-container">
            <?php
                if(isset($_SESSION["name"])){
                    echo '<p class="txt">'.$_SESSION["name"].'</p>';
                    $_SESSION["name"] = "";
                }
                if(isset($_SESSION["invalid_name"])){
                    echo '<p class="txt">'.$_SESSION["invalid_name"].'</p>';
                    $_SESSION["invalid_name"] = "";
                }
                if(isset($_SESSION["student_already_enrolled"])){
                    echo '<p class="txt">'.$_SESSION["student_already_enrolled"].'</p>';
                    $_SESSION["student_already_enrolled"] = "";
                }
                if(isset($_SESSION["major_not_found"])){
                    echo '<p class="txt">'.$_SESSION["major_not_found"].'</p>';
                    $_SESSION["major_not_found"] = "";
                }
            ?>
            <div>
            </div>
            <table class="tbl">
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Major</th>
                    <th>Email</th>
                    <th>Semester</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                    <?php foreach($students_enrolled as $student) : ?>
                    
                        <tr>
                            <td><?php echo $student["student_id"];?></td>
                            <td><?php echo $student["student_name"];?></td> 
                            <td><?php echo $student["student_major"];?></td>
                            <td><?php echo $student["student_email"];?></td>
                            <td><?php echo $student["semester"];?></td>
                            <form action="delete_enrollment.php" method="POST">
                                <input type="hidden" value="<?php echo $student["student_id"];?>" name="hidden_id">
                                <input type="hidden" value="<?php echo $student["semester"];?>" name="hidden_semester">
                                <td><button type="button" class="edit-btn" data-studentmajor = "<?php echo $student["student_major"];?>" data-studentid="<?php echo $student["student_id"];?>" data-studentname = "<?php echo $student["student_name"];?>"><i class="fa-solid fa-pen"></i>Edit</button></td>
                                <td><button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i>Delete</button></td>
                            </form>
                        </tr>
                    <?php endforeach ?>
                </form>
            </table>
        </div>
        <?php require "student_enrolled_edit.php";?>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            const edit_btn = document.querySelectorAll('.edit-btn');
            const edit_modal = document.querySelector('.container');
            const cancel_edit = document.querySelector('.cancel-btn');
            const new_name = document.getElementById('newname');
            const old_name = document.getElementById('oldname');
            const student_id = document.getElementById('student_id');
            const new_major = document.getElementById('newmajor');
            const old_major = document.getElementById('oldmajor');
            [...edit_btn].forEach(function(edit){
                edit.addEventListener("click",()=>{
                    if(edit_modal.classList.contains('hidden-edit-modal')){
                        edit_modal.classList.remove('hidden-edit-modal');
                        edit_modal.classList.add('show-edit-modal');
                    }
                    new_name.value = edit.getAttribute('data-studentname');
                    old_name.value = edit.getAttribute('data-studentname');
                    student_id.value = edit.getAttribute('data-studentid');
                    new_major.value = edit.getAttribute('data-studentmajor');
                    old_major.value = edit.getAttribute('data-studentmajor');

                });
            });
            cancel_edit.addEventListener("click",()=>{
                if(edit_modal.classList.contains('show-edit-modal')){
                    edit_modal.classList.remove('show-edit-modal');
                    edit_modal.classList.add('hidden-edit-modal');
                }
            });
        });
        

    </script>
</body>
</html>