var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
var loadershow = '<img src="./img/vinasloader.svg" width="30%" style="margin: 0 auto;display: flex;">';

/*load*/
$(document).ready(function(){
         load(1);
      });

      function load(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_eco.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_econo').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_econo").html(data2).fadeIn('slow');   
            }
         })
      } 

async function showecono(uid, pid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_econo.php',
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
/*load*/
/* detalles */
async function accdetalles(idr, nr, tr){
      $.ajax({
      type: "POST",
      url: './ajax/hist_econo.php',
      data: {idr:idr, nr:nr, tr:tr},
         async: true, 
         beforeSend: function(objeto){
            $('#subsea_econo').html(loadershow);
         },
            success: function(datos){
            $("#subsea_econo").html(datos).delay(4000).fadeIn();
         }
      });
   }

/* detalles */

/* detalles ejers */
async function ejersdetalles(ide){
      $.ajax({
      type: "POST",
      url: './ajax/detalles_ejercicio.php',
      data: {ide:ide},
         async: true, 
         beforeSend: function(objeto){
            $('#resiejers').html(loadershow);
         },
            success: function(datos){
            $("#resiejers").html(datos).delay(4000).fadeIn();
         }
      });
   }

/* detalles ejers */


/* ejercicios */
async function accejers(idr, nr, tr){
      $.ajax({
      type: "POST",
      url: './ajax/hist_ejers.php',
      data: {idr:idr, nr:nr, tr:tr},
         async: true, 
         beforeSend: function(objeto){
            $('#subsea_econo').html(loadershow);
         },
            success: function(datos){
            $("#subsea_econo").html(datos).delay(4000).fadeIn();
            loadejers(idr); 
         }
      });
   }

/* ejercicios */ 


/* detalles */
async function accdata(idr){
      $.ajax({
      type: "POST",
      url: './ajax/buscar_data.php',
      data: {idr:idr},
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

/*show*/
function showhide(con, mont, rep, mode, rid, tr){
switch(mode) {
  case "cons":
    $("#"+con).show();
    $("#"+mont).hide();
    $("#"+rep).hide();
    loadecono(rid); 
    break;
  case "mens":
    $("#"+con).hide();
    $("#"+mont).show();
    $("#"+rep).hide();
    loadyearm(rid);
    break;
  case "crep":
    $("#"+con).hide();
    $("#"+mont).hide();
    $("#"+rep).show();
   /* loadrep(rid);*/
    break;
  default:
}   }
/*show*/
/* edit */ 
function eco_live_up(idc, chng, newval, table, tgt, nom){
  $.ajax({
      type: "POST",
      url: "./saves/update_field.php",
      data: {id:idc, chng:chng, newval:newval, table:table, tgt:tgt},
        success:function(){      
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1000,
          })        
        }
         }) 
}
/* edit */ 



function xport(){
    $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/exportar.php',
            data: {},
             beforeSend: function(objeto){
             $('#contmargin').html(loadershowmini);
           },
            success:function(data2){
               $("#contmargin").html(data2).fadeIn('slow');   
            }
         })
}



function dele(idp, idr){
$.ajax({
         type: "POST",
         url: "./ajax/check_pays.php",
         data: {idp:idp},
            success:function(data){   
           if (data==0) { 

   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el registro?',
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
            url:'./saves/dele.php',
            data: {id_id:idp},
  })
  .done(function(response){
     swal.fire('Eliminado!', response.message, response.status);
     accdata(idr);
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
                title: 'El concepto forma parte de una venta, no puede ser eliminado',
                showConfirmButton: false,
                timer: 2500
                    })
    } 
}
});
}


