<?php
session_start();
require_once "../../handlers/students/request.php";
require_once "../../handlers/students/validation.php";
require_once "../../Database.php";
$host = "localhost";
$username = "root";
$passwordDb = "";
$databaseName = "oop_app";
$connection = new Database($host, $username, $passwordDb, $databaseName);
$conn = $connection->connect();
$students=$connection->read("students");
if (Request::isPost()&&isset($_POST['Update'])) {
    $student_id=$_POST['student_id'];
    $student_name=$_POST['studentname'];
    $student_email=$_POST['studentemail'];
    $student_phone=$_POST['studentphone'];
    $email = mysqli_real_escape_string($conn, $_POST['studentemail']);
    $check_email_query = "SELECT email FROM students where email='$email'";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    function validMail($input){
        if(filter_var($input,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    if (Validation::required($_POST['studentname'])) {
        $errors[] = "Name is Required";
    }
    if (Validation::minVal($_POST['studentname'], 3) || Validation::maxVal($_POST['studentname'], 20)) {
        $errors[] = "Name Should be Among between 3 and 20 chars";
    }
    if (Validation::required($_POST['studentemail'])) {
        $errors[] = "Email Is Required";
    }
    if (mysqli_num_rows($check_email_query_run) > 0) {
        $errors[] = "Email is Already Exist , Try Another One";
    }
    if(!(validMail($_POST["studentemail"]))) {
        $errors[] = "Try a Valid Email";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("location:./editstd.php");
    }else{
    $data=[
        'name'=> $student_name,
        'email'=> $student_email,
        'phone'=> $student_phone
    ];
    $result = $connection->update('students', $data, "id = $student_id");
    if ($result) {
        // Major updated successfully
        $_SESSION["updated"] = "Student Update Successfully";
        header("Location:index.php");
        exit;
    } else {
        // Major update failed
        echo "Failed to update major.";
    }
}
}
