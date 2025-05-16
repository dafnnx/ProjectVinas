$( "#checkgral" ).click(function() {
    var tgtrid= $("#tgtrid").val();
    var ids_array = [];
      $("input:checkbox[class=thecheckgralt]:checked").each(function () {
        ids_array.push($(this).val());
      }); 
if (ids_array.length>0) {



swal.fire({
   icon: 'warning',
   title: 'Indica los siguientes datos?',
   html: `
    <input id="mot" placeholder="motivo" class="swal2-input">
    <input id="per" placeholder="persona" class="swal2-input">
  `,
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Aceptar',
   showLoaderOnConfirm: true,
   preConfirm: function() {
    var mot=document.getElementById("mot").value;
      var per=document.getElementById("per").value;

if (mot && per) {

      return new Promise(function(resolve) {

      
  $.ajax({
         async: true,
      type: "POST",
      url:'./saves/bajaresis.php',
      data: {ids_array:ids_array, tgtrid:tgtrid, mot:mot, per:per},
  })
  .done(function(response){
     swal.fire('Procesando!', response.message, response.status);
     ens_list(tgtrid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });


      });
   
}
   },
   allowOutsideClick: false     
   }); 



    }     
    }); 


$( "#checkgralbajas" ).click(function() {
    var tgtrid= $("#tgtrid").val();
    var ids_array = [];
      $("input:checkbox[class=thecheckgraltbajas]:checked").each(function () {
        ids_array.push($(this).val());
      }); 
if (ids_array.length>0) {



swal.fire({
   icon: 'warning',
   title: 'Indica los siguientes datos?',
   html: `
    <input id="mot" placeholder="motivo" class="swal2-input">
    <input id="per" placeholder="persona" class="swal2-input">
  `,
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Aceptar',
   showLoaderOnConfirm: true,
   preConfirm: function() {
    var mot=document.getElementById("mot").value;
      var per=document.getElementById("per").value;

if (mot && per) {

      return new Promise(function(resolve) {

      
  $.ajax({
         async: true,
      type: "POST",
      url:'./saves/activoresis.php',
      data: {ids_array:ids_array, tgtrid:tgtrid, mot:mot, per:per},
  })
  .done(function(response){
     swal.fire('Procesando!', response.message, response.status);
     ens_list_bajas(tgtrid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });


      });
   
}
   },
   allowOutsideClick: false     
   }); 



    }     
    }); 

/*
$("#ascgral, #descgral").on("click", function() {
  var sort=this.id;
  $.ajax({
        type: "POST",
        url:'./ajax/buscar_clientes.php',
        data: {sort:sort},
        success:function(data2){
          $(".dats").html(data2).fadeIn('slow');      
        }
      })
});
*/