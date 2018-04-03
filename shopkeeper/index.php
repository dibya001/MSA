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

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
 <link href="typeaheadjs.css" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="../js/typeahead.js"></script>
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>


</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
         <div class="navbar-header">
            <a class="navbar-brand" href="shopowner.php">Shop Name</a>
          </div>
            <ul class="navbar-nav mr-auto">
                <li  class="nav-item active"><a class="nav-link"  href="#">Home</a></li>
                <li  class="nav-item"><a class="nav-link"  href="stock.php">Stock</a></li>
                <li class="nav-item"><a class="nav-link"  href="customers.php">Customer</a></li>
                <li class="nav-item"><a class="nav-link" href="doctors.php">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="bills.php">Bills</a></li>
                <li class="nav-item"><a class="nav-link" href="Prescriptions.php">Prescriptions</a></li>
            <li class=" nav-item "><a class="nav-link"  href="order.php">Order</a></li>
            </ul>

            <button  type="button" class="btn btn-danger navbar-btn pull-right" data-toggle="modal" data-target="#myModal">Logout</button> 
          </div>
  </nav>
	
<div id="myModal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <h4 class="modal-title">Logout Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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