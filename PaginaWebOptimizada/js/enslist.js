 function ens_list(rid){
   var action="ajax";
   var q= $("#qa").val();
     decide("activos");
    $.ajax({
         type: "POST",
         url: "./ajax/load_enslist.php",
         data: {rid:rid, action:action, q:q},
         beforeSend: function(){
             $('#enser_list').html(loadershowmini);
           },
            success:function(data){    
            $('#enser_list').html(data);  
            }
   })  
}