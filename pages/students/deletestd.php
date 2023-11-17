<?php
session_start();
include "../../Database.php";
$host = "localhost";
$username = "root";
$passwordDb = "";
$databaseName = "oop_app";
$connection = new Database($host, $username, $passwordDb, $databaseName);
$conn = $connection->connect();
$students=$connection->read("students");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $deleteStd=$connection->delete('students',"id=$id");
    if($deleteStd){
        $_SESSION['deleted']="Student Deleted Successfully";
        header("location:index.php");
    }
}