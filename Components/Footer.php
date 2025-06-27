<?php
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:../Student/Login.php");
        exit();
    }
?>
<footer class="footer">
    <div class="footer-paragraph">
        <p>Copyright &copy; 2025 Harvard University</p>
    </div>
    <div>
        <img class="footer-logo" src="../Images/Harvard logo.png" alt="Harvard Logo">
    </div>
    <div class="footer-icons">
        <i class="fa-brands fa-instagram"></i>
        <i class="fa-brands fa-tiktok"></i>
        <i class="fa-brands fa-linkedin-in"></i>
        <i class="fa-brands fa-facebook-f"></i>
        <i class="fa-brands fa-youtube"></i>
    </div>
</footer>