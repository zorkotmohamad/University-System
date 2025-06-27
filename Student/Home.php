<?php
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Student/navbar.css">
    <link rel="shortcut icon" href="../Images/Harvard_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/Student/home.css">
    <link rel="stylesheet" href="../CSS/Student/footer.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php include"../Components/student_navbar.php";?>
    <main class="main">
        <div class="container1">
            <h1 class="hidden">About Us</h1>
            <p class="hidden paragraph">
                Welcome to <span>Harvard</span>, a prestigious institution committed to academic excellence, innovation, and holistic student development. With a legacy of shaping future leaders, our university offers a wide range of programs across diverse disciplines, guided by experienced faculty and supported by modern facilities. From state-of-the-art laboratories and a dynamic library to vibrant student life and global collaborations, we provide an environment where knowledge thrives and students are empowered to succeed. Whether you're pursuing undergraduate or postgraduate studies, <span>Harvard</span> is where ambition meets opportunity.
            </p>
        </div>
        <div class="container2">
            <div class="hidden">
                <img class="image" src="../Images/library.jpg" alt="Library" loading="lazy"><br/>
                <p>
                    A modern and well-equipped university library, filled with students engaged in study and research. This reflects the institution's dedication to knowledge, learning resources, and academic support.
                </p>
            </div>
            <div class="hidden">
                <img class="image" src="../Images/graduates.png" alt="Graduates" loading="lazy"><br/>
                <p>
                    A joyful moment captured as graduates, dressed in caps and gowns, celebrate the culmination of their academic journey. This image represents the university's dedication to empowering students and preparing them for future success.
                </p>
            </div>
            <div class="hidden">
                <img class="image" src="../Images/cafeteria.png" alt="Cafeteria" loading="lazy"><br/>
                <p>
                    A clean and vibrant cafeteria space where students gather for meals and social interaction. It showcases the university's focus on student well-being, community, and campus life.
                </p>
            </div>
            <div class="hidden">
                <img class="image" src="../Images/ranking.png" alt="Ranking" loading="lazy"><br/>
                <p>
                    A visual celebration of the university's high standing among leading educational institutions, representing its excellence in teaching, innovation, and global recognition. It emphasizes the university's strong reputation and academic leadership.
                </p>
            </div>
        </div>
        <p class="hidden paragraph1">Our Faculties</p>
        <div class="container3">
            <div class="hidden faculty">
                <img class="image" src="../Images/drugs.png" alt="Pharmacy" loading="lazy">
                <h3 class="title1">Pharmacy</h3>
                <p>
                    The Faculty of Pharmacy prepares students for impactful careers in pharmaceutical sciences, clinical pharmacy, and drug research. Through a blend of classroom learning, laboratory experience, and healthcare partnerships, it ensures graduates are ready to serve and innovate in the medical field.
                </p>
            </div>
            <div class="hidden faculty">
                <img class="image" src="../Images/palette.png" alt="Arts" loading="lazy">
                <h3 class="title1">Arts</h3>
                <p>
                    The Faculty of Arts is a hub of creativity and intellectual exploration, offering programs in literature, languages, history, philosophy, and more. It encourages cultural understanding, critical analysis, and expressive communication, empowering students to engage meaningfully with society.
                </p>
            </div>
            <div class="hidden faculty">
                <img class="image" src="../Images/digital-transformation.png" alt="Technology" loading="lazy">
                <h3 class="title1">Technology</h3>
                <p>
                    The Faculty of Technology trains future innovators in areas such as computer science, information systems, engineering, and emerging digital technologies. With hands-on learning and industry-driven curricula, it equips students to meet the challenges of an evolving tech landscape.
                </p>
            </div>
            <div class="hidden faculty">
                <img class="image" src="../Images/diagram.png" alt="Business" loading="lazy">
                <h3 class="title1">Business</h3>
                <p>
                    The Faculty of Business cultivates future leaders and entrepreneurs with programs in management, marketing, finance, and economics. Combining academic theory with real-world application, it emphasizes strategic thinking, ethical leadership, and global business practices.
                </p>
            </div>
            <div class="hidden faculty">
                <img class="image" src="../Images/chemistry.png" alt="Sciences" loading="lazy">
                <h3 class="title1">Sciences</h3>
                <p>
                    The Faculty of Sciences fosters critical thinking and discovery through rigorous study in fields such as biology, chemistry, physics, and mathematics. Equipped with modern laboratories and research facilities, it prepares students for careers in research, education, and scientific innovation.
                </p>
            </div>
            <div class="hidden faculty">
                <img class="image" src="../Images/caduceus.png" alt="Medicine" loading="lazy">
                <h3 class="title1">Medecine</h3>
                <p>
                    The Faculty of Medicine is dedicated to educating compassionate, skilled, and knowledgeable healthcare professionals. With a strong focus on clinical training, scientific research, and public health, it plays a vital role in improving healthcare outcomes and advancing medical science.
                </p>
            </div>
        </div>
        <p class="hidden paragraph1">Our Campuses</p>
        <div class="container4">
            <div class="hidden">
                <img class="campus-image" src="../Images/campus1.png" alt="California-Campus" loading="lazy">
                <p>California-Campus</p>
            </div>
            <div class="hidden">
                <img class="campus-image" src="../Images/campus2.png" alt="New York-Campus" loading="lazy">
                <p>New York-Campus</p>
            </div>
            <div class="hidden">
                <img class="campus-image" src="../Images/campus3.png" alt="Massachusetts-Campus" loading="lazy">
                <p>Massachusetts-Campus</p>
            </div>
            <div class="hidden">
                <img class="campus-image" src="../Images/campus4.png" alt="Michigan-Campus" loading="lazy">
                <p>Michigan-Campus</p>
            </div>
        </div>
    </main>
    <?php include"../Components/Footer.php";?>
    <script src="../JavaScript/student.js"></script>
</body>
</html>