<?php
session_start();
if(!isset($_SESSION['email'])){
header('Location:/msa/index.php');
}
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
     					  <li><a href="stock.php">Stock</a></li>
      					<li><a href="customers.php">Customer</a></li>
      					<li><a href="doctors.php">Doctors</a></li>
      					<li><a href="bills.php">Bills</a></li>
      					<li class="active"><a href="#">Prescriptions</a></li>
      	
    				</ul>

           <a href="/msa/logout.php"> <button class="btn btn-danger navbar-btn pull-right">Logout</button> </a>
  				</div>
	</nav>

</body>
