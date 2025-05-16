  var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
  var loadershow = '<img src="./img/vinasloader.svg" width="50%" style="margin: 0 auto;display: flex;">';

/*newresidente*/
   $( "#selresi" ).submit(function( event ) {
  $('#saveresi').attr("disabled", true);
 var parametros = $(this).serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_resident.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#sresi').html(loadershowmini);
           },
            success:function(rid){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadresidente(rid);
            $('#resic_id').val(rid); 
            $('#saved_idrcont').val(rid);
            $('#saved_clot').val(rid);
            $('#resic_inv').val(rid); 
            $('#resic_treat').val(rid); 
            }
   })  
    event.preventDefault();
})
/*newresidente*/

/*loadresidente*/
  function loadresidente(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_residente.php",
         data: {rid:rid},
            success:function(data){    
            $('#sresi').html(data); 
            }
   })  
    event.preventDefault();
}
/*loadresidente*/

/*newcontact*/
   $( "#selcont" ).submit(function( event ) {
   $('#savecont').attr("disabled", true);
   var rid = $('#saved_idrcont').val();  
if (rid){
   var parametros = $(this).serialize(); 
    $.ajax({
         type: "POST",
         url: "./saves/save_contact.php",
         data: parametros,
         beforeSend: function(objeto){
            $('#resict').html(loadershowmini);
           },
            success:function(){  
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })          
            $('#resict').html("");
            $('#savecont').attr("disabled", false);
            loadcontact(rid);
            }   
   })  
         }
         else {
         Swal.fire({
               icon: 'error',
               title: '¡No hay residente seleccionado!',
               showConfirmButton: false,
               timer: 1500
               })
         $('#savecont').attr("disabled", false);
         }
event.preventDefault();  
})

 function newcontact(rid){
var n_cont = $('#n_cont').val(); 
var p_cont = $('#p_cont').val(); 
if (n_cont && p_cont) {
 var parametros = $('#upfrcont').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/new_contact.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#resict').html(loadershowmini);
           },
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadcontact(rid);
            }
   })  
    event.preventDefault();
}
else {    
      Swal.fire({
               icon: 'error',
               title: '¡Nombre y/o parentezco vacíos!',
               showConfirmButton: false,
               timer: 1500
               })
 }
}

/*newcontact*/

/*loadcontact*/
    function loadcontact(rid){
var srid = $('#saved_idrcont').val();
      if (rid) {     var nrid=rid;     }
      else {   nrid= srid;  }
    $.ajax({
         type: "POST",
         url: "./ajax/load_contactos.php",
         data: {nrid:nrid},
         beforeSend: function(objeto){
             $('#resict').html(loadershowmini);
           },
            success:function(data){    
            $('#resict').html(data);   
            }
   })  
    event.preventDefault();
}
/*loadcontact*/


/*newarmario*/
function armario(uid){
   var rid = $('#saved_clot').val(); 
if (rid){
    $.ajax({
         type: "POST",
         url: "./saves/save_armario.php",
         data: {uid:uid, rid:rid},
         beforeSend: function(objeto){
             $('#armario').html(loadershowmini);
           },
            success:function(aid){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
               $('#armario_id').val(aid); 
            loadarmario(rid, uid);
            }
   })  
   }
   else {
         Swal.fire({
               icon: 'error',
               title: '¡No hay residente seleccionado!',
               showConfirmButton: false,
               timer: 1500
               })
         }
event.preventDefault();
}
/*newarmario*/

/*loadarmario*/
 function loadarmario(rid){
   var srid = $('#saved_clot').val();
      if (rid) {     var nrid=rid;     }
      else {   nrid= srid;  }
    $.ajax({
         type: "POST",
         url: "./ajax/load_armario.php",
         data: {nrid:nrid},
         beforeSend: function(){
             $('#armario').html(loadershowmini);
           },
            success:function(data){    
            $('#armario').html(data);  
            }
   })  
    event.preventDefault();
}
/*loadarmario*/

/*loadenseres*/

