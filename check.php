
<?php
require_once 'connect.php';
$email = $_POST['email'];
$qry="SELECT * from `users` where `user_id`= '".$email."'";
$r=mysqli_query($conn,$qry);

if ($r->num_rows > 0) 
{
     echo '1';
//changes in code
//changes from 2nd branch
}
else
{
      echo '0';   
}
    
?>