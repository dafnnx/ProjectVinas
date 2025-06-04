var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';


$(document).ready(function(){
         load(1);
      });

      function load(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_medica.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_per').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_per").html(data2).fadeIn('slow');   
            }
         })
      }  

$(document).ready(function(){
         loadfcons(1);
      });

      function loadfcons(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_farmacons.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_farmacons').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_farmacons").html(data2).fadeIn('slow');   
            }
         })
      }  

async function showfcons(uid){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_fcons.php',
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


 async function newpersonal(uid){
      $.ajax({
      type: "POST",
      url: './pages/plus_personal.php',
      data: {uid:uid},
      async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershowmini);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

  function med_comple(uid){
  	var nmed= $('[name="nombre_medica"]').val();
    var iva= $('[name="iva_medica"]').val();
    var cve= $('[name="clave_sat"]').val();
    var uni= $('[name="unidad_sat"]').val();
if (nmed && cve && uni) {
$.ajax({
			type: "POST",
			url: "./saves/check_varmeds.php",
			data: {nmed:nmed},
				success:function(data){
if (data==0){
  $('#savenewmed').attr("disabled", true);
 var parametros = $('#selnewmed').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/save_medica.php",
            data: parametros,
            beforeSend: function(objeto){
                 $('#new_med_div').html(loadershowmini);
              },
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 2000
                    })
            $('#savenewmed').attr("disabled", false);
            newmedica(uid);                
                }
    })  
     event.preventDefault();
 }	 else	{
Swal.fire({
  					icon: 'info',
  					title: 'Nombre ya esta en uso',
  					showConfirmButton: false,
  					timer: 2000
					})
			}
		}
}) 	
	}
else{
	Swal.fire({
  		icon: 'error',
  		title: 'Requeridos: Nombre, Clave SAT, Unidad SAT',
  		showConfirmButton: false,
  		timer: 3000
		})
	}
}

  function med_edit_comple(mid_mid, uid){        
    var nmed= $('[name="nombre_medica"]').val();
    var iva= $('[name="iva_medica"]').val();
    var cve= $('[name="clave_sat"]').val();
    var uni= $('[name="unidad_sat"]').val();
if (nmed && iva && cve && uni) {
  $('#saveeditmed').attr("disabled", true);
 var parametros = $('#editmed').serialize();
     $.ajax({
            type: "POST",
            url: "./saves/update_medica.php",
            data: parametros,
            beforeSend: function(objeto){
                 $('#contmargin').html(loadershowmini);
              },
                success:function(id){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
            $('#saveeditmed').attr("disabled", false);   
            detalles(mid_mid, id);      
                }
    })  
     event.preventDefault();
} else{
    Swal.fire({
        icon: 'error',
        title: 'Requeridos: Nombre, IVA, Clave SAT, Unidad SAT',
        showConfirmButton: false,
        timer: 3000
        })
    }
}

/* detalles */
async function detalles(id_id, id){
        var id_id=parseInt(id_id);
        var id=parseInt(id);
      $.ajax({
      type: "POST",
      url: './ajax/detalles_medicamento.php',
      data: {id_id:id_id, id:id},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershowmini);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }



async function fconsdetalles(idr){
      $.ajax({
      type: "POST",
      url: './ajax/hist_fcons.php',
      data: {idr:idr},
         async: true, 
         beforeSend: function(objeto){
            $('#subsea_farmacons').html(loadershow);
         },
            success: function(datos){
            $("#subsea_farmacons").html(datos).delay(4000).fadeIn();
         }
      });
   }


/* detalles */


 async function showx(vr){
      $.ajax({
      type: "POST",
      url: './ajax/buscar_'+vr+'.php',
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershowmini);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

   /*loaders activo vars*/

function addactivo(){
    var idm= $('#mid').val();
    var nomm= $("[name='nombre_medica']").val();  
if (!nomm) {
Swal.fire({
            icon: 'info',
            title: 'Nombre Vacío',
            showConfirmButton: false,
            timer: 3000
            });
} else {
    var tosave= $('[name="sactivo"]').val();  
if(tosave){
$.ajax({
            type: "POST",
            url: "./saves/save_medactivo.php",
            data: {tosave:tosave, idm:idm},
            beforeSend: function(objeto){
                 $('#activoasglist').html(loadershowmini);
              },
                success:function(){         
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $(tosave).val('');
                 ldmedact(idm);             
                }
  }) 
     event.preventDefault();
}   
else{
    Swal.fire({
        icon: 'error',
        title: '¡Nombre Vacio!',
        showConfirmButton: false,
        timer: 1500
        })
    }
  }
}



 function ldmedact(idm){
     $.ajax({
            type: "POST",
            url: "./ajax/load_asgmedica.php",
            data: {idm:idm},
            beforeSend: function(objeto){
                 $('#activoasglist').html(loadershowmini);
              },
            success:function(data){     
                $('#activoasglist').html(data);   
                }
    })  
     event.preventDefault();
}
/*loaders activo vars*/

/*loaders via vars*/
function addvia(id){
    var idm= $('#mid').val();
    var nomm= $("[name='nombre_medica']").val();  
if (!nomm) {
Swal.fire({
            icon: 'info',
            title: 'Nombre Vacío',
            showConfirmButton: false,
            timer: 3000
            });
} else {
    var tosave= $('[name="svia"]').val();  
if(tosave){
$.ajax({
            type: "POST",
            url: "./saves/save_medvia.php",
            data: {tosave:tosave, idm:idm},
            beforeSend: function(objeto){
                 $('#viaasglist').html(loadershowmini);
              },
                success:function(){         
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $(tosave).val('');
                 ldmedvia(idm);             
                }
  }) 
     event.preventDefault();
}   
else{
    Swal.fire({
        icon: 'error',
        title: '¡Nombre Vacio!',
        showConfirmButton: false,
        timer: 1500
        })
    }
  }
}


 function ldmedvia(idm){
     $.ajax({
            type: "POST",
            url: "./ajax/load_asgmedvia.php",
            data: {idm:idm},
            beforeSend: function(objeto){
                 $('#viaasglist').html(loadershowmini);
              },
            success:function(data){     
                $('#viaasglist').html(data);   
                }
    })  
     event.preventDefault();
}

/*loaders via vars*/

/* check */

 


/* check */
/*eliminar*/
function eliminar(id, table, wich){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el medicamento?',
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
     showmedica();
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

function eliminarac(id, table, wich, uid){
  var idm= $('#mid').val();
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de descartar el activo?',
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
     ldmedact(idm);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

function eliminarvi(id, table, wich, uid){
  var idm= $('#mid').val();
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de descartar la via?',
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
     ldmedvia(idm);
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

    async function newmedica(uid){
        var mid = Math.floor(1000000 + Math.random() * 999999);
        
      $.ajax({
      type: "POST",
      url: './pages/plus_medica.php',
      data: {uid:uid},
      async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershowmini);
         },
            success: function(datos){
                
            $("#contmargin").html(datos).delay(4000).fadeIn();
            $("#mid").val(mid);
         }
      });
   }