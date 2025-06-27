<?php
    require "add_majors.php";
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
    <title>Majors</title>
</head>
<body>
    <?php include 'navbar.php';?>
    <main class="main">
        <div class="first-container">
            <h1>Majors Management</h1>
            <form method="POST" action="add_majors.php">
                <label class="label" for="major">Major Name</label><br/><br/>
                <input class="input" id="major" type="text" placeholder="Enter Major name" name="major"><br><br>
                <?php
                    if(isset($_GET["major"]) && $_GET["major"]=="1"){
                        echo '<p style="color:#f24040;">Enter major name !</p>';
                    }
                    if(isset($_SESSION["major"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["major"].'</p>';
                        $_SESSION["major"] = "";
                    }
                ?>
                <button type="submit" class="btn"><i class="fa-solid fa-plus"></i>Add</button>
            </form>
        </div>
        <div class="second-container">
            <?php
                if(isset($_SESSION["major_exist"])){
                    echo '<p style="color:#f24040;">'.$_SESSION["major_exist"].'</p>';
                    $_SESSION["major_exist"]= "";
                }
            ?>
            <table class="tbl">
                <tr>
                    <th>Major Name</th>
                    <th>Creation Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>   
                <?php foreach($majors as $major):?>
                    <tr>
                        <td><?php echo $major["major_name"];?></td>
                        <td><?php echo $major["date_created"];?></td>  
                        <td><button class="edit-btn" data-major_name = "<?php echo $major["major_name"];?>"><i class="fa-solid fa-pen"></i>Edit</button></td>
                        <td><button type="button" data-major="<?php echo $major["major_name"];?>" class="delete-btn"><i class="fa-solid fa-trash"></i>Delete</button></td>
                    </tr>
                <?php endforeach?>
            </table>
        </div>
        <?php require "major_modal.php";?>
        <?php require "major_edit.php";?>
    </main>
    <script src="../JavaScript/major_modal.js"></script>
</body>
</html>