<?php
session_start();

if(isset($_SESSION['email'])){

$email=$_SESSION['email'];
$t=$_SESSION['usertype'];

$page=null;
			if ($t==1)
			$page="shopkeeper/shopowner.php";
			else if ($t==2)
				$page="patient/index.php";
			else if ($t==3)
				$page="doctor.php";
			else if($t==4)
				$page="supplier.php";
			
			header("Location: ".$page); 
		
}
else {
	header("Location:index.php");

}




?>
