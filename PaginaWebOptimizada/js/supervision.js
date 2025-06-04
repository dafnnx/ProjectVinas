var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
var loadershow = '<img src="./img/vinasloader.svg" width="30%" style="margin: 0 auto;display: flex;">';


$(document).ready(function(){
         load(1);
      });

      function load(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_superhist.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_nota').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_nota").html(data2).fadeIn('slow');   
            }
         })
      }  


async function showshist(uid, pid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_shist.php',
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
async function shistdetalles(idr, uid){
      $.ajax({
      type: "POST",
      url: './ajax/hist_shist.php',
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

 function loadhistinns(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_histoinns.php",
         data: {rid:rid},
         beforeSend: function(objeto){
             $('#innstgt').html(loadershowmini);
           },
            success:function(data){    
            $('#innstgt').html(data);   
            }
   })  
    event.preventDefault();
}

 function loadhistouts(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_histoouts.php",
         data: {rid:rid},
         beforeSend: function(objeto){
             $('#outstgt').html(loadershowmini);
           },
            success:function(data){    
            $('#outstgt').html(data);   
            }
   })  
    event.preventDefault();
}


function showhide(con, mont, mode, rid){
switch(mode) {
  case "cons":
    $("#"+con).show();
    $("#"+mont).hide();
    loadhistinns(rid);
    
    break;
  case "mens":
    $("#"+con).show();
    $("#"+mont).hide();
    loadhistouts(rid);
    break;
  default:
}   }


/* detalles */   


async function showsuper(uid, pid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_super.php',
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


async function super_search(){
   let parametros = $('#super_info').find('textarea, input').serialize();
      $.ajax({
         type: "POST",
         url: './ajax/buscar_supe.php',
         data: parametros,
         async: true, 
         beforeSend: function(objeto){
            $('#super_list').html(loadershow);
         },
            success: function(datos){
            $("#super_list").html(datos).delay(4000).fadeIn();
         }
      });
   }


async function test(valu){
   let tvl= $('#res_ids').val();
      $('#res_ids').val(tvl+valu+',');
   }

async function super_clean(){
$('#res_ids').val("");
   }


   async function trat_disp(idr, fec){
      var hou= $('#thehour').val();
      $("#rtratlist-"+idr).fadeToggle("linear");
      $.ajax({
         type: "POST",
         url: './ajax/buscar_desglo.php',
         data: {idr:idr, fec:fec, hou:hou},
         async: true, 
         beforeSend: function(objeto){
            $("#rtrat_desglo-"+idr).html();
         },
            success: function(datos){
            $("#rtrat_desglo-"+idr).html(datos);
         }
      });

   }


   async function trat_specs(idr, idt, fec){
var theh= $('#thehour').val();
      $.ajax({
         type: "POST",
         url: './ajax/buscar_aplica.php',
         data: {idr:idr, idt:idt, fec:fec, theh:theh},
         async: true, 
         beforeSend: function(objeto){
            $("#rtratspecs").html(loadershow);
         },
            success: function(datos){
            $("#rtratspecs").html(datos);
         }
      });

   }


function mdlapp(msta, mclo, hr, qty, fech){
if (qty) {
        $('#hr_var').val(hr);
         $("[name='hr_aplic']").val(hr);
         $("[name='qty_aplic']").val(qty);
         $("[name='fech_aplic']").val(fech);
        var span = document.getElementById(mclo);
        msta.style.display = "block";
        span.onclick = function() {
        msta.style.display = "none";
    }   
} else {
         Swal.fire({
               icon: 'error',
               title: '¡El tratamiento no contiene cantidad a aplicar!',
               showConfirmButton: false,
               timer: 2500
               })
         }
}


/* salvar aplicar*/
   async function saveapp(opt){
   var opt2 = $("[name='opt_aplic-"+opt+"']").val();  
 if (opt2){
   var parametros = $('#'+opt).find('input, select').serialize(); 
    $.ajax({
         type: "POST",
         url: "./saves/save_app.php",
         data: parametros,        
            success:function(){  
            }   

            
   })  
         }
         else {
         Swal.fire({
               icon: 'error',
               title: 'Especifica aplicación (si/no).',
               showConfirmButton: false,
               timer: 3000
               })
         }
event.preventDefault(); 
}

  async function savevars(vr, idr, idt, fec, hr, incv){ 

var opt= hr+vr+"_hinv";
 $.ajax({
         type: "POST",
         url: "./saves/check_histopt.php",
         data: {idr:idr, idt:idt, fec:fec, hr:hr},
            success:function(data){ 
    if (data) {
$.ajax({
         type: "POST",
         url: "./saves/save_vars.php",
         data: {idr:idr, idt:idt, fec:fec, hr:hr, incv:incv, vr:vr},
            success:function(data){ 
               } 
   }) 
    }    else     {
         Swal.fire({
               icon: 'error',
               title: 'Especifica aplicación (si/no).',
               showConfirmButton: false,
               timer: 3000
               })
               $("[name="+vr+"_"+hr+"]").prop("selectedIndex", 0).val(); 
         }
            }   
   })  

}


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
     showresi(uid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

async function newnote(uid){
    $.ajax({
         type: "POST",
         url: './ajax/new_note.php',
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


async function loadnote(){
    $.ajax({
         type: "POST",
         url: './ajax/buscar_supernote.php',
         async: true, 
         beforeSend: function(objeto){
            $('#subseanew_nota').html(loadershow);
         },
            success: function(datos){
            $("#subseanew_nota").html(datos).delay(4000).fadeIn();
         }
      });
}

function save_notasuper() {
    let fecn= $("[name='fec_notasuper']").val();
    let turn= $("[name='turno_notasuper']").val();
if (fecn && turn) {
  $('#savenotasuper').attr("disabled", true);
 var parametros = $('#selnotasuper').find('textarea, input, select').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/save_notasuper.php",
            data: parametros,
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $('#selnotasuper').find('input, textarea, select').val("");
                $('#savenotasuper').attr("disabled", false);
                loadnote();
                }
    })   
 } else {
     Swal.fire({
               icon: 'error',
               title: '¡Campos obligatorios: Fecha y Turno!',
               showConfirmButton: false,
               timer: 2500
               })
 }
}