function aaa(tgt){
   console.log(tgt);
   $("#"+tgt).html("data");

}

 function ens_list(rid){
   var action="ajax";
   var q= $("#qa").val();
     decide("activos");
    $.ajax({
         type: "POST",
         url: "./ajax/load_enslist.php",
         data: {rid:rid, action:action, q:q},
         beforeSend: function(){
             $('#enser_list').html(loadershowmini);
           },
            success:function(data){    
            $('#enser_list').html(data);  
            }
   })  
}

 function ens_list_bajas(rid){
   var action="ajax";
   var q= $("#qb").val();
     decide("bajas");
    $.ajax({
         type: "POST",
         url: "./ajax/load_enslistbajas.php",
         data: {rid:rid, action:action, q:q},
         beforeSend: function(){
             $('#enser_list').html(loadershowmini);
           },
            success:function(data){    
            $('#enser_list').html(data);  
            }
   })  
}

async function decide(mode){

switch (mode) {
  case "activos":
      $("#lsa").css("display", "block");
      $("#lsb").css("display", "none"); 
   break;
  case "bajas":
      $("#lsa").css("display", "none");
      $("#lsb").css("display", "block"); 
    break;
 }

} 

$(document).ready(function(){
         load_singlens(1);
      });

      function load_singlens(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/load_enslist.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#enser_list').html(loadershow);
           },
            success:function(data2){
               $("#enser_list").html(data2).fadeIn('slow');   
            }
         })
      }  

/*loadenseres*/

/*newropa*/
$( "#selropa" ).submit(function( event ) {
  $('#saveropa').attr("disabled", true);
  var tstid = $('#saved_clot').val(); 
if (tstid){
   var parametros = $(this).serialize(); 
    $.ajax({
         type: "POST",
         url: "./saves/save_prenda.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#enser_list').html(loadershowmini);
           },
            success:function(rid){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 2000
               })          
            $('#enser_list').html("");
            $('#saveropa').attr("disabled", false);   
            $('#sedo').prop('selectedIndex',0);
            ens_list(rid);
            }
         })  
             }   else   {
         Swal.fire({
               icon: 'error',
               title: '¡No hay residente seleccionado!',
               showConfirmButton: false,
               timer: 2000
               })
         $('#saveropa').attr("disabled", false);
         }
event.preventDefault();  
})
/*newropa*/

/* newinventario */
 function newinvent(rid){
var tstid= $('#resic_inv').val(); 
if (tstid) {
   var n_inv = $('#fmedicainv').val(); 
   var c_inv = $('#c_inv').val(); 
if (c_inv == "" || c_inv == null && n_inv=="N/A") {
   Swal.fire({
               icon: 'error',
               title: 'Descripción y/o cantidad del producto vacío',
               showConfirmButton: false,
               timer: 1500
               })
}
else {
 var parametros = $('#upfrinv').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_inventory.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#resiinv').html(loadershowmini);
           },
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadinv(rid);
            }
   })  
    event.preventDefault();
}

} else {
         Swal.fire({
               icon: 'error',
               title: '¡No hay residente seleccionado!',
               showConfirmButton: false,
               timer: 1500
               })
         }
event.preventDefault();
}

function asmedica(id, nom, bm, rid){
 $.ajax({
         type: "POST",
         url: "./saves/check_invmed.php",
         data: {id:id, rid:rid},
            success:function(data){ 
if (data>0) {
Swal.fire({
               icon: 'error',
               title: '¡Este articulo ya se encuentra en el inventario del paciente!',
               showConfirmButton: false,
               timer: 3000
               })
} else {
$('#med_show').val(bm+" - "+nom);
   $('#fmedicainv').val(id);
   $('#fmedicainvname').val(nom);
}
         }
 }) 

}

async function spec_viauni(vl){
   let parts = vl.split(',');
   let mid = parts[0];
   let uni = parts[1]; 
   let via = parts[2]; 
$('[name="med_tratamiento"]').val(mid);
$('[name="via_medicamento"]').val(uni);
$('[name="unidad_medicamento"]').val(via);
}

      function loadmeds(rid){
         var action="ajax";
         var qm= $("#qm").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_meds.php',
            data: {action:action, qm:qm, rid:rid},
             beforeSend: function(objeto){
             $('#tgtsearch').html(loadershow);
           },
            success:function(data2){
               $("#tgtsearch").html(data2).fadeIn('slow');   
            }
         })
      }   

 function renewinvent(rid){
   var n_inv = $('#fmedicainv').val(); 
   var c_inv = $('#c_inv').val();
   var name_medica = $('#fmedicainvname').val(); 

if (c_inv == "" || c_inv == null && n_inv=="N/A") {
   Swal.fire({
               icon: 'error',
               title: 'Descripción y/o cantidad del producto vacío',
               showConfirmButton: false,
               timer: 1500
               })
}     else   {
 var parametros = $('#upfrinv').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_inventory.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#resiinv').html(loadershowmini);
           },
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadinv(rid);
            }
   })  
    event.preventDefault();
   }
}

