<?php
session_start();
require_once '../../app/bootstrap.php' ?>
<?php include "../inc/header.php"; ?>
<?php include "../inc/nav.php"; ?>
<?php
include "../../Database.php";
$host = "localhost";
$username = "root";
$passwordDb = "";
$databaseName = "oop_app";
$connection = new Database($host, $username, $passwordDb, $databaseName);
$conn = $connection->connect();
$students=$connection->read("students");
?>
<div class="container">
<h1 class="text-center">All Students</h1>
<?php
if(isset($_SESSION['deleted'])){
?>
    <div class="alert alert-warning">
        <?=$_SESSION['deleted']?>
    </div>
<?php
}
unset($_SESSION['deleted']);
?>
<?php
if(isset($_SESSION['updated'])){
?>
    <div class="alert alert-info">
        <?=$_SESSION['updated']?>
    </div>
<?php
}
unset($_SESSION['updated']);
?>
<a class="btn btn-primary mb-5" href="./create.php">Add New Students</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone (if exist)</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
  if (empty($students)) {
        // Display an alert for no bookings within a table row
        echo '<tr><td colspan="7" class="alert alert-warning text-center">No Students Found .</td></tr>';
    } else {
        foreach ($students as $key => $student) {
            ?>
    <tr>
      <th scope="row"><?=$key+1?></th>
      <td><?=$student['name']?></td>
      <td><?=$student['email']?></td>
      <td><?=$student['phone']?></td>
      <td>
        <a class="btn btn-primary" href="editstd.php?id=<?=$student['id']?>">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" href="deletestd.php?id=<?=$student['id']?>">Delete</a>
      </td>
    </tr>
    <?php
    }
}
    ?>
  </tbody>
</table>
</div>
<?php
include "../inc/footer.php";
?>