function r_live_up(idp, chng, newval, table, tgt, nom){

if (nom!==newval) {
  $.ajax({
      type: "POST",
      url: "./saves/update_field.php",
      data: {id:idp, chng:chng, newval:newval, table:table, tgt:tgt},
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


function create_exer(){
  var min = $('[name="min_date"]').val();
  var max = $('[name="max_date"]').val();
  var res = $('[name="res_exer"]').val();
  var rid = $('[name="rid_exer"]').val();
   swal.fire({
   icon: 'warning',
   title: '¿Estás seguro de cerrar el ejercicio con los resultados presentados?',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Confirmar',
   showLoaderOnConfirm: true,
   preConfirm: function() {
      return new Promise(function(resolve) {
  $.ajax({

            async: true,
            type: "POST",
            url:'./saves/save_exer.php',
            data: {min:min, max:max, res:res, rid:rid},
  })
  .done(function(response){
     swal.fire('Correcto!', response.message, response.status);
        loadecono(rid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}


/*eco*/
 function mdlsend(idpa, rid){
        var open = document.getElementById('modsend');
        var span = document.getElementById('sendclose');
        var tester= open.style.display = "block";

        if (tester) { send(idpa, rid);}
        span.onclick = function() {
        open.style.display = "none";}
           }

async function send(idpa, rid){
    $('#send_m').load("pages/send_body.php", {idpa:idpa, rid:rid});
}


async function xsend(rid, mail, idpa){
$.ajax({
      type: "POST",
      url: "./ajax/test_file.php",
      data: {idpa:idpa},
        success:function(data){  
                nxt(rid, mail, idpa);
                }
         }) 
}

async function nxt(rid, mail, idpa){
$.ajax({
      type: "POST",
      url: "./reportes/recibo.php",
      data: {rid:rid, idpa:idpa},
        success:function(data){ 
        if (data=="1") {  validar(mail, idpa);   }   
        else   {
            Swal.fire({
                icon: 'error',
                title: 'Consulta a soporte técnico',
                showConfirmButton: false,
                timer: 2500
                    })
        }  
        }
     }) 
}

function validar(mailm, idpa){   
        $("#send_answ").html("Enviando email...").fadeIn('slow');
     $.ajax({
            type: "POST",
            url: "./smtp/send.php",
            data: {mailm:mailm, idpa:idpa},
                success:function(){ 
                Swal.fire({
                icon: 'success',
                title: 'El correo se envió correctamente',
                showConfirmButton: false,
                timer: 4000,
                    })
                $("#send_answ").html("").fadeIn('slow');
                }

    }); 
 

     event.preventDefault();
}
/*eco*/

/*month*/
 function mdlsendmonth(idpa, rid){
        var open = document.getElementById('modsendmonth');
        var span = document.getElementById('sendclosemonth');
        var tester= open.style.display = "block";

        if (tester) { sendmonth(idpa, rid);}
        span.onclick = function() {
        open.style.display = "none";}
           }

async function sendmonth(idpa, rid){
    $('#send_m_month').load("pages/send_body_month.php", {idpa:idpa, rid:rid});
}


async function xsendmonth(rid, mail, idpa){
$.ajax({
      type: "POST",
      url: "./ajax/test_file_month.php",
      data: {idpa:idpa},
        success:function(data){  
                nxtmonth(rid, mail, idpa);
                }
         }) 
}

async function nxtmonth(rid, mail, idpa){
$.ajax({
      type: "POST",
      url: "./reportesmonth/recibomonth.php",
      data: {rid:rid, idpa:idpa},
        success:function(data){ 
        if (data=="1") {  validarmonth(mail, idpa);   }   
        else   {
            Swal.fire({
                icon: 'error',
                title: 'Consulta a soporte técnico',
                showConfirmButton: false,
                timer: 2500
                    })
        }  
        }
     }) 
}

function validarmonth(mailm, idpa){   
        $("#send_answ_month").html("Enviando email...").fadeIn('slow');
     $.ajax({
            type: "POST",
            url: "./smtp/sendmonth.php",
            data: {mailm:mailm, idpa:idpa},
                success:function(){ 
                Swal.fire({
                icon: 'success',
                title: 'El correo se envió correctamente',
                showConfirmButton: false,
                timer: 4000,
                    })
                $("#send_answ_month").html("").fadeIn('slow');
                }
    }); 
     event.preventDefault();
}
/*month*/