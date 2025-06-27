<?php
require "add_semesters.php";
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/Admin/style.css">
    <link rel="stylesheet" href="../CSS/Admin/navbar.css">
    <link rel="stylesheet" href="../CSS/Admin/modal.css">
    <link rel="stylesheet" href="../CSS/Admin/edit_modal.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semesters</title>
</head>
<body>
    <?php include 'navbar.php';?>
    <main class="main">
        <div class="first-container">
            <h1>Semesters Management</h1>
            <form action="add_semesters.php" method="POST">
                <label class="label" for="Semester">Semester Name</label><br/><br/>
                <input class="input" id="Semester" type="text" placeholder="Enter Semester name" name="semester_name"><br/><br/>
                <?php
                    if(isset($_SESSION["semester"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["semester"].'</p>';
                        $_SESSION["semester"] = "";
                    }
                    if(isset($_SESSION["semester_found"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["semester_found"].'</p>';
                        $_SESSION["semester_found"] = "";
                    }
                ?>
                <button type="submit" class="btn"><i class="fa-solid fa-plus"></i>Add</button>
            </form>
        </div>
        <div class="second-container">
            <?php
                if(isset($_SESSION["semester"])){
                    echo '<p style="color:#f24040;">'.$_SESSION["semester"].'</p>';
                    $_SESSION["semester"] ="";
                }
                if(isset($_SESSION["semester_exists"])){
                    echo '<p style="color:#f24040;text-align:center;">'.$_SESSION["semester_exists"].'</p>';
                    $_SESSION["semester_exists"] ="";
                }
            ?>
            <table class="tbl">
                <tr>
                    <th>Semester Name</th>
                    <th>Creation Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php foreach($semesters as $semester) :?>
                    <tr>
                        <td><?php echo $semester["semester_name"];?></td>
                        <td><?php echo $semester["date_created"];?></td>
                        <td><button class="edit-btn" data-semester="<?php echo $semester["semester_name"];?>"><i class="fa-solid fa-pen"></i>Edit</button></td>
                        <td><button class="delete-btn" data-semester="<?php echo $semester["semester_name"];?>"><i class="fa-solid fa-trash"></i>Delete</button></td>
                    </tr>
                <?php endforeach?>
            </table>
        </div>
        <?php require "semester_modal.php";?>
        <?php require "semester_edit.php";?>
    </main>
    <script src="../JavaScript/semester_modal.js"></script>
</body>
</html>