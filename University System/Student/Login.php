<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Student/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="form-title">
            <img src="../Images/Harvard_icon.png" alt="Harvard Logo"/>
            <h3 class="title">Login</h3>
        </div>
        <form method="POST" action="student_login.php" class="login-form">
                <label for="studentid">Student ID</label><br/><br/>
                <i id="id-icon" class="fa-solid fa-id-badge"></i>
                <input class="input" id="studentid" type="text" placeholder="Enter ID" name="student_id">
                <?php
                    if(isset($_SESSION["error_id"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["error_id"].'</p>';
                        $_SESSION["error_id"] = "";
                    }
                ?>
                <label for="password">Password</label><br/><br/>
                <i id="password-icon" class="fa-solid fa-lock"></i>
                <input class="input" id="password" type="password" placeholder=" Enter Password" name="password"><br><br>
                <?php
                    if(isset($_SESSION["error_password"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["error_password"].'</p>';
                        $_SESSION["error_password"] = "";
                    }
                    if(isset($_SESSION["student_not_found"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["student_not_found"].'</p>';
                        $_SESSION["student_not_found"] = "";
                    }
                    if(isset($_SESSION["wrong_pass"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["wrong_pass"].'</p>';
                        $_SESSION["wrong_pass"] = "";
                    }
                ?>
                <button class="btn" type="submit">Login</button><br><br>
        </form>
    </div>
</body>
</html>