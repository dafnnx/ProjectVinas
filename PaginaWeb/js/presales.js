var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
var loadershow = '<img src="./img/vinasloader.svg" width="30%" style="margin: 0 auto;display: flex;">';


$(document).ready(function(){
         load(1);
      });

      function load(){
         var action="ajax";
         var q= $("#q").val();
         var uid= $("#uid_note").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/load_presales.php',
            data: {action:action, q:q, uid:uid},
             beforeSend: function(objeto){
             $('#subsea_nota').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_nota").html(data2).fadeIn('slow');   
            }
         })
      }  

function save_notamed() {
 var motivo = $('#motivo').val(); 
 var explo = $('#explo').val();
 var notmed = $('#notmed').val(); 
 var trata = $('#trata').val(); 
if (motivo && explo && notmed && trata) {
  $('#savenotamed').attr("disabled", true);
 var parametros = $('#selnotamed').find('select, textarea, input').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/save_notamed.php",
            data: parametros,
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                    $('#selnotamed').find(':text,.tarea95new,#id_medic').val("");
                $('#savenotamed').attr("disabled", false);
                }
    })  
     event.preventDefault();
} else{
    Swal.fire({
                    icon: 'error',
                    title: 'Campos obligatorios: Motivo, Exploración, Nota, Tratamiento',
                    showConfirmButton: false,
                    timer: 2500
                    })
}   }

async function showpres(uid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_presales.php',
         data: {uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }



   /* edit */ 

function eco_live_up(idc, chng, newval, table, tgt, nom){
if (nom!==newval) {
  $.ajax({
      type: "POST",
      url: "./saves/update_field.php",
      data: {id:idc, chng:chng, newval:newval, table:table, tgt:tgt},
        success:function(){      
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1500,
          })        
        }
         }) 
}
else  {  }
}

/* edit */ 

function showhide(con, mont, mode, rid){
switch(mode) {
  case "cons":
    $("#"+con).show();
    $("#"+mont).hide();
    break;
  case "mens":
    $("#"+con).show();
    $("#"+mont).hide();
    loadexpes(rid);
    break;
  default:
}   }

 function loadexpes(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_expedientes.php",
         data: {rid:rid},
         beforeSend: function(objeto){
             $('#resiexpes').html(loadershowmini);
           },
            success:function(data){    
            $('#resiexpes').html(data);   
            }
   })  
    event.preventDefault();
}

/*modal*/
  function mdlnote(msta, mclo, idnote){
var span = document.getElementById(mclo);
msta.style.display = "block";
span.onclick = function() {
  msta.style.display = "none";
}
loadnota(idnote);
}
/*modal*/


 function loadnota(idnote){
    $.ajax({
         type: "POST",
         url: "./ajax/load_nota.php",
         data: {idnote:idnote},
         beforeSend: function(objeto){
             $('#info_nota').html(loadershowmini);
           },
            success:function(data){    
            $('#info_nota').html(data);   
            }
   })  
    event.preventDefault();
}

function calc(id, val, idm, qty, ivm){ 
if (ivm) { 
    var stot=parseInt(val) * (qty);  
    var imp=parseInt(stot) * (ivm / 100);     
    var totimp= stot+imp;
    var totimps=Number.parseFloat(imp).toFixed(2);
    var totfin=Number.parseFloat(totimp).toFixed(2);

    $("#"+id+"-tiva").val(totimps);
    $("#"+id+"-tot").val(totfin); 
} else {
    var stot=parseInt(val) * (qty);      
    var totfin=Number.parseFloat(stot).toFixed(2);
    $("#"+id+"-tot").val(totfin); 
}                    
}

/*
function calc(id, val, idm, qty, ivm){
 $.ajax({
         type: "POST",
         url: "./ajax/check_iva.php",
         data: {idm:idm},
            success:function(data){                
                var imp=parseInt(val) * (data / 100);
                    var totimp= imp*qty;
                    var tot= val*qty;
                $("#"+id+"-tiva").val(totimp);
                $("#"+id+"-tot").val(tot+totimp);
            }
   })  
    
}
*/


function delpool (id, sid, uid, idr){
            $.ajax({
            async: true,
            type: "POST",
            url:'./saves/deletepool.php',
            data: {id:id},
            beforeSend: function(objeto){
                 $('#subsea_nota').html(loadershowmini);
              },
              success:function(data2){
                    dets(sid, uid, idr);
                }
                });
    }

/* detalles */
    
async function dets(sid, uid, idr){
      $.ajax({
      type: "POST",
      url: './ajax/presale_dets.php',
      data: {sid:sid, uid:uid, idr:idr},
         async: true, 
         beforeSend: function(objeto){
            $('#subsea_nota').html(loadershow);
         },
            success: function(datos){
            $("#subsea_nota").html(datos).delay(4000).fadeIn();
         }
      });
   } 

/* detalles */

function add(sid, uid, idr, idcp, qty){
    var price= $("#"+idcp).val();
    var tot= price*qty;
    var iva= $("#"+idcp+"-tiva").val();
    var gtot= $("#"+idcp+"-tot").val();
        if (tot && gtot) {

    $.ajax({
            async: true,
            type: "POST",
            url:'./saves/update_prepay.php',
            data: {idcp:idcp, tot:tot, iva:iva},
            beforeSend: function(objeto){
                 $('#subsea_nota').html(loadershowmini);
              },
              success:function(data2){
                Swal.fire({
                icon: 'success',
                title: 'Correcto',
                showConfirmButton: true,
                confirmButtonColor: 'rgb(0 99 140)',
                    })
                dets(sid, uid, idr);        
                }               
                })

    }   else{
            Swal.fire({
                icon: 'error',
                title: 'Revisa que los datos esten completos',
                showConfirmButton: false,
                timer: 2500
                    })
    } 
}

function cerrar(sid, uid, idr){
    $.ajax({
            async: true,
            type: "POST",
            url:'./saves/save_sale.php',
            data: {sid:sid, uid:uid, idr:idr},
            beforeSend: function(objeto){
              },
              success:function(data2){
                Swal.fire({
                icon: 'success',
                title: 'Correcto',
                showConfirmButton: true,
                confirmButtonColor: 'rgb(0 99 140)',
                    })      
                }               
                })
}

function delsalepre(sid, uid){
 $.ajax({
         type: "POST",
         url: "./ajax/check_press.php",
         data: {sid:sid},
            success:function(data){   
           if (data==0) { 
swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar la preventa?',
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
            url:'./saves/deletesalepre.php',
            data: {sid:sid},
  })
  .done(function(response){
     swal.fire('Eliminado!', response.message, response.status);
     showpres(uid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}
else{
            Swal.fire({
                icon: 'error',
                title: 'La preventa contiene conceptos, es necesario descartarlos',
                showConfirmButton: false,
                timer: 2500
                    })
    } 
            }
   }) 
}


/*
function cerrar(uid, amn, rid){
if (amn <= 1) {
    Swal.fire({
    icon: 'warning',
    title: 'No hay productos seleccionados',
    showConfirmButton: true,
    confirmButtonColor: 'rgb(0 99 140)',
                    })
}       else    {
    $.ajax({
            async: true,
            type: "POST",
            url:'./saves/save_sale.php',
            data: {uid:uid, amn:amn, rid:rid},
            beforeSend: function(objeto){
                 $('#cajapres').html(loadershowmini);
              },
              success:function(data2){
                Swal.fire({
                icon: 'success',
                title: 'Correcto',
                showConfirmButton: true,
                confirmButtonColor: 'rgb(0 99 140)',
                    })
                show("caja", uid);        
                }               
                })
        } 
}

*/