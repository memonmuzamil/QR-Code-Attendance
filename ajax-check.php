<?php 
date_default_timezone_set("Asia/Karachi");
$currentTime = date("h:i:sa");
$currentDate = date("Y/m/d");
if(isset($_POST['email'])){
	$email= $_POST['email'];
	$conn = mysqli_connect("localhost","root","","test") or die("Connection Failed");
	$sql = "SELECT * FROM students where email = '{$email}'";
	$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
	if(mysqli_num_rows($result) > 0 ){
		while($row = mysqli_fetch_assoc($result)){
			$id=$row['id'];
			$name=$row['first_name'];
		}
		$sql = "SELECT * FROM attendance where emp_id = {$id} && status = 1";
		$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
		if(mysqli_num_rows($result) > 0 ){
			$sql = "UPDATE attendance SET exit_date = '{$currentDate}',	exit_time = '{$currentTime}',	status = 0 where emp_id = {$id} && status = 1";
			if(mysqli_query($conn, $sql)){
  				echo "<div class='alert alert-success'>
      					<li> Bye ".$name."</li></div>";
			}else{
  				echo "<div class='alert alert-danger'>
      					<li>".$name." Please Try Again</li></div>";
			}
		}else{
			$sql = "INSERT INTO attendance(emp_id,entry_date,entry_time,status) VALUES ({$id},'{$currentDate}','{$currentTime}',1)";
			if(mysqli_query($conn, $sql)){
	  				echo "<div class='alert alert-success'>
      					<li> Welcome! ".$name."</li></div>";
			}else{
	 			 echo "<div class='alert alert-danger'>
      					<li>Please Try Again</li></div>";
			}
		}
	}else{
		echo "<div class='alert alert-danger'>
      			<li>QR MISMATCH! Please Try Again</li></div>";
	}
}
 ?>