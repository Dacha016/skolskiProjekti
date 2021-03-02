<?php
$host="localhost";
$user="admin";
$password="admin123";
$db="mreza";
$conn= new mysqli($host,$user,$password,$db);
if($conn->connect_error){
    die("Error connecting to database: ". $conn->connect_error);
}
?>