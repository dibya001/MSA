<?php
require('../connect.php');
session_start();
if(!isset($_SESSION['email'])){
header('Location:/msa/index.php');

}
$email=$_SESSION["email"];
?>


<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/typeahead.js"></script>
</head>

<body>
	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
   			 <div class="navbar-header">
      			<a class="navbar-brand" href="shopowner.php">Shop Name</a>
    			</div>
    				<ul class="nav navbar-nav">
      					<li><a href="index.php">Home</a></li>
     					  <li ><a href="stock.php">Stock</a></li>
      					<li><a href="customers.php">Customer</a></li>
      					<li><a href="doctors.php">Doctors</a></li>
      					<li><a href="bills.php">Bills</a></li>
      					<li><a href="Prescriptions.php">Prescriptions</a></li>
						<li class="active"><a href="#">Order</a></li>
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
 <form class="form" id="myForm">
 <div class="form-group">
 <div class="col-md-6 col-md-offset-3">
	<input type="text" name="meds" id="meds" tabindex="1" class="form-control input-sm" placeholder="Enter medicine name" autocomplete="off">
  <br>
	 <input type="text" name="quantity" id="qty" tabindex="1" class="form-control input-sm"  placeholder="Quantity" >
   <br>
     <input type="text" name="sups" id="sups" tabindex="1" class="form-control input-sm" placeholder="Enter supplier name" autocomplete="off">
     <br>
  
        <button type="button" tabindex="1" class=" text-center mt-4 indigo btn btn-primary center-block" id="addrow">Go</button>
    </div>


 </div>
 </form>
<br/>
<table id="olist" class="table table-bordered table-striped table-hover" >
  <thead  >
  <th class="text-center">Medicine Id</th>
    <th class="text-center">Medicine Name</th>
    <th class="text-center">Quantity</th>

  </thead>
  <tbody id="o_body"></tbody>
</table>

<div>

<button type="button" tabindex="1" class=" text-center mt-4 indigo btn btn-primary center-block" id="fetch" onclick="fetchmeds()">Place Order</button>
 </div>

                      
                      
</body>
<script type="text/javascript">

 var medicine_id="a";
var sendobj={};
//var pd=-1;
$(document).ready(function(){
  var i=1;
  $("#addrow").click(function(){
  //alert('hi');
    var med_name=$('#meds').val();
    //var words = str.split(" ");
    //var med_name=words[1];
    var qt=$('#qty').val();
    if (qt=="")
    {
      alert('Please Fill Some Quantity');
    }
    else
    {
      $('#olist').append('<tr id="addr'+(i)+'"></tr>');
      $('#addr'+i).html("<td>"+medicine_id+"</td><td>"+med_name+ "</td><td>"+qt+ "</td>");
      i++; 
      var form = document.getElementById("myForm");
      form.reset();
    }

  });
 
 $('#meds').typeahead({
	
  source: function(query, result)
  {
   $.ajax({
    url:"fetch_meds.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
      //var d2=JSON.parse(data)
      //alert(d2);
     result($.map(data, function(item){
      //pd=d2.product_id
      //medicine_id=item['name']
      return item;
     }));
    }
   })
  }

 });

$('#meds').change(function() {
  var current = $('#meds').typeahead("getActive");
   medicine_id=current['product_id'];
});
 
});


function fetchmeds()
{
	var med_name=$('#meds').val();
  var sup_name=$('#sups').val()
	var qt=$('#qty').val();
  jsonarr=[]
  var table = document.getElementById("olist");
  for (var i = 1, row; row = table.rows[i]; i++) 
  {
      pd=table.rows[i].cells[0].innerHTML;
      qt=table.rows[i].cells[2].innerHTML;
      obj={};
      obj["pid"]=pd; 
      obj["qty"]=qt;
      jsonarr.push(obj);  
  }
   sendobj["meds"]=JSON.stringify(jsonarr);
   sendobj["status"]="1";
   sendobj["sup"]="for_testing";
   var sendobj2=JSON.stringify(sendobj);
    //alert(sendobj2);
    $.ajax({
    url:"orderplace.php",
    method:"POST",
    data:{query:sendobj2},
    dataType:"json",
    success:function(data)
    {
      alert('Order Placed Successfully');
    }
   })

	
}
 $('#sups').typeahead({
  
  source: function(query, result)
  {
   $.ajax({
    url:"fetch_sups.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
</script>

<style>

.dropdown-menu {
 position:relative;
 width:100%;
 top: 0px !important;
    left: 0px !important;
}
</style>