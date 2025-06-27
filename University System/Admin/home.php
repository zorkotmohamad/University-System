<?php
    require "../Database/connection.php";
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
  try{
    $sql = "SELECT major,(COUNT(student_id)*100)/(SELECT COUNT(*) FROM students) AS Percentage
            FROM students
            GROUP BY major";
    $stmt = $conn->query($sql);
    $majors = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  catch(PDOException $exception){
    echo "Error during fetch process!!! ".$exception->getMessage();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Admin/style.css">
    <link rel="stylesheet" href="../CSS/Admin/navbar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- etape 1: importer la librairie de google chart -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        //etape 2: chargement de la librarie
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        //etape 3 : implementer la fonction drawChart()
        function drawChart(){
            //etape 3: creer un objet de la classe google.visualization.DataTable()
            const data = new google.visualization.DataTable();
            //etape 4 : creer des colonnes en precisant leur type et leur nom
            data.addColumn('string','Major');
            data.addColumn('number','percentage %');
            //etape 5 : creer des lignes pour afficher les donnees de la base de donnees
            data.addRows([
                <?php
                    foreach($majors as $major){
                        echo "["."'".$major["major"]."'".",".$major["Percentage"]."],";
                    }
                ?>
            ]);
            //etape 6 : donner des caracteristiques a notre graphique (chart) comme un titre,.....
            const options = {
                title:"Percentage of each major"
            }
            //etape 7 : --creer un objet de la classe google.visualization.[preciser le type de graphe]()
            const chart = new google.visualization.ColumnChart(document.getElementById('chart'));
            chart.draw(data,options);
        }
    </script>
</head>
<body>
    <?php require "navbar.php";?>
    <main class="main">
        <div id="chart"></div>
    </main>
</body>
</html>
