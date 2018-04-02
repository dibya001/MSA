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
     					  <li class="active"><a href="#">Stock</a></li>
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


<div id="orderModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Confirmation</h4>
      </div>
      <div class="modal-body" id="modal-body">
        <p id="txt">Please Select Some items</p>
        <input type="text" name="sups" id="sups" tabindex="1" class="form-control input-sm" placeholder="Enter supplier name" autocomplete="off">
          <br/>
               <button type="button" class="btn btn-primary" id="f3" onclick="choose_sup()">Choose Supplier</button>
      

      </div>
      <div class="modal-footer">
       <button type="button" id="ok" class="btn btn-success"  data-dismiss="modal" onclick="place_order()">Confirm Order</button></a>
		<button type="button" id="cancel" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>	



<input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <script>

  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>
<table class="table" id="myTable">
    <thead>
      <tr>

        <th>Product Id</th>
        <th>Product Name</th>
        <th>Batch No.</th>
        <th>Quanity</th>
        <th>Order</th>
		<th>Order Amount</th>
	
        
        
      </tr>
    </thead>
    <tbody id="tbody">
<?php

$qry="SELECT s.product_id,m.name,s.batch_id,s.quantity from stock s ,medicine m where s.shop_id= '$email' and s.product_id=m.product_id";


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
        <td><input  type="checkbox" class="check" id="<?php echo "c".$var; ?>"></td>
		<td><input disabled type="text" id="<?php echo "q".$var; ?>"></td>
		    
      

      </tr>




    <?php
    $var=$var+1;
  }

} 


?>



    </tbody>
  </table>
  <center> 
	<button class="btn btn-primary btn-lg" id="order"  >order now</button>
 </center>
</body>

<script>
var sendobj={};
//var sup_name="";
$(".check").change(function() {
    if(this.checked) {
     
	   var id=(this.id).replace('c','q');
	   //alert(id);
	   document.getElementById(id).removeAttribute("disabled");
	   
    }
});

$("#order").click(function()  {

		var selected = [];
		$('input.check:checkbox:checked').each(function() {
				selected.push($(this).attr('id'));
			});
		//console.log(selected[0]);
		jsonarr=[]
		for (var i = 0; i < selected.length; i++) {
			it=selected[i].replace('c','q');
			qt=document.getElementById(it).value;
			iz=selected[i].replace('c','');
			pd=document.getElementById('myTable').rows[iz].cells[0].innerHTML;
			//console.log(qt);
			//console.log(pid);
      obj={};
      obj["pid"]=pd;
      obj["qty"]=qt;
      jsonarr.push(obj);
			

		}
   sendobj["meds"]=JSON.stringify(jsonarr);
   sendobj["status"]="1";
    //sendobj.meds=jsonarr;
		//console.log(jsonarr);
		if (selected.length == 0){
      $('#txt').css('visibility', 'visible');
      $('#sups').css('visibility', 'hidden');
      $('#f3').css('visibility', 'hidden');
			$('#ok').css('visibility', 'hidden');
			$('#orderModal').modal('show')
		}	
		else{
      $('#txt').css('visibility', 'hidden');
      $('#sups').css('visibility', 'visible');
      $('#f3').css('visibility', 'visible');
			$('#ok').css('visibility', 'visible');
			$('#orderModal').modal('show')
		}
		
		
	}); 
	

$(document).ready(function(){
 
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
 
});

function choose_sup()
{
  sup_name=$('#sups').val();
  //console.log(sup_name);
  sendobj["sup"]=sup_name;
  
}

function place_order()
{

  //console.log(sendobj.meds[0].pid);
   //console.log(sendobj.meds[0].qty);
   var sendobj2=JSON.stringify(sendobj);
    //alert(sendobj2);
    $.ajax({
    url:"orderplace.php",
    method:"POST",
    data:{query:sendobj2},
    dataType:"json",
    success:function(data)
    {
    }
   })

  
}

</script>



<style>

.dropdown-menu {
 position:relative;
 width:100%;
 top: 0px !important;
    left: 0px !important;
}
</style>
