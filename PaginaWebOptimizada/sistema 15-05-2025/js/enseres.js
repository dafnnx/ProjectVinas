  var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
  var loadershow = '<img src="./img/vinasloader.svg" width="50%" style="margin: 0 auto;display: flex;">';


/*residente*/

      $(document).ready(function(){
         loadenseres(1);
      });

      function loadenseres(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_ense.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_res').html(loadershow);
           },
            success:function(data2){
               $("#subsea_res").html(data2).fadeIn('slow');   
            }
         })
      }  

/*residente*/

/*elminar*/
function eliminar(id, table, wich, uid){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el residente?',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Eliminar',
   showLoaderOnConfirm: true,
   preConfirm: function() {
      return new Promise(function(resolve) {
  $.ajax({
         async: true,
      type: "POST",
      url:'./saves/delete.php',
      data: {id_id:id, table:table, wich:wich},
  })
  .done(function(response){
     swal.fire('Eliminado!', response.message, response.status);
     loadenseres(uid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

/*elminar*/