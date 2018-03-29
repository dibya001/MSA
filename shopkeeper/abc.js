$('#whatever').on('click', function() {
     /* your code here */
 	console.log('hello')	    
});

$('#whatever').click({
     /* your code here */
     console.log('hello')	
});





 
 $('#sups').typeahead({
  
 
 });





 $(document).on("typeahead","#sups",function(){

   
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
 