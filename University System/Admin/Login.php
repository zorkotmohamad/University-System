<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/Admin/Login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="form-title">
            <img src="../Images/Harvard_icon.png" alt="Harvard Logo"/>
            <h3 class="title">Harvard Administration</h3>
        </div>
        <form class="login-form" action="login_admin.php" method="POST">
                <label for="username">Username</label><br/>
                <input class="input" id="username" type="text" placeholder="Username" name="username"><br/>
                <?php
                    if(isset($_SESSION["username"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["username"].'</p>';
                        $_SESSION["username"] ="";
                    }
                ?>
                <label for="password">Password</label><br/>
                <input class="input" id="password" type="password" placeholder="Password" name="password"><br/>
                <?php
                    if(isset($_SESSION["password"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["password"].'</p>';
                        $_SESSION["password"] ="";
                    }
                    if(isset($_SESSION["wrong_password"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["wrong_password"].'</p>';
                        $_SESSION["wrong_password"] ="";
                    }
                    if(isset($_SESSION["not_admin"])){
                        echo '<p style="color:#f24040;">'.$_SESSION["not_admin"].'</p>';
                        $_SESSION["not_admin"] ="";
                    }
                ?>
                <button class="btn" type="submit">Login</button><br><br>
            <!-- <a class="link-to-home" href="home.html">Return to Home Page</a> -->
        </form>
    </div>
</body>
</html>