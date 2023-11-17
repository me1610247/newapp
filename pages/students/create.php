<?php
session_start();
include "../inc/header.php"; ?>
<?php include "../inc/nav.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Students</title>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Add New Students</h1>
        <a class="btn btn-primary text-center mb-5" href="./index.php">All Students</a>
        <?php
   if (isset($_SESSION['errors']) && is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    foreach ($_SESSION['errors'] as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    // Unset the session variable only when displaying the errors
    unset($_SESSION['errors']);
}
?>
        <?php
   if (isset($_SESSION['errorOccur']) && is_array($_SESSION['errorOccur']) && count($_SESSION['errorOccur']) > 0) {
    foreach ($_SESSION['errorOccur'] as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    // Unset the session variable only when displaying the errors
    unset($_SESSION['errorOccur']);
}
?>
        <?php
        if (isset($_SESSION["success"])){
        ?>
        <div class="alert alert-success">
            <?= $_SESSION['success'] ?>
        </div>
        <?php
        }
        unset($_SESSION["success"]);
        ?>
    <form action="../../handlers/students/store.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone</label>
    <input type="number" name="phone" class="form-control" id="exampleInputEmail1">
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
    </div>
</body>
</html>