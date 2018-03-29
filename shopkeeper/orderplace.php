<?php
require('../connect.php');
session_start();
$email=$_SESSION['email'];
$data =$_POST["query"];


$dt=json_decode($data);

$su=$dt->sup;
$qry="INSERT INTO `orders` VALUES (NULL, '".$email."', '".$su."', 'date')";
if(mysqli_query($conn,$qry))
{
	$last_id=mysqli_insert_id($conn);
	$med=$dt->meds;
	$md=json_decode($med);
	for($i=0;$i<sizeof($md);$i++)
	{
		$pi=$md[$i]->pid;
		$qt=$md[$i]->qty;
		$qr2="INSERT INTO `ordered_medicine` VALUES (NULL, '".$last_id."', '".$pi."', '".$qt."')";
		if(mysqli_query($conn,$qr2))
		{

		}
		else
		{
			echo "failed here";
			break;
		}
	
	}
	echo "success"; 
}
else
{
	echo  "failed";
}



?>

