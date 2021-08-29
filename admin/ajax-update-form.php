<?php

$student_id = $_POST["id"];
$firstName = $_POST["first_name"];
$lastName = $_POST["last_name"];
$email = $_POST["eemail"];
$address = $_POST["eaddress"];
$phone = $_POST["ephone"];


$conn = mysqli_connect("localhost","root","","test") or die("Connection Failed");

$sql = "UPDATE students SET first_name = '{$firstName}',last_name = '{$lastName}',email = '{$email}' ,address = '{$address}' ,phone = '{$phone}'  WHERE id = {$student_id}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
