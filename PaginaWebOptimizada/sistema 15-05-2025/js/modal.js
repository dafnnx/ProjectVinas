  function mdl(msta, mclo){
var span = document.getElementById(mclo);
msta.style.display = "block";
span.onclick = function() {
  msta.style.display = "none";
}
}

  function mdled(msta, mclo){
var span = document.getElementById(mclo);
msta.style.display = "block";
span.onclick = function() {
  msta.style.display = "none";
}
}

function addxale(idr, mode){
  var aleid = document.getElementById("ale").value;
  if (!idr) {    var idr= $("#resic_id").val();  }
$.ajax({
      type: "POST",
      url: "./saves/check_res"+mode+".php",
      data: {idr:idr, ida:aleid},
        success:function(data){ 
if (data==0) {
$.ajax({
      type: "POST",
      url: "./saves/add_"+mode+".php",
      data: {idr:idr, ida:aleid},
        success:function(){     
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1500
          })  
    load_rales(idr);      
        }
  }) 
   event.preventDefault();
                    }
else{
Swal.fire({
            icon: 'info',
            title: 'Ya existe',
            showConfirmButton: false,
            timer: 2000
          })
}
        }
   })    
}

function addxpat(idr, mode){
  var patid = document.getElementById("pat").value;
  if (!idr) {    var idr= $("#resic_id").val();  }
$.ajax({
      type: "POST",
      url: "./saves/check_res"+mode+".php",
      data: {idr:idr, ida:patid},
        success:function(data){ 
if (data==0) {
$.ajax({
      type: "POST",
      url: "./saves/add_"+mode+".php",
      data: {idr:idr, idp:patid},
        success:function(){     
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1500
          })  
    load_rpats(idr);      
        }
  }) 
   event.preventDefault();
                    }
else{
Swal.fire({
            icon: 'info',
            title: 'Ya existe',
            showConfirmButton: false,
            timer: 2000
          })
}
        }
   })    
}


 function load_rales(idr){
    $.ajax({
         type: "POST",
         url: "./ajax/load_rales.php",
         data: {idr:idr},
            success:function(data){    
            $('#res_alelist').html(data); 
            }
   })  
    event.preventDefault();
}

 function load_rpats(idr){
    $.ajax({
         type: "POST",
         url: "./ajax/load_rpats.php",
         data: {idr:idr},
            success:function(data){    
            $('#res_patlist').html(data); 
            }
   })  
    event.preventDefault();
}


function eliminar_ale(id, table, wich, idr){
   swal.fire({
   icon: 'warning',
   title: 'Quitar la alergia de la lista del residente?',
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
     load_rales(idr);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}


function eliminar_pat(id, table, wich, idr){
   swal.fire({
   icon: 'warning',
   title: 'Quitar la patología de la lista del residente?',
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
     load_rpats(idr);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}
