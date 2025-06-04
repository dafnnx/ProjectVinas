   $( "#selcnofig" ).submit(function( event ) {
  $('#savecnofig').attr("disabled", true);
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "./saves/save_cnofig.php",
			data: parametros,
				success:function(data2){			
					Swal.fire({
  					icon: 'success',
  					title: 'Correcto!!',
  					showConfirmButton: false,
  					timer: 1500
					})
				$('#savecnofig').attr("disabled", false);	
				load(1);	
				}
	})  
	 event.preventDefault();
})

function bckup(){
	 $.ajax({
			url: "./classes/dmp/ext.php",
				success:function(data2){			
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