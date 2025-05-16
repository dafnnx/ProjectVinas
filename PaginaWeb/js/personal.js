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
            url:'./ajax/buscar_per.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_per').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_per").html(data2).fadeIn('slow');   
            }
         })
      }  

 async function newpersonal(uid){
      $.ajax({
      type: "POST",
      url: './pages/plus_personal.php',
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



function check_personal(){ 
 var nom = $('#nombre_personal').val(); 
 var pus = $('#per_usr').val();
 var pps = $('#per_pass').val(); 
 var ape = $('#area_personal').val(); 
        if(nom && pus && pps){
$.ajax({
            type: "POST",
            url: "./saves/check_usr.php",
            data: {pus:pus},
                success:function(data){ 
if (data==0) {   save_personal(nom, pus, pps, ape);   }
else{
Swal.fire({
                    icon: 'info',
                    title: 'Nombre de usuario ocupado, por favor genera otro',
                    showConfirmButton: false,
                    timer: 3000
        });
}
    }
      });
}

else{
    Swal.fire({
                    icon: 'error',
                    title: 'Campos primarios: Nombre, Usuario, Password.',
                    showConfirmButton: false,
                    timer: 3000
                    })
} 

    }


function save_personal(nom, pus, pps, ape) {
if (nom && pus && pps && ape) {
  $('#savepersonal').attr("disabled", true);
 var parametros = $('#selpersonal').find('select, textarea, input, checkbox').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/save_personal.php",
            data: parametros,
            beforeSend: function(objeto){
              },
                success:function(data){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 2000
                    })
                        up_newimg(data);
                        $('#savepersonal').attr("disabled", false);                        
                        $('#selpersonal').find('select, textarea, input').val("");
                }
    })  
}  else  {
    Swal.fire({
                    icon: 'error',
                    title: 'Campos obligatorios: Nombre, Usuario, Password, Area.',
                    showConfirmButton: false,
                    timer: 3000
                    })
    }   
}


function update_personal(pid) {
 var nom = $('#nombre_personal').val(); 
 var pus = $('#per_usr').val(); 
if (nom && pus) {
  $('#uppersonal').attr("disabled", true);
 var parametros = $('#uppersonal').find('select, textarea, input, checkbox').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/update_personal.php",
            data: parametros,
            beforeSend: function(objeto){
              },
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $('#uppersonal').attr("disabled", false);
                }
    })  
} else{
    Swal.fire({
                    icon: 'error',
                    title: 'Campos obligatorios: Nombre, Usuario, Password, Area.',
                    showConfirmButton: false,
                    timer: 2500
                    })
}   }


  function loadpersonal(){
     $.ajax({
            type: "POST",
            url: "./ajax/load_personal.php",
            beforeSend: function(objeto){
                $('#perso_contracts').hide();
                $('#perso_list').show(); 
                $('#perso_list').html(loadershowmini);
              },
                success:function(data){     
                $('#perso_list').html(data); 
                }
    })  
     event.preventDefault();
}


 async function showpersonal(){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_personal.php',
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }


   function sub_area(vale){
if (vale=="Enfermeria") {
 $.ajax({
            type: "POST",
            url: "./ajax/sub_enfermeria.php",
            success:function(data){     
            $('#s_area').html(data);
            }
    })  

} else if (vale=="S. Generales"){
$.ajax({
            type: "POST",
            url: "./ajax/sub_generales.php",
            success:function(data){     
            $('#s_area').html(data); 
            }
    })  
} else {   
    $('#s_area').html("");
    $('#sap').val("");  }
   }


function s_area_2(vale2){
$('#sap').val(vale2);
}


/*eliminar*/

function eliminar(id, table, wich){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el personal?',
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
     loadpersonal();
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}


