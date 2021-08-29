<?php

include('db.php');

session_start();

if(isset($_SESSION["admin_id"]))
{
  header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>



<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <h2>Admin Login</h2>
    </div>

    <!-- Login Form -->
    <form method="POST" action="login.php">
      <input type="text" id="user" class="fadeIn second" name="username" required="required" autocomplete="off" placeholder="USERNAME" >
      <input type="password" id="password" class="fadeIn third" name="password"  required="required" autocomplete="off" placeholder="PASSWORD" >
      <input type="submit" name="login" class="fadeIn fourth" value="Log In">
    </form>
  </div>
</div>
</body>
</html>



<!-- code for login -->
<?php 

if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM admin WHERE username = '{$username}' && password = '{$password}'";
  $result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
  if(mysqli_num_rows($result) > 0 ){
    $_SESSION["admin_id"]=$username;
    sleep(1);
    header('location:index.php');
  }else{
    header('location:login.php');
  }

 
}
 ?>

