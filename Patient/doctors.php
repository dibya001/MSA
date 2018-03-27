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
      					<li><a href="index.php">Purchases</a></li>
      					<li  class="active"><a href="#">Doctors</a></li>
      					<li><a href="credits.php">Credits</a></li>
      		
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
        <th>Date</th>
		
        
        
      </tr>
    </thead>
    <tbody>
<?php

$qry="SELECT u.name,p.doctor_id,u.contact_no,u.address ,p.date from patient p , users u where p.patient_id= '$email' and u.user_id=p.doctor_id";


$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $p['name'] ?></td>    
        <td><?php echo $p['doctor_id'] ?></td>
        <td><?php echo $p['contact_no'] ?></td>
        <td><?php echo $p['address'] ?></td>
          <td><?php echo $p['date'] ?></td>
          <td><a href="patientDetails.php?patient_id=<?php echo $p['patient_id']; ?> "><input type="button" class="btn btn-primary pull-right" value="View" ></a>
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
