

<?php
include('phpqrcode/qrlib.php');

function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find); 
	$username = substr($email, 0, $pos);   
	return $username;
}


if(isset($_POST['first_name'])){
	$firstName = $_POST["first_name"];
	$lastName = $_POST["last_name"];
	$email = $_POST["eemail"];
	$address = $_POST["eaddress"];
	$phone = $_POST["ephone"];
	
    $tempDir = 'qrimages/'; 
	$filename = getUsernameFromEmail($email);
	$codeContents = $email;
	$fullpath=$tempDir.''.$filename.'.png'; 
   
	QRcode::png($codeContents,$fullpath);


	$conn = mysqli_connect("localhost","root","","test") or die("Connection Failed");

	$sql = "INSERT INTO students(first_name, last_name,email,address,phone,qrcode) VALUES ('{$firstName}','{$lastName}','{$email}','{$address}','{$phone}','{$fullpath}')";

	if(mysqli_query($conn, $sql)){
	  echo 1;
	}else{
	  echo 0;
	}
}
?>
