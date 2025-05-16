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
            url:'./ajax/buscar_med.php',
            data: {action:action, q:q, uid:uid},
             beforeSend: function(objeto){
             $('#subsea_nota').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_nota").html(data2).fadeIn('slow');   
            }
         })
      }  

function save_notamed(areap) {
    if (areap!=="Medico") {
        var idmed = $('#id_medic').val(); 
        if (idmed) {   proced_notamed(idmed);     }
else {
Swal.fire({
                icon: 'error',
                title: 'Es necesario especificar nombre del Médico.',
                showConfirmButton: false,
                timer: 2500
        })
    }
} else {        proced_notamed();         }
    }

function proced_notamed(idmed){
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
    } 
}


function save_segnotamed(idnote) {
  $('#savesegnotamed').attr("disabled", true);
 var parametros = $('#selsegnotamed').find('select, textarea, input').serialize(); 
     $.ajax({
            type: "POST",
            url: "./saves/save_segnotamed.php",
            data: parametros,
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $('#selsegnotamed').find(':text,.tarea95new,#id_medic').val("");
                $('#savesegnotamed').attr("disabled", false);
                loadsegs(idnote);
                }
    })  
     event.preventDefault();
     
    }

async function showmedi(uid, pid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_medi.php',
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

/* detalles */
async function ntesdetalles(idr, uid){
      $.ajax({
      type: "POST",
      url: './ajax/hist_medi.php',
      data: {idr:idr, uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#subsea_nota').html(loadershow);
         },
            success: function(datos){
            $("#subsea_nota").html(datos).delay(4000).fadeIn();
            showhide('expemed', 'newnotemed', 'mens', idr);
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
loadsegs(idnote);
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

function new_seg(idr, uid, nid){
$.ajax({
         type: "POST",
         url: "./ajax/new_seg.php",
         data: {idr:idr, uid:uid, nid:nid},
         beforeSend: function(objeto){
             $('#notadata').html(loadershowmini);
           },
            success:function(data){    
            $('#notadata').html(data);   
            }
   })  
    event.preventDefault();
}

 function loadsegs(idnote){
    $.ajax({
         type: "POST",
         url: "./ajax/load_segs.php",
         data: {idnote:idnote},
         beforeSend: function(objeto){
             $('#seglist').html(loadershowmini);
           },
            success:function(data){    
            $('#seglist').html(data);   
            }
   })  
    event.preventDefault();
}

 function view_seg(idsegnote){
    $.ajax({
         type: "POST",
         url: "./ajax/view_seg.php",
         data: {idsegnote:idsegnote},
         beforeSend: function(objeto){
             $('#notadata').html(loadershowmini);
           },
            success:function(data){    
            $('#notadata').html(data);   
            }
   })  
    event.preventDefault();
}