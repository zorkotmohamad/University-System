<?php
    require "../Database/connection.php";
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $code = htmlspecialchars(trim($_POST["coursecode"]));
        $id = htmlspecialchars(trim($_POST["studentid"]));
        try{
            $drop = "DELETE FROM courses_enrollments 
            WHERE student_id = :id AND course_code = :code";
            $stmt = $conn->prepare($drop);
            $stmt->bindParam(":id",$id,PDO::PARAM_INT);
            $stmt->bindParam(":code",$code,PDO::PARAM_STR);
            $stmt->execute();
            header("Location:Enrollments.php");
        }
        catch(PDOException $exception){
            echo "Error during delete process!!! ".$exception->getMessage();
        }
    }
    try{
        $select = "SELECT student_name,student_id,course_code,course_name,semester,credits,enroll_date
                    FROM courses_enrollments";
        $stmt = $conn->query($select);
        $courses_enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $exception){
        echo "Error during fetch process!!! ".$exception->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/Admin/style.css">
    <link rel="stylesheet" href="../CSS/Admin/navbar.css">
    <link rel="stylesheet" href="../CSS/Admin/modal.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollments</title>
</head>
<body>
    <?php include'navbar.php';?>
    <main class="main">
        <div class="second-container">
            <table class="tbl">
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Course Credits</th>
                    <th>Semester</th>
                    <th>Enroll Date</th>
                    <th>Drop Course</th>
                </tr>
               <?php foreach($courses_enrollments as $enrollment) :?>
                <tr>
                    <td><?php echo $enrollment["student_id"];?></td>
                    <td><?php echo $enrollment["student_name"];?></td>
                    <td><?php echo $enrollment["course_code"];?></td>
                    <td><?php echo $enrollment["course_name"];?></td>
                    <td><?php echo $enrollment["credits"];?></td>
                    <td><?php echo $enrollment["semester"];?></td>
                    <td><?php echo $enrollment["enroll_date"];?></td>
                    <td><button type="submit" class="drop-btn" 
                    data-studentid ="<?php echo $enrollment["student_id"];?>" 
                    data-coursecode="<?php echo $enrollment["course_code"];?>">Drop Course</button></td>
                </tr>
                <?php endforeach?>
            </table>
        </div>
        <?php require "drop_modal.php";?>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            const course_code = document.getElementById('coursecode');
            const student_id = document.getElementById('studentid');
            const drop_btn = document.querySelectorAll('.drop-btn');
            const drop_modal = document.querySelector('.modal');
            const cancel_drop = document.getElementById('cancel-btn');
            [...drop_btn].forEach(function(drop){
                drop.addEventListener("click",()=>{
                    if(drop_modal.classList.contains('hidden-modal')){
                        drop_modal.classList.remove('hidden-modal');
                        drop_modal.classList.add('show-modal');
                    }
                    course_code.value = drop.getAttribute('data-coursecode');
                    student_id.value = drop.getAttribute('data-studentid');
                });
            });
            cancel_drop.addEventListener("click",()=>{
                if(drop_modal.classList.contains('show-modal')){
                    drop_modal.classList.remove('show-modal');
                    drop_modal.classList.add('hidden-modal');
                }
            });
        });
    </script>
</body>
</html>