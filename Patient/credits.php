<?php

require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:/msa/index.php');

}

$email=$_SESSION["email"];

?>
<head>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>

<body>
	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
   			 <div class="navbar-header">
      		
    			</div>
    				<ul class="nav navbar-nav">
      					<li ><a href="index.php">Purchases</a></li>
      					<li><a href="doctors.php">Doctors</a></li>
      					<li class="active" ><a href="#">Credits</a></li>
      		
    				</ul>

           <a href="/msa/logout.php"> <button class="btn btn-danger navbar-btn pull-right">Logout</button> </a>
    			</div>
	</nav>

  


<table class="table" id="myTable">
    <thead>
      <tr>

        <th>Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>Address</th>
        <th>Credit</th>
        
        
        
      </tr>
    </thead>
    <tbody>
<?php

$qry="SELECT u.name,p.shop_id,u.contact_no,u.address ,( SUM(p.total)-SUM(p.paid) )as credit from patient p , users u where p.patient_id= '$email' and u.user_id=p.shop_id group by p.shop_id";


$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($z = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $z['name'] ?></td>    
        <td><?php echo $z['shop_id'] ?></td>
        <td><?php echo $z['contact_no'] ?></td>
        <td><?php echo $z['address'] ?></td>
          <td><?php echo $z['credit'] ?></td>
      
          </td>
      

      </tr>




    <?php
    $var=$var+1;
  }

} 


?>



    </tbody>
  </table>


</body>