/* newinventario */

/*loadinventario*/
function loadinv(rid){
   var srid = $('#resic_inv').val();
      if (rid) {     var nrid=rid;     }
      else {   nrid= srid;  }
   $.ajax({
      type: "POST",
      url: "./ajax/load_inventarios.php",
      data: {nrid:nrid},
      beforeSend: function(objeto){
         $('#resiinv').html(loadershowmini);
        },
        success:function(data){   
        $('#resiinv').html(data);  
        }
  })  
   event.preventDefault();
}
/*loadinventario*/

/* pretratamiento */
function save_trata(rid){
   var tstid= $('#resic_treat').val(); 
   if (rid) {     var nrid=rid;     }
      else {   nrid= tstid;  }
if (tstid || rid) {
   var m_trata = $('#m_trata').val(); 
   var t_trata = $('#total_tratamiento').val();
if (t_trata == "" || t_trata == null && m_trata=="N/A") {
   Swal.fire({
               icon: 'error',
               title: 'Descripción y/o total semanal vacío',
               showConfirmButton: false,
               timer: 1500
               })
}
else {
 var parametros = $('#upfrtr').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_pretreatment.php",
         data: parametros,
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            }
   })  
    event.preventDefault();
}
} else {
         Swal.fire({
               icon: 'error',
               title: '¡No hay residente seleccionado!',
               showConfirmButton: false,
               timer: 1500
               })
         }
 }


function save_uptrata(rid){
   $('#saveuptrata').attr("disabled", true);
   var m_trata = $('#fmedicaed').val(); 
   var t_trata = $('#total_tratamientoed').val();
if (t_trata == "" || t_trata == null && m_trata=="N/A") {
   Swal.fire({
               icon: 'error',
               title: 'Descripción y/o total semanal vacío',
               showConfirmButton: false,
               timer: 2500
               })
}     else     {   
 var parametros = $('#seluptrata').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/update_pretreatment.php",
         data: parametros,
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
               loadtrata(rid);
               $('#saveuptrata').attr("disabled", false);
            }
            
   })  
    event.preventDefault();
}
 }

 function save_edittrata(rid){
   $('#saveedittrata').attr("disabled", true);
   var m_trata = $('#fmedicaed').val(); 
   var t_trata = $('#total_tratamientoed').val();
if (t_trata == "" || t_trata == null && m_trata=="N/A") {
   Swal.fire({
               icon: 'error',
               title: 'Descripción y/o total semanal vacío',
               showConfirmButton: false,
               timer: 2500
               })
}     else     {   
 var parametros = $('#seledittrata').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/edit_pretreatment.php",
         data: parametros,
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
               loadtrata(rid);
               $('#saveedittrata').attr("disabled", false);
            }
            
   })  
    event.preventDefault();
}
 }

/* pretratamiento */

/* loadpretratamiento */
function loadpretrata(rid){
   var tstid= $('#resic_treat').val(); 
   if (rid) {     var nrid=rid;     }
      else {   nrid= tstid;  }
   $.ajax({
      type: "POST",
      url: "./ajax/load_pretratamientos.php",
      data: {nrid:nrid},
      beforeSend: function(objeto){
         $('#resitrtable').html(loadershowmini);
        },
        success:function(data){   
        $('#resitrtable').html(data);  
        }
  })  
   event.preventDefault();
}
/* loadpretratamiento */

/* tratamiento */

function date_check(dat){
  let ini= $('#fecha_ini').val(); 
  let fin= dat;
  if (fin < ini) { 
   $('#fecha_fin').val("");
Swal.fire({
               icon: 'error',
               title: '¡La fecha final no puede ser anterior a la fecha inicial!',
               showConfirmButton: false,
               timer: 3000
               })
   } else {            }
}

function loadtrata(rid){
   var tstid= $('#resic_treat').val(); 
   if (rid) {     var nrid=rid;     }
      else {   nrid= tstid;  }
   $.ajax({
      type: "POST",
      url: "./ajax/load_tratamientos.php",
      data: {nrid:nrid},
      beforeSend: function(objeto){
         $('#listfrtr').html(loadershowmini);
        },
      success: function(data2){   
        $('#listfrtr').html(data2);  
        }
  })  
   event.preventDefault();
}

