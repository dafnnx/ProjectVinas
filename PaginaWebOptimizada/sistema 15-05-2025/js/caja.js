var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';

	$(document).ready(function(){
			load(1);
		});

		function load(){
			var uusr = document.getElementById("usrlabel").value;
			var ires = document.getElementById("ires").value;
			var sta= 1;
			$.ajax({
				async: true,
				type: "POST",
				url:'./pages/finder2.php',
				data: {uid:uusr, sta:sta, ires:ires},
				 beforeSend: function(objeto){
				 $('#cajapres').html(loadershowmini);
			  },
				success:function(data2){
					$('#cajapres').html(data2).fadeIn('slow');			
				}
			})
		}	


	function eliminar (id, uid, sta, ires){
			$.ajax({
			async: true,
			type: "POST",
			url:'./saves/deletepre.php',
			data: {id:id, uid:uid, sta:sta, ires:ires},
			beforeSend: function(objeto){
				 $('#cajapres').html(loadershowmini);
			  },
			  success:function(data2){
					loadbox(uid, sta, ires);
				}
				});
	}


	function searind(uid){
		var nproducto= document.getElementById("nproducto").value;
		$.ajax({
			async: true,
			type: "POST",
			url:'./ajax/search2.php',
			data: {nproducto:nproducto, uid:uid},
			beforeSend: function(objeto){
				 $('#searbox').html(loadershowmini);
			  },
			  success:function(data2){
					$('#searbox').html(data2).fadeIn('slow');
				}
				});
	}

	function addfast(uid){
var rid=$('#resid').val();
if (rid==null) { 
		Swal.fire({
  	icon: 'warning',
  	title: 'Selecciona al residente',
  	showConfirmButton: true,
  	confirmButtonColor: 'rgb(0 99 140)',
					})
		$('#searbarras').val('');
}
else {
		var bno=$('#searbarras').val();
		$.ajax({
			async: true,
			type: "POST",
			url:'./saves/save_prefast.php',
			data: {uid:uid, bno:bno, rid:rid},
			beforeSend: function(objeto){
				 $('#cajapres').html(loadershowmini);
			  },
			  success:function(data2){
					$('#cajapres').html(data2).fadeIn('slow');
					$('#searbarras').val('');
					document.getElementById("searbarras").focus();
				}
				});
}
	}


		function addprods(idm, uid){
var rid=$('#resid').val();
if (rid==null) { 
		Swal.fire({
  	icon: 'warning',
  	title: 'Selecciona al residente',
  	showConfirmButton: true,
  	confirmButtonColor: 'rgb(0 99 140)',
					})
}
else {
		$.ajax({
			async: true,
			type: "POST",
			url:'./saves/save_pre.php',
			data: {idm:idm, uid:uid, rid:rid},
			beforeSend: function(objeto){
				 $('#cajapres').html(loadershowmini);
			  },
			  success:function(data2){
					$('#cajapres').html(data2).fadeIn('slow');
				}
				});
}
	}

		function loadbox(uid, sta, ires){
			$.ajax({
				async: true,
				type: "POST",
				url:'./pages/finder2.php',
				data: {uid:uid, sta:sta, ires:ires},
				 beforeSend: function(objeto){
				 $('#cajapres').html(loadershowmini);
			  },
				success:function(data2){
					$("#cajapres").html(data2).fadeIn('slow');			
					document.getElementById("searbarras").focus();		
				}
			})
		}


function procesar(uid, amn, rid){
	$.ajax({
			async: true,
			type: "POST",
			url:'./saves/save_presale.php',
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
/*

*/

function assgn(rid, uid){
$('#ires').val(rid);
var sta="1";
			$.ajax({
			async: true,
			type: "POST",
			url:'./ajax/check_concept.php',
			data: {uid:uid},
			  success:function(data2){	 
			  	if (data2>=1) {
			  			$.ajax({
							async: true,
							type: "POST",
							url:'./saves/update_concept.php',
							data: {uid:uid, rid:rid},
			  success:function(data2){
			  			Swal.fire({
  						icon: 'success',
  						title: 'Actualización correcta',
  						showConfirmButton: true,
  						confirmButtonColor: 'rgb(0 99 140)',
							})	  
							loadbox(uid, sta, rid);
							}				
				})
			  	}
				}				
				})
	}