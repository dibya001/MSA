<?php
require('../connect.php');
session_start();
$email=$_SESSION["email"];

$qry="SELECT p.patient_id,u.contact_no,u.address ,( SUM(p.total)-SUM(p.paid) )as credit from patient p , users u where p.shop_id= '$email' and u.user_id=p.patient_id group by p.patient_id";


$r=mysqli_query($conn,$qry);
 $rows = array();


if ($r->num_rows > 0) 
{
   
while($p = mysqli_fetch_assoc($r)) {
    $rows[] = $p;
}
print json_encode($rows);

} 


else 
{
		//header("Location: Index.php"); 
		//exit;
}


?>
