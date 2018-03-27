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
      					<li class="active" ><a href="#">Purchases</a></li>
      					<li><a href="doctors.php">Doctors</a></li>
      					<li><a href="credits.php">Credits</a></li>
      		
    				</ul>

           <a href="/msa/logout.php"> <button class="btn btn-danger navbar-btn pull-right">Logout</button> </a>
    			</div>
	</nav>
<input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<table class="table" id="myTable">
    <thead>
      <tr>

        <th>Name</th>
        <th>Contact No</th>
        <th>Address</th>
        <th>Date</th>
		<th>Total</th>
		<th>Paid</th>
        <th></th>
        
        
      </tr>
    </thead>
    <tbody>
<?php

$qry="SELECT u.name,u.contact_no,u.address ,b.date,b.total,b.paid from bill b , users u where b.patient_id= '$email' and u.user_id=b.shop_id";


$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $p['name'] ?></td>    
      
        <td><?php echo $p['contact_no'] ?></td>
        <td><?php echo $p['address'] ?></td>
          <td><?php echo $p['date'] ?></td>
		    <td><?php echo $p['total'] ?></td>
			  <td><?php echo $p['paid'] ?></td>
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