function loadhisto(rid){
   var tstid= $('#resic_treat').val(); 
   if (rid) {     var nrid=rid;     }
      else {   nrid= tstid;  }
   $.ajax({
      type: "POST",
      url: "./ajax/load_trathisto.php",
      data: {nrid:nrid},
      beforeSend: function(objeto){
         $('#histfrtr').html(loadershowmini);
        },
      success: function(data2){   
        $('#histfrtr').html(data2);  
        }
  })  
   event.preventDefault();
}

function loadmovs(rid){
   var tstid= $('#resic_treat').val(); 
   if (rid) {     var nrid=rid;     }
      else {   nrid= tstid;  }
   $.ajax({
      type: "POST",
      url: "./ajax/load_tratmovs.php",
      data: {nrid:nrid},
      beforeSend: function(objeto){
         $('#movsfrtr').html(loadershowmini);
        },
      success: function(data2){   
        $('#movsfrtr').html(data2);  
        }
  })  
   event.preventDefault();
}

 /* tratamiento */

/*residente*/
   $(document).ready(function(){
         load(1);
      });

      function load(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_res.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_res').html(loadershow);
           },
            success:function(data2){
               $("#subsea_res").html(data2).fadeIn('slow');   
            }
         })
      } 

 function updateresi(rid){
 var parametros = $('#upfresi').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/update_resident.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#sresi').html(loadershowmini);
           },
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadresidente(rid);
            }
   })  
    event.preventDefault();
}

/*residente*/

function armarioup(fec, rid){
   var tstid= $('#saved_clot').val(); 
   if (rid) {     var nrid=rid;     }
      else {   nrid= tstid;  }

if (nrid){
    $.ajax({
         type: "POST",
         url: "./saves/save_uparmario.php",
         data: {nrid:nrid, fec:fec},
         beforeSend: function(objeto){
             $('#armario').html(loadershowmini);
           },
            success:function(rid){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadarmario(rid);
            }
   })  
   }
   else {
         Swal.fire({
               icon: 'error',
               title: '¡No hay residente seleccionado!',
               showConfirmButton: false,
               timer: 1500
               })
         }
event.preventDefault();
}

function newarmarioup(fec){
   var nrid= $('#saved_clot').val(); 
if (nrid){
    $.ajax({
         type: "POST",
         url: "./saves/save_uparmario.php",
         data: {nrid:nrid, fec:fec},
         beforeSend: function(objeto){
             $('#armario').html(loadershowmini);
           },
            success:function(rid){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadarmario(nrid);
            }
   })  
   }
   else {
         Swal.fire({
               icon: 'error',
               title: '¡No hay residente seleccionado!',
               showConfirmButton: false,
               timer: 1500
               })
         }
event.preventDefault();
}


 function loadarmarioup(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_armario.php",
         data: {rid:rid, uid:uid},
            success:function(data){    
            $('#armario').html(data);  
            }
   })  
    event.preventDefault();
}
/*armario*/





function upropa(rid){
   var parametros = $('#upfrcloth').find('select, textarea, input').serialize(); 
    $.ajax({
         type: "POST",
         url: "./saves/save_newprenda.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#enser_list').html(loadershowmini);
           },
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })    
            ens_list(rid);      
            $('#saveropa').attr("disabled", false);   
            $('#sedo').prop('selectedIndex',0);
            
            }
   })  
event.preventDefault();  
}


    function loadropa(ida, rid){
	 $.ajax({
			type: "POST",
			url: "./ajax/load_ropas.php",
			data: {ida:ida, rid:rid},
				success:function(data){		
				$('#enser_list').html(data);	
				}
	})  
	 event.preventDefault();
}


function ptype(){
	var pname= $('#ntipid').val(); 
if (pname){
	 $.ajax({
			type: "POST",
			url: "./saves/save_ptype.php",
			data: {pname:pname},
				success:function(rid){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
          $('#ntipid').val('');  
				}
	})  
	}
	else {
			Swal.fire({
  					icon: 'error',
  					title: '¡Tipo vacío!',
  					showConfirmButton: false,
  					timer: 1500
					})
			}
event.preventDefault();
}

