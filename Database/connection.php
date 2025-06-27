<?php
$server="localhost";
$dbname="university";
$password="";
$user="root";
try{
    $conn = new PDO("mysql:host=$server;dbname=$dbname",$user,$password);
}
catch(PDOException $error){
    echo "Connection failed ".$error->getMessage();
}