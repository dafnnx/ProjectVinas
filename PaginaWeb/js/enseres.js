  var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
  var loadershow = '<img src="./img/vinasloader.svg" width="50%" style="margin: 0 auto;display: flex;">';


/*residente*/

      $(document).ready(function(){
         loadenseres(1);
      });

      function loadenseres(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_ense.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_res').html(loadershow);
           },
            success:function(data2){
               $("#subsea_res").html(data2).fadeIn('slow');   
            }
         })
      }  

/*residente*/

/*elminar*/
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
     loadenseres(uid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 
}

/*elminar*/



/***
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */

// AGREGAR ESTAS FUNCIONES A TU ARCHIVO DE ENSERES (ej: js/enseres.js o js/enslist.js)

// Función para obtener los enseres seleccionados
function getSelectedEnseres() {
    var selectedIds = [];
    $('.thecheckgralt:checked').each(function() {
        selectedIds.push($(this).val());
    });
    return selectedIds;
}

// Función modificada para el botón Status
function statusSelectedEnseres() {
    var selectedIds = getSelectedEnseres();
    
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Sin selección',
            text: 'Debe seleccionar al menos un enser para cambiar su status',
            showConfirmButton: true
        });
        return;
    }
    
    var rid = $('#tgtrid').val();
    
    // Cargar el modal con la información de enseres seleccionados
    $.ajax({
        type: "POST",
        url: './ajax/sta_body_selected.php',
        data: {
            rid: rid,
            selected_ids: selectedIds
        },
        beforeSend: function() {
            $('#status_modal_body').html(loadershow);
        },
        success: function(data) {
            $('#status_modal_body').html(data);
            showStatusModal();
        }
    });
}

// Función para procesar el cambio de status de enseres seleccionados
/*
function enseres_sta_selected(rid) {
    var selectedIds = getSelectedEnseres();
    var motivo = $('input[name="motivo_ense"]').val();
    var persona = $('input[name="persona_ense"]').val();
    
    if (!motivo.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'Campo requerido',
            text: 'Debe ingresar el motivo de salida'
        });
        return;
    }
    
    if (!persona.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'Campo requerido',
            text: 'Debe ingresar la persona responsable'
        });
        return;
    }
    
    $.ajax({
        type: "POST",
        url: './saves/status_enseres_selected.php',
        data: {
            rid: rid,
            selected_ids: selectedIds,
            motivo: motivo,
            persona: persona
        },
        beforeSend: function() {
            $('#ensedown_answ').html(loadershowmini);
        },
        success: function(response) {
            try {
                var result = JSON.parse(response);
                Swal.fire({
                    icon: result.status === 'success' ? 'success' : 'error',
                    title: result.status === 'success' ? '¡Correcto!' : 'Error',
                    text: result.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                
                if (result.status === 'success') {
                    hideStatusModal();
                    // Recargar la lista de enseres - ajusta según tu función
                    loadenseres(); // o la función que uses para recargar
                }
            } catch (e) {
                $('#ensedown_answ').html(response);
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ha ocurrido un error al procesar la solicitud'
            });
        }
    });
}
*/
// Funciones para mostrar/ocultar modal
function showStatusModal() {
    $('#statusModal').show();
}

function hideStatusModal() {
    $('#statusModal').hide();
}