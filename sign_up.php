<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'partials/dbconnect.php';

  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $usertype = $_POST['usertype'];
  //$exist=false;

  // to check weather the username exist or not
  $exitSql = "SELECT *FROM `user` WHERE 'username'";
  $result = mysqli_query($conn, $exitSql);
  $numExistRows = mysqli_num_rows($result);
  if ($numExistRows > 0) {
    $showError = "Username alredy exists";
  } else {
    //$exists=false;
    if (($password == $cpassword)) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `user` ( `username`, `password`, `usertype` ,  `dte`) VALUES ('$username', '$hash', current_timestamp(), '$usertype')";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
      }
    } else {
      $showError = "Password does not match or username already exist";
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>SignUp</title>
</head>

<body>
  <?php require 'partials/_nav.php' ?>
  <?php
  if ($showAlert) {
    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <strong>Sign_Up Successful</strong> You can do login now
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Incorrect Password!</strong>' . $showError . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>
  <div class="container">
    <h1 class="text-center">SignUp to our website</h1>
    <br>
    <br>
    <form action="/Project_01/sign_up.php" method="post" style="display: flex; flex-direction: column;align-items: center;">
      <div class="form-group col-md-6">
        <label for="username">username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter username">

      </div>
      <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" maxlength="8" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="form-group col-md-6">
        <label for="password">Confirm-Password</label>
        <input type="password" maxlength="8" class="form-control" id="cpassword" name="cpassword" placeholder="Password">
        <small id="cpassword" class="form-text text-muted">Make sure to type the same password</small>
      </div>
      <div class="form-group col-md-6">
        <label for="password">User Type</label>
        <input type="number" maxlength="1" class="form-control" id="usertype" name="usertype" placeholder="Enter 1 for Restaurant and 2 for Customer">
      </div>
      <button type="submit" class="btn btn-primary col-md-6">SignUp</button>
    </form>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>