function eliminarct(id, table, wich, idr){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el contrato?',
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
            url:'./saves/deletect.php',
            data: {id_id:id, table:table, wich:wich},
  })
  .done(function(response){
     swal.fire('Eliminado!', response.message, response.status);
     loadcontr(idr);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}


function eliminarse(id, table, wich){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el personal?',
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
            url:'./saves/deleteper.php',
            data: {id_id:id, table:table, wich:wich},
  })
  .done(function(response){
     swal.fire('Eliminado!', response.message, response.status);
     load();
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

/*eliminar*/

function save_contract(idr) {
  $('#savecontr').attr("disabled", true);
 var parametros = $('#selcontr').find('input').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/save_contr.php",
            data: parametros,
            beforeSend: function(objeto){
                 $('#cont_lst_lst').html(loadershowmini);
              },
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                    loadcontr(idr);
                $('#savecontr').attr("disabled", false);
                }
    })  
     event.preventDefault();
}


  function loadcontr(idr){
     $.ajax({
            type: "POST",
            url: "./ajax/load_contr.php",
            data: {idr:idr},
            beforeSend: function(objeto){
                $('#cont_lst_lst').html(loadershowmini);
              },
                success:function(data){     
                $('#cont_lst_lst').html(data); 
                }
    })  
     event.preventDefault();
}


/*generar*/
function gen_us_pass(){
    var min = 9999;
    var max = 1111;
var usr = Math.floor(Math.random()*(max-min+1)+min);
var pass = Math.floor(Math.random()*(max-min+1)+min);
if (usr && pass) {
    $('#per_usr').val(usr);
    $('#per_pass').val(pass);
}

}

/*generar*/

/* detalles */
async function detalles(id){
      $.ajax({
      type: "POST",
      url: './ajax/detalles_personal.php',
      data: {id:id},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
            dets_perso(id);
         }
      });
   }

function dets_perso(idr){
$.ajax({
         type: "POST",
         url: './ajax/load_contratos.php',
         data: {idr:idr},
         async: true, 
         beforeSend: function(objeto){
            $('#enser_list').html(loadershowmini);
         },
         success: function(datos){
            $('#perso_list').hide();
            $('#perso_contracts').show();
            $('#perso_contracts').html(datos);  
            loadcontr(idr);
         }
      });  
}

/* detalles */

   function r_live_up(idc, chng, newval, table, tgt, nom){

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


function save_persta(){
   var f_status = $('#fecha_perstatus').val();
   var m_status = $('#motivo_perstatus').val();
   var x_status = $('#status_perstatus').val();
if (m_status == "" || m_status == null || f_status == "" || f_status == null || x_status == "" || x_status == null) {
   Swal.fire({
               icon: 'error',
               title: 'Todos los campos son requeridos',
               showConfirmButton: false,
               timer: 1500
               })
}
else {
 var parametros = $('#save_perstat').find('select, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_perstatus.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#resitrtable').html(loadershowmini);
           },
            success:function(data){  
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadperstat(data);
            }
   })  
} 
   }


      function loadperstat(id){
      $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/status_perchk.php',
            data: {id:id},
             beforeSend: function(objeto){
             $('#stapersta').html(loadershowmini);
           },
            success:function(data2){
               $("#stapersta").html(data2).fadeIn('slow');   
            }
         })
   }


function up_newimg(pro_id){
        var formData = new FormData();
        var files = $('#image')[0].files[0];
        var files2 = $("#image").val().replace(/.*(\/|\\)/, '');
        formData.append('file',files);
        $.ajax({
            url: './saves/uploadper.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {            
    if (response != 0) {
              $.ajax({
              async: true,
              type: "POST",
              url:'./saves/upload2per.php',
              data: {pro_id:pro_id, files2:files2},
              })
                    $(".card-img-top").attr("src", response);
    } else {      } }
        });
    return false;   
    };

  function check() {
    document.querySelectorAll('#permisosper input[type=checkbox]').forEach(function(checkElement) {
        checkElement.checked = true;
    });
}
