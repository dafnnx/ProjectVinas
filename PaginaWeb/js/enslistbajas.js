 function ens_list_bajas(rid){
   var action="ajax";
   var q= $("#qb").val();
     decide("bajas");
    $.ajax({
         type: "POST",
         url: "./ajax/load_enslistbajas.php",
         data: {rid:rid, action:action, q:q},
         beforeSend: function(){
             $('#enser_list').html(loadershowmini);
           },
            success:function(data){    
            $('#enser_list').html(data);  
            }
   })  
}