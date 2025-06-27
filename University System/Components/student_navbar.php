<?php
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:../Student/Login.php");
        exit();
    }
?>
<nav class="navbar">
    <div class="title">
        <div class="bar-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
        <img class="logo" src="../Images/Harvard logo.png" alt="Harvard Logo">
        <p>Student Dashboard</p>
    </div>
    <div class="nav-links">
        <a href="Home.php">Home</a>
        <a href="Enroll.php">Enroll</a>
        <a href="Profile.php">Profile</a>
        <a href="Login.php">Logout</a>
    </div>
</nav>
<div class="unvisible-links hidden-links">
    <ul class="links">
        <li><a href="Home.php">Home</a></li>
        <li><a href="Enroll.php">Enroll</a></li>
        <li><a href="Profile.php">Profile</a></li>
        <li><a href="../Student/logout.php">Logout</a></li>
    </ul>
</div>
<script>
    const barbtn = document.querySelector('.bar-icon');
    const link_container = document.querySelector('.unvisible-links');
    barbtn.addEventListener("click",()=>{
        if(link_container.classList.contains('hidden-links')){
            link_container.classList.remove('hidden-links');
        }
        else{
            link_container.classList.add('hidden-links');
        }
    });
</script>