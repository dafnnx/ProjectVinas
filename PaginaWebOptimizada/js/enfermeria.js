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
            url:'./ajax/buscar_enfe.php',
            data: {action:action, q:q, uid:uid},
             beforeSend: function(objeto){
             $('#subsea_notaenfer').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_notaenfer").html(data2).fadeIn('slow');   
            }
         })
      }  


async function showsvisits(uid, pid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_visits.php',
         data: {uid:uid, pid:pid},
         async: true, 
         beforeSend: function(objeto){
            $('#vlist').html(loadershow);
         },
            success: function(datos){
            $("#vlist").html(datos).delay(4000).fadeIn();
         }
      });
   }   


function save_notaenfer() {
    let fecn= $("[name='fec_notaenfer']").val();
if (fecn) {
  $('#savenotaenfer').attr("disabled", true);
 var parametros = $('#selnotaenfer').find('textarea, input, select').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/save_notaenfer.php",
            data: parametros,
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $('#selnotaenfer').find(':text, textarea, select').val("");
                $('#savenotaenfer').attr("disabled", false);
                }
    })   
 } else {
     Swal.fire({
               icon: 'error',
               title: '¡Selecciona la fecha!',
               showConfirmButton: false,
               timer: 2500
               })
 }
}

function edit_notaenfer() {
  $('#saveeditnotaenfer').attr("disabled", true);
 var parametros = $('#editnotaenfer').find('textarea, input, select').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/save_editnotaenfer.php",
            data: parametros,
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $('#editnotaenfer').find(':text, textarea, select').val("");
                $('#saveeditnotaenfer').attr("disabled", false);
                }
    })  
     event.preventDefault();
}

async function showenfer(uid, pid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_enfer.php',
         data: {uid:uid, pid:pid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }


async function plusqr(uid, pid){
      $.ajax({
         type: "POST",
         url: './ajax/registrar_qr.php',
         data: {uid:uid, pid:pid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
showsvisits();

   }   

/* detalles */
async function ntesdetalles(idr, uid){
      $.ajax({
      type: "POST",
      url: './ajax/hist_enfer.php',
      data: {idr:idr, uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#subsea_notaenfer').html(loadershow);
         },
            success: function(datos){
            $("#subsea_notaenfer").html(datos).delay(4000).fadeIn();
            showhide('expeenfer', 'newnoteenfer', 'mens', idr);
         }
      });
   }

/* detalles */

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
    loadexpesenfer(rid);
    break;
  default:
}   }

 function loadexpesenfer(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_expesenfer.php",
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
  function mdlnoteenfer(idnote){
    var mclo= "notaclose";
var span = document.getElementById(mclo);
$("#modnota").css("display", "block");
span.onclick = function() {
  $("#modnota").css("display", "none");
}
idnote2= parseFloat(idnote);
if (idnote2) {   loadnotaenfer(idnote2);  }
}
/*modal*/


 function loadnotaenfer(idnote){
    $.ajax({
         type: "POST",
         url: "./ajax/load_notaenfer.php",
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

function xportenfer(){
    $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/exportarenfe.php',
            data: {},
             beforeSend: function(objeto){
             $('#contmargin').html(loadershowmini);
           },
            success:function(data2){
               $("#contmargin").html(data2).fadeIn('slow');   
            }
         })
}