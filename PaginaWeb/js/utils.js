  var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';

/*edificio*/
  function save_edif(uid){
  	var n_edif= $('#n_edificio').val();
  if(n_edif) {  
	 $.ajax({
			type: "POST",
			url: "./saves/save_edificio.php",
			data: {n_edif:n_edif, uid:uid},
			beforeSend: function(objeto){
				 $('#mapaedif').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#n_edificio').val('');
				loadedi();				
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
} }

  function loadedi(){
	 $.ajax({
			type: "POST",
			url: "./ajax/load_edificios.php",
				success:function(data){		
				$('#mapaedif').html(data);	
				}
	})  
	 event.preventDefault();
}

function set_edif(eid, nom){
$.ajax({
      type: "POST",
      url: "./ajax/set_edificios.php",
      data: {eid:eid, nom:nom},
        success:function(data){   
        $('#utilsup').html(data);  
        }
  })  
   event.preventDefault();
}

/*edificio*/

/*piso*/
  function save_piso(eid){
  	var n_piso= $('#n_piso').val();
  if(n_piso) {  
	 $.ajax({
			type: "POST",
			url: "./saves/save_piso.php",
			data: {n_piso:n_piso, eid:eid},
			beforeSend: function(objeto){
				 $('#mapapiso').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#n_piso').val('');
				$('#mapapiso').html('');
				loadpiso(eid);				
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
} }


 function loadpiso(eid){
	 $.ajax({
			type: "POST",
			url: "./ajax/load_pisos.php",
			data: {eid:eid},
				success:function(data){		
				$('#mapapiso').html(data);	
				}
	})  
	 event.preventDefault();
}

function set_piso(pid, nop, eid){
$.ajax({
      type: "POST",
      url: "./ajax/set_pisos.php",
      data: {pid:pid, nop:nop, eid:eid},
        success:function(data){   
        $('#utilsup').html(data);  
        }
  })  
   event.preventDefault();
}

/*piso*/


/*roms*/
  function save_room(pid){
  	var n_room= $('#n_room').val();
  if(n_room) {  
	 $.ajax({
			type: "POST",
			url: "./saves/save_room.php",
			data: {n_room:n_room, pid:pid},
			beforeSend: function(objeto){
				 $('#mapapiso').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#n_room').val('');
				loadroom(pid);				
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
} }


 function loadroom(pid){
	 $.ajax({
			type: "POST",
			url: "./ajax/load_rooms.php",
			data: {pid:pid},
				success:function(data){		
				$('#mapapiso').html(data);	
				}
	})  
	 event.preventDefault();
}


function set_room(rid, nor, pid){
$.ajax({
      type: "POST",
      url: "./ajax/set_rooms.php",
      data: {rid:rid, nor:nor, pid:pid},
        success:function(data){   
        $('#utilsup').html(data);  
        }
  })  
   event.preventDefault();
}

/*roms*/

/*beds*/

  function save_bed(rid){
  	var n_bed= $('#n_bed').val();
  if(n_bed) {  
	 $.ajax({
			type: "POST",
			url: "./saves/save_bed.php",
			data: {n_bed:n_bed, rid:rid},
			beforeSend: function(objeto){
				 $('#mapapiso').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#n_bed').val('');
				loadbed(rid);				
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
} }

 function loadbed(rid){
	 $.ajax({
			type: "POST",
			url: "./ajax/load_beds.php",
			data: {rid:rid},
				success:function(data){		
				$('#mapapiso').html(data);	
				}
	})  
	 event.preventDefault();
}


 function bed_sta(ssta, bid, rid){
 Swal.fire({
  title: 'Estas seguro de cambiar es status?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then((result) => {
  if (result.isConfirmed) {		


$.ajax({
			type: "POST",
			url: "./saves/update_bed.php",
			data: {ssta:ssta, bid:bid},
			beforeSend: function(objeto){
				 $('#mapapiso').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#n_room').val('');
				loadroom(rid);				
				}
  }) 


  		  }
}) 
}

/*beds*/
/*enser status*/
 function enseres_sta(rid){
 		var mot=$("[name=motivo_ense]").val();
 		var per=$("[name=persona_ense]").val();
if (mot && per) {
 Swal.fire({
  title: 'Estas seguro de dar de baja todos los enseres?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then((result) => {
  if (result.isConfirmed) {		
$.ajax({
			type: "POST",
			url: "./saves/update_enseres.php",
			data: {rid:rid, mot:mot, per:per},
			beforeSend: function(objeto){
				 $('#mapapiso').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#n_room').val('');
				ens_list(rid);				
				}
  }) 
  		  }
}) 
} else {
Swal.fire({
               icon: 'error',
               title: 'Todos los campos son requeridos',
               showConfirmButton: false,
               timer: 1500
               });
	}
}

 function enseres_sta_single(idr, rid){
 		var mot=$("[name=motivo_ense_single]").val();
 		var per=$("[name=persona_ense_single]").val();
if (mot && per) {
 Swal.fire({
  title: 'Estas seguro de dar de baja el enser?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then((result) => {
  if (result.isConfirmed) {		
$.ajax({
			type: "POST",
			url: "./saves/update_enseres_single.php",
			data: {idr:idr, mot:mot, per:per},
			beforeSend: function(objeto){
				 $('#mapapiso').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#n_room').val('');
				ens_list(rid);				
				}
  }) 
  		  }
}) 
} else {
Swal.fire({
               icon: 'error',
               title: 'Todos los campos son requeridos',
               showConfirmButton: false,
               timer: 1500
               });
	}
}
/*enser status*/

/*save/load variables*/
function svvar(vmod){
	var tosave= $('#'+vmod+'inp').val();
if(tosave){
$.ajax({
			type: "POST",
			url: "./saves/check_"+vmod+".php",
			data: {tosave:tosave},
				success:function(data){	
if (data==0) {
$.ajax({
			type: "POST",
			url: "./saves/save_"+vmod+".php",
			data: {tosave:tosave},
			beforeSend: function(objeto){
				 $('#'+vmod+'list').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#'+vmod+'inp').val('');
				ldvar(vmod);				
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
 	 }) 	}
else{
	Swal.fire({
  		icon: 'error',
  		title: '¡Nombre Vacio!',
  		showConfirmButton: false,
  		timer: 1500
		})

} }

 function ldvar(mod){
	 $.ajax({
			url: "./ajax/load_"+mod+".php",
			beforeSend: function(objeto){
				 $('#'+mod+'list').html(loadershowmini);
			  },
			success:function(data){		
				$('#'+mod+'list').html(data);	
				}
	})  
	 event.preventDefault();
}
/*save/load variables*/



/*save/load variables*/
function svmedics(nom, ced){
	var tosave= $('#medicname').val();
	var tosave2= $('#medicced').val();
if(tosave){
$.ajax({
			type: "POST",
			url: "./saves/check_medic.php",
			data: {tosave:tosave, tosave2:tosave2},
				success:function(data){	
if (data==0) {
$.ajax({
			type: "POST",
			url: "./saves/save_medic.php",
			data: {tosave:tosave , tosave2:tosave2},
			beforeSend: function(objeto){
				 $('#medicslist').html(loadershowmini);
			  },
				success:function(){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#medicname', '#medicced').val('');
				ldmedics();				
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
 	 }) 	}
else{
	Swal.fire({
  		icon: 'error',
  		title: '¡Nombre y/o cedula vacio!',
  		showConfirmButton: false,
  		timer: 1500
		})

} }

 function ldmedics(){
	 $.ajax({
			url: "./ajax/load_medic.php",
			beforeSend: function(objeto){
				 $('#medicslist').html(loadershowmini);
			  },
			success:function(data){		
				$('#medicslist').html(data);	
				}
	})  
	 event.preventDefault();
}
/*save/load variables*/


/*iva detalles */
function ivadet(id, nom){
$.ajax({
			type: "POST",
			url: "./ajax/specs_iva.php",
			data: {id:id, nom:nom},
			beforeSend: function(objeto){
				 $('#ivalist').html(loadershowmini);
			  },
			success:function(data){		
				$('#ivalist').html(data);	
				}
	})  
	 event.preventDefault();
}
/*iva detalles */

 function upiva(){
 var parametros = $('#saveiva').find('select, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_ivaspecs.php",
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
            ldvar("iva");
            }
   })  
    event.preventDefault();
}