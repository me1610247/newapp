<?php
session_start();
require_once "./request.php";
require_once "./validation.php";
require_once "../../Database.php";
if (Request::isPost()) {
    $host = "localhost";
    $username = "root";
    $passwordDb = "";
    $databaseName = "oop_app";
    $connection = new Database($host, $username, $passwordDb, $databaseName);
    $conn = $connection->connect();
    $errors = [];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email_query = "SELECT email FROM students where email='$email'";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    foreach (Request::all() as $key => $value) $$key = Validation::sanitize($value);
    function validMail($input){
        if(filter_var($input,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    if (Validation::required($_POST['name'])) {
        $errors[] = "Name is Required";
    }
    if (Validation::minVal($_POST['name'], 3) || Validation::maxVal($_POST['name'], 20)) {
        $errors[] = "Name Should be Among between 3 and 20 chars";
    }
    if (Validation::required($_POST['email'])) {
        $errors[] = "Email Is Required";
    }
    if (mysqli_num_rows($check_email_query_run) > 0) {
        $errors[] = "Email is Already Exist , Try Another One";
    }
    if(!(validMail($_POST["email"]))) {
        $errors[] = "Try a Valid Email";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("location:../../pages/students/create.php");
    } else {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => isset($_POST['phone'])? $_POST['phone'] :null,
        ];
        $insertNew = $connection->create('students', $data);
        if ($insertNew) {
        $_SESSION['success'] = "New Student Added Successfully !";
        header("location:../../pages/students/create.php");
        }else{
            $_SESSION['errorOccur']="Error When Adding New Student ";
            header("location:../../pages/students/create.php");
        }
    }
    $connection->close(); // Move the close statement inside the if block
}