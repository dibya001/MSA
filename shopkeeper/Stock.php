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
      			<a class="navbar-brand" href="shopowner.php">Shop Name</a>
    			</div>
    				<ul class="nav navbar-nav">
      					<li><a href="shopowner.php">Home</a></li>
     					  <li class="active"><a href="#">Stock</a></li>
      					<li><a href="customers.php">Customer</a></li>
      					<li><a href="doctors.php">Doctors</a></li>
      					<li><a href="bills.php">Bills</a></li>
      					<li><a href="Prescriptions.php">Prescriptions</a></li>
      	
    				</ul>

            <button  type="button" class="btn btn-danger navbar-btn pull-right" data-toggle="modal" data-target="#myModal">Logout</button> 
    			</div>
	</nav>
	
	
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Logout Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you surely want to logout?.</p>
      </div>
      <div class="modal-footer">
       <a href="/msa/logout.php"> <button type="button" class="btn btn-default" >Confirm</button></a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>	
<table class="table" id="myTable">
    <thead>
      <tr>

        <th>Product Id</th>
        <th>Product Name</th>
        <th>Batch No.</th>
        <th>Quanity</th>
        <th></th>
        
        
      </tr>
    </thead>
    <tbody id="tbody">
<?php

$qry="SELECT s.product_id,m.name,s.batch_id,s.quantity from stock s ,medicine m where s.shop_id= '$email'";


$r=mysqli_query($conn,$qry);


if ($r->num_rows > 0) 
{
   
   $var=1;
while($p = mysqli_fetch_assoc($r)) {
    
    ?>
          <tr class="active">
        <td><?php echo $p['product_id'] ?></td>    
        <td><?php echo $p['name'] ?></td>
        <td><?php echo $p['batch_id'] ?></td>
        <td><?php echo $p['quantity'] ?></td>
          <td><a href="patientDetails.php?product_id=<?php echo $p['product_id']; ?> "><input type="button" class="btn btn-primary pull-right" value="Order" ></a>
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
