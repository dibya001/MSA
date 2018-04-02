<?php
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:/msa/index.php');
}
?>

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/t2.js"></script>

</head>

<body>
  
  <nav class="navbar navbar-inverse">
      <div class="container-fluid">
         <div class="navbar-header">
            <a class="navbar-brand" href="#">Shop Name</a>
          </div>
            <ul class="nav navbar-nav">

                <li class="active"><a href="#">Home</a></li>
              <li><a href="stock.php">Stock</a></li>
                <li><a href="customers.php">Customer</a></li>
                <li><a href="doctors.php">Doctors</a></li>
                <li><a href="bills.php">Bills</a></li>
                <li><a href="Prescriptions.php">Prescriptions</a></li>
				<li><a href="order.php">Order</a></li>
        
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


  <input type="text" name="name" id="p_name" tabindex="1" class=" form-control input-sm" placeholder="Enter medicine name" autocomplete="off">

  <input type="text" name="p_address" id="p_address" tabindex="1" class="form-control input-sm" placeholder="Enter medicine name" autocomplete="off">


</body>



<script type="text/javascript">
var sendobj={};
var pd=-1;
$(document).ready(function(){
 
  name: 'name',
 $('#p_name').typeahead({
  
   remote: {
      url: 'ajaxphp/fetch_customer_details.php?q=%QUERY',
  dataType: 'json',
      cache: false,
      filter: function(parsedResponse){
          return (parsedResponse.length > 1) ? parsedResponse[1] : [] ;
      }
    }
  });

});

</script>