function psize(){
	var psize= $('#ntalid').val(); 
if (psize){
	 $.ajax({
			type: "POST",
			url: "./saves/save_psize.php",
			data: {psize:psize},
				success:function(rid){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
          $('#ntalid').val(''); 
				}
	}) }
	else {
			Swal.fire({
  					icon: 'error',
  					title: '¡Talla vacía!',
  					showConfirmButton: false,
  					timer: 1500
					})
			}
event.preventDefault();
}

 function loadenser(ida, rid){
 	$('#arma_id').val(ida); 
	 $.ajax({
			type: "POST",
			url: "./ajax/load_ropas.php",
			data: {ida:ida, rid:rid},
      beforeSend: function(objeto){
         $('#enser_list').html(loadershowmini);
        },
				success:function(data){		
       /* $('#enser_list').show();*/
       /* $('#enser_pic').hide();*/
				$('#enser_list').html(data);	
				}
	})  
	 event.preventDefault();
}

function back(ida, rid){
  $('#enser_pic').hide();
  $('#enser_list').show();  
loadenser(ida, rid);
}


$(document).ready(function(){
   $("#fmedica").select2({
        ajax: {
        url: "./ajax/fmedica.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {            
           return {
              searchTerm: params.term // search term
           };
           
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


$(document).ready(function(){
   $("#rmvia").select2({
      ajax: {
        url: "./ajax/viaxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


$(document).ready(function(){
   $("#rmunidad").select2({
      ajax: {
        url: "./ajax/unidadxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#rmunidadinv").select2({
      ajax: {
        url: "./ajax/unidadxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#rmpatologia").select2({
      ajax: {
        url: "./ajax/patologiaxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


$(document).ready(function(){
   $("#sclothes").select2({
      ajax: {
        url: "./ajax/sclothes.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


$(document).ready(function(){
   $("#ssize").select2({
      ajax: {
        url: "./ajax/ssize.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#ssizeinv").select2({
      ajax: {
        url: "./ajax/ssize.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#sbrandinv").select2({
      ajax: {
        url: "./ajax/sbrand.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#sbrandropa").select2({
      ajax: {
        url: "./ajax/sbrand.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#sbrandropam").select2({
      ajax: {
        url: "./ajax/sbrandm.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


function prenimg(idr, nom, img, ida, rid){
$.ajax({
         type: "POST",
         url: './pages/pren_img.php',
         data: {idr:idr, nom:nom, img:img, ida:ida, rid:rid},
         async: true, 
         beforeSend: function(objeto){
            $('#enser_list').html(loadershowmini);
         },
            success: function(datos){
            $('#enser_list').html(datos);  
            loadropastat(idr);
         }
      });  
}

/*
function prenimg(idr, nom, img, ida, rid){
$.ajax({
         type: "POST",
         url: './pages/pren_img.php',
         data: {idr:idr, nom:nom, img:img, ida:ida, rid:rid},
         async: true, 
         beforeSend: function(objeto){
            $('#enser_list').html(loadershowmini);
         },
            success: function(datos){
            $('#enser_list').hide();
            $('#enser_pic').show();
            $('#enser_pic').html(datos);  
            loadropastat(idr);
         }
      });  
}
*/
/*ropa*/

/*imagenes*/
  $(document).ready(function() {
    $("#upimg").on('click', function() {
        var pro_id = $("#resic_id").val();
if (pro_id>0) {
		var formData = new FormData();
        var files = $('#image')[0].files[0];
        var files2 = $("#image").val().replace(/.*(\/|\\)/, '');
        formData.append('file',files);
        $.ajax({
            url: './saves/upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {            
    if (response != 0) {
              $.ajax({
              async: true,
              type: "POST",
              url:'./saves/upload2.php',
              data: {pro_id:pro_id, files2:files2},
              })
                    $(".card-img-top").attr("src", response);
    } else {          
      Swal.fire({
            icon: 'warning',
            title: 'Formato de imagen incorrecto!',
            showConfirmButton: true,
          })     } }
        });
    return false;
}
else {
	Swal.fire({
  	icon: 'error',
  	title: '¡No hay residente seleccionado!',
  	showConfirmButton: false,
  	timer: 1500
	})

}        
    });
});



function uppr() {
        var pre_id = $("#id_r").val();
if (pre_id>0) {
		var formData = new FormData();
        var files = $('#imagepre')[0].files[0];
        var files2 = $("#imagepre").val().replace(/.*(\/|\\)/, '');
        formData.append('file',files);
        $.ajax({
            url: './saves/uploadpre.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {            
    if (response != 0) {
              $.ajax({
              async: true,
              type: "POST",
              url:'./saves/uploadpre2.php',
              data: {pre_id:pre_id, files2:files2},
              })
                    $(".card-img-top2").attr("src", response);
    } else {          
      Swal.fire({
            icon: 'warning',
            title: 'Formato de imagen incorrecto!',
            showConfirmButton: true,
          })     } }
        });
    return false;
}
else {
	Swal.fire({
  	icon: 'error',
  	title: '¡No hay residente seleccionado!',
  	showConfirmButton: false,
  	timer: 1500
	})

}        
    }
/*imagenes*/

/*eliminar*/
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

function eliminar_ens(idre, table, wich, rid){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el enser?',
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
         data: {id_id:idre, table:table, wich:wich},
  })
  .done(function(response){
     swal.fire('Eliminado!', response.message, response.status);
     ens_list(rid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

function eliminartrata(id, table, wich, rid){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el tratamiento?',
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
     loadtrata(rid); 
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

function eliminararma(id, table, wich, rid){
$.ajax({
            async: true,
            type: "POST",
            url:'./ajax/check_arma.php',
            data: {ida:id},
            success:function(data2){               

               if (data2>=1) {
                   Swal.fire({
                  icon: 'error',
                  title: 'El armario contiene enseres',
                  showConfirmButton: false,
                  timer: 1500
               })     
 }
 else {                 
swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el armario?',
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
     loadarmario(rid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
               }
            }
         })
}


function eliminarenser(id, table, wich, ida, rid){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el artículo?',
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
     console.log(ida);
     console.log(rid);
     loadropa(ida, rid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}


function eliminarinv(id, table, wich, rid){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el medicamento al residente?',
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
     loadinv(rid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

function eliminarpret(id, table, wich, rid){
   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de descartar el medicamento?',
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
     loadpretrata(rid);
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


/*print*/
  
function printficha(){
var residen = $("#resic_id").val();
$.ajax({
      type: "POST",
      url: "./reportes/expediente.php",
      data: {residen:residen},
        success:function(data){ 
        $('#prints').html(data);   
        }
  })  
   event.preventDefault();
}

/*print*/


/*modal*/
/*modal*/
/* inventario */
  $( "#selinv" ).submit(function( event ) {
  $('#saveinv').attr("disabled", true);
  var tstid = $('#resic_id').val(); 
if (tstid){
  $('#resic_inv').val(tstid);
  var parametros = $(this).serialize(); 
   $.ajax({
      type: "POST",
      url: "./saves/save_inventory.php",
      data: parametros,
      beforeSend: function(objeto){
         $('#resiinv').html(loadershowmini);
        },
        success:function(rid){      
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1500
          })        
        $('#resiinv').html("");
        $('#saveinv').attr("disabled", false);
        loadinv(rid);
        }
  })  

      }
      else {
      Swal.fire({
            icon: 'error',
            title: '¡No hay residente seleccionado!',
            showConfirmButton: false,
            timer: 1500
          })
      $('#savetrata').attr("disabled", false);
      }
event.preventDefault();  
})


/*tratamiento*/
  $( "#seltrata" ).submit(function( event ) {
  $('#savetrata').attr("disabled", true);
  var tstid = $('#resic_id').val(); 
if (tstid){
var t_trata = $('#total_tratamiento').val();
var m_trata = $('#m_trata').val(); 
if (t_trata == "" || t_trata == null && m_trata=="N/A") { 


$('#savetrata').attr("disabled", false);
   Swal.fire({
            icon: 'error',
            title: 'Descripción y/o total semanal vacío',
            showConfirmButton: false,
            timer: 1500
          })
}  else {
  $('#resic_treat').val(tstid);
  var parametros = $(this).serialize(); 
   $.ajax({
      type: "POST",
      url: "./saves/save_pretreatment.php",
      data: parametros,
      beforeSend: function(objeto){
         $('#resitrtable').html(loadershowmini);
        },
        success:function(rid){      
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1500
          })        
        $('#resitrtable').html("");
        $('#savetrata').attr("disabled", false);
        }
         }) 
}
}  else {
      Swal.fire({
            icon: 'error',
            title: '¡No hay residente seleccionado!',
            showConfirmButton: false,
            timer: 1500
          })
      $('#savetrata').attr("disabled", false);
      }
event.preventDefault();  
})


function actrata(idt){
   var m_trata = $('#m_trataed').val(); 
   var t_trata = $('#total_tratamientoed').val();
   var c_trata = $('#consul_tratamientoed').val();
if (t_trata == "" || t_trata == null && m_trata=="N/A" && c_trata == "" || c_trata == null) {
   Swal.fire({
               icon: 'error',
               title: 'Descripción, consulta y/o total semanal vacío',
               showConfirmButton: false,
               timer: 1500
               })
}
else {
 var parametros = $('#upfrtredit').find('select, textarea, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/update_treatment.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#resitrtable').html(loadershowmini);
           },
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            tdetalles(idt);
            }
   })  
    event.preventDefault();
}
 }


/*tratamiento*/
/*bedmodals*/
function showvar(idxx, vari){
    $.ajax({
      type: "POST",
      url: "./ajax/s_"+vari+".php",
      data: {idxx:idxx},
      beforeSend: function(objeto){
            $('#s_'+vari).html(loadershow);
         },
        success:function(data){   
switch(vari) {
  case "floor":
     $('#s_'+vari).html(data);
     $('#s_room').html("");
     $('#s_bed').html("");  
    break;
  case "room":
      $('#s_'+vari).html(data);
     $('#s_bed').html("");  
    break;
  case "bed":
      $('#s_'+vari).html(data);
    break;
  default:
}  }
  })  
   event.preventDefault();
}

function bedselect(ed, pi, ha, be, idb){
Swal.fire({
  title: 'Estas seguro?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then((result) => {
  if (result.isConfirmed) {
    var pat= ed+"-"+pi+"-"+ha+"-"+be;
$('[name="cama_residente"]').val(pat);
$('[name="bedid"]').val(idb);
  }
})
}
/*bedmodals*/

/*detalles*/
async function detalles(id, uid){
      $.ajax({
      type: "POST",
      url: './ajax/detalles_residente.php',
      data: {id:id, uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }
   /*detalles*/

function trquest(){
      Swal.fire(
         'Por favor, indica la cantidad total de unidades del medicamento a la semana',
          )
   }

   /* edit */ 

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

function r_live_up_chk(idc, val, rid){
  $.ajax({
      type: "POST",
      url: "./saves/update_field_chk.php",
      data: {id:idc, val:val},
        success:function(){      
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1500,
          })       
          loadcontact(rid); 
        }
         }) 
}

/*status residente */

function save_sta(){
   var s_status = $('#ssta').val(); 
   var f_status = $('#fecha_status').val();
   var m_status = $('#motivo_status').val();
   var x_status = $('#situa_status').val();
if (m_status == "" || m_status == null || f_status == "" || f_status == null || s_status=="N/A" || x_status == "" || x_status == null) {
   Swal.fire({
               icon: 'error',
               title: 'Todos los campos son requeridos',
               showConfirmButton: false,
               timer: 1500
               })
}
else {
 var parametros = $('#save_stat').find('select, input').serialize();

    $.ajax({
         type: "POST",
         url: "./saves/save_status.php",
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
               console.log(data);
            loadstat(data);
            }
   })  
    event.preventDefault();
} 
   }


   function loadstat(id){
      $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/status_chk.php',
            data: {id:id},
             beforeSend: function(objeto){
             $('#stasta').html(loadershowmini);
           },
            success:function(data2){
               $("#stasta").html(data2).fadeIn('slow');   
            }
         })
   }

   /*status residente */


/*status ropa residente */

function save_ropasta(idr){
   var s_status = $('#status_ropastatus').val(); 
   var f_status = $('#fecha_ropastatus').val();
   var m_status = $('#motivo_ropastatus').val();
if (m_status == "" || m_status == null || f_status == "" || f_status == null || s_status=="N/A") {
   Swal.fire({
               icon: 'error',
               title: 'Todos los campos son requeridos',
               showConfirmButton: false,
               timer: 1500
               })
}
else {
 var parametros = $('#save_ropastat').find('select, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_ropastatus.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#rstalist').html(loadershowmini);
           },
            success:function(data){  
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
            loadropastat(data);
            }
   })  
    event.preventDefault();
} 
   }


   function loadropastat(idr){
      $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/status_ropachk.php',
            data: {idr:idr},
             beforeSend: function(objeto){
             $('#rstalist').html(loadershowmini);
           },
            success:function(data2){
               $("#rstalist").html(data2).fadeIn('slow');   
            }
         })
   }

   /*status ropa residente */


   function sta_trata(valu, idt, rid){
      $.ajax({
            async: true,
            type: "POST",
            url:'./saves/status_trata.php',
            data: {valu:valu, idt:idt},
            success:function(data2){
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
loadtrata(rid); 

            }
         })
   }


   function tdetalles(idt){
      $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/load_trataind.php',
            data: {idt:idt},
             beforeSend: function(objeto){
             $('#resitrtable').html(loadershowmini);
           },
            success:function(data2){
               $("#resitrtable").html(data2).fadeIn('slow');   
            }
         })
   };


   function showhide(tnew, tlist, tmovs, thist, mode, rid){
switch(mode) {
  case "new":
    $("#"+tmovs).hide();
    $("#"+thist).hide();
    $("#"+tlist).hide();
    $("#"+tnew).show();    
    loadpretrata(rid);
    break;
  case "hist":
    $("#"+tnew).hide();
    $("#"+tmovs).hide(); 
    $("#"+tlist).hide(); 
    $("#"+thist).show();               
    loadhisto(rid); 
    break;
   case "movs":
    $("#"+tnew).hide();
    $("#"+thist).show(); 
    $("#"+tlist).hide(); 
    $("#"+tmovs).show();               
    loadmovs(rid); 
    break;
  case "list":
    $("#"+tnew).hide();
    $("#"+tmovs).hide();
    $("#"+thist).hide();
    $("#"+tlist).show();   
    loadtrata(rid); 
    break;
  default:
         }   
}


   function mainshow(opt){
switch(opt) {
  case "gral2":
    $("#gral2").show();
    $("#gral3").hide();
    $("#gral4").hide();
    $("#gral5").hide();
    $("#gral6").hide();
    break;
  case "gral3":
    $("#gral3").show();
    $("#gral2").hide();
    $("#gral4").hide();
    $("#gral5").hide();
    $("#gral6").hide();
    break;
  case "gral4":
    $("#gral4").show();
    $("#gral2").hide();
    $("#gral3").hide();
    $("#gral5").hide();
    $("#gral6").hide();
    break;
  case "gral5":
    $("#gral5").show();
    $("#gral2").hide();
    $("#gral3").hide();
    $("#gral4").hide();
    $("#gral6").hide();
    break;
   case "gral6":
    $("#gral6").show();
    $("#gral1").show();
    $("#gral2").hide();
    $("#gral3").hide();
    $("#gral4").hide();
    $("#gral5").hide();
    break;
  default:
}   }


function viewpan(idt){
   $("#panview"+idt).fadeToggle("linear");
} 



function inve_live_up(tbl, tgt, opt, idi, rid){
   let opera_var= $("#ta_opera-"+idi).val();
  if (opera_var) { 
  $.ajax({
      type: "POST",
      url: "./saves/update_field_cant.php",
      data: {tbl:tbl, tgt:tgt, opt:opt, idi:idi, opera_var:opera_var, rid:rid},
        success:function(data){  
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 1500,
          })    
        }
         })
}     else     {

    Swal.fire({
               icon: 'error',
               title: 'Especifica la cantidad',
               showConfirmButton: false,
               timer: 1500
               })
      $("[name=sel-"+idi+"]").prop("selectedIndex", 0).val(); 

      }
 loadinv(rid);

         }



function gen_us_pass(){
    var min = 9999;
    var max = 1111;
var usr = Math.floor(Math.random()*(max-min+1)+min);
var pass = Math.floor(Math.random()*(max-min+1)+min);
var idr = $("[name=idr_pass]").val();
if (usr && pass) {
    $("[name=guest_usr]").val(usr);
    $("[name=guest_pass]").val(pass);
saveguest(idr, usr, pass);   
}

}


async function saveguest(idr, usr, pass){
     $.ajax({
      type: "POST",
      url: "./saves/save_guest.php",
      data: {idr:idr, usr:usr, pass:pass},
        success:function(data){  
          Swal.fire({
            icon: 'success',
            title: 'Correcto!!',
            showConfirmButton: false,
            timer: 2000,
          })    
        }
         })
}


