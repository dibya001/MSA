<?php
require_once 'connect.php';
session_start();
$password=$_POST["password"];
$email=$_POST["email"];


//$qry="insert into users values('','".$email."','".$password."','".$name."',".$usertype.",'".$address."','".$contact."','".$date."')";


$qry="SELECT * from `users` where `email`= '".$email."' and `password`= '".$password."'";
//echo $qry;
$r=mysqli_query($conn,$qry);

if ($r->num_rows > 0) 
{
    while($row = $r->fetch_assoc())
		{
			$t=$row["usertype"];
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
			//echo $row["usertype"];
		}
} 
else 
{
		$_SESSION['error'] = 'Your username or password was incorrect.';
		header("Location: Index.php"); 
		exit;
}
$conn->close();

?>