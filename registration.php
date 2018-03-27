<?php
require_once 'connect.php';
session_start();
$name=$_POST["name"];
$password=$_POST["password"];
$email=$_POST["email"];
$address=$_POST["address"];
$contact=$_POST["contact"];
$usertype=(int)$_POST["usertype"];
$dte=date("Y/m/d");
echo $usertype;

//$qry="insert into users values('','".$email."','".$password."','".$name."',".$usertype.",'".$address."','".$contact."','".$date."')";


$qry="INSERT INTO `users` VALUES (NULL, '".$email."', '".$password."', '".$name."', '".$usertype."', '".$address."', '".$contact."', '".$dte."')";
//echo $qry;

if (mysqli_query($conn,$qry))
{
	//echo "data  inserted successfully";
	$t=$usertype;
	$_SESSION['email']=$row["email"];
	$_SESSION['usertype']=$t;
	$page=null;
	if ($t==1)
		$page="shopowner.php";
			else if ($t==2)
				$page="patient.php";
			else if ($t==3)
				$page="doctor.php";
			else 
				$page="supplier.php";
			
			header("Location: ".$page); 
			exit;
}
else
{
	echo "error occured";
}

?>