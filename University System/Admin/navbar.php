<?php
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<nav class="navbar">
    <div class="title">
        <div class="bar-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
        <img class="logo" src="../Images/Harvard logo.png" alt="Harvard Logo">
        <p>Admin Management</p>
    </div>
    <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="Majors.php">Majors</a>
        <a href="Semesters.php">Semesters</a>
        <a href="Courses.php">Courses</a>
        <a href="Manage_Students.php">Manage Students</a>
        <a href="students_enrolled.php">Enrolled students</a>
        <a href="Enrollments.php">Enrollments</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>
<!-- for phone and small devices -->
<div class="unvisible-links hidden-links">
    <ul class="links">
        <li><img src="../Images/home.png"/><a href="">Home</a></li>
        <li><img src="../Images/department.png"/><a href="Departments.php">Departments</a></li>
        <li><img src="../Images/semester.png"/><a href="Semesters.php">Semesters</a></li>
        <li><img src="../Images/course.png"/><a href="Courses.php">Courses</a></li>
        <li><img src="../Images/student.png"/><a href="Manage_Students.php">Manage Students</a></li>
        <li><img src="../Images/enrollment.png"/><a href="Enrollments.php">Enrollments</a></li>
        <li><img src="../Images/logs.png"/><a href="Logs.php">Logs</a></li>
        <li><img src="../Images/profile.png"/><a href="">Profile</a></li>
        <li><img src="../Images/logout.png"/><a href="Login.php">Logout</a></li>
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