<?php
session_start();
include "../../Database.php";
 include "../inc/header.php";
 include "../inc/nav.php"; 
$host = "localhost";
$username = "root";
$passwordDb = "";
$databaseName = "oop_app";
$connection = new Database($host, $username, $passwordDb, $databaseName);
$conn = $connection->connect();
$students=$connection->read("students");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $student=$connection->read('students',"id=$id");
    if(!empty($student)){
        $studentData=$student[0];
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Edit Student Info</h1>
        <?php
if(isset($_SESSION['errors'])){
?>
    <div class="alert alert-danger">
        <?=$_SESSION['errors']?>
    </div>
<?php
}
unset($_SESSION['errors']);
?>
        <form action="updatestudent.php" method="POST">
    <!-- Include hidden input field for the major's ID -->
    <input type="hidden" name="student_id" value="<?php echo $id; ?>">

    <div class="card-body d-flex flex-column gap-1 justify-content-center">
        <label for="Name">Name</label>
        <input class="form-control" type="text" name="studentname" id="" placeholder="Edit Name" value="<?php echo $studentData['name']; ?>">
       <label for="">Email</label>
        <input  class="form-control"  type="text" name="studentemail" id="" placeholder="Edit Email" value="<?php echo $studentData['email']; ?>">
       <label for="">Phone</label>
        <input  class="form-control mb-5"  type="text" name="studentphone" id="" placeholder="Edit Phone" value="<?php echo $studentData['phone']; ?>">
        <input type="submit" name="Update" value="Update" class="btn btn-primary" id="">
    </div>
</form>
    </div>
</body>
</html>