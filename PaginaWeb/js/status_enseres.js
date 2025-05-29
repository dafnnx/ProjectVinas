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
function enseres_sta_selected(rid) {
    var mot = $("[name=motivo_ense]").val();
    var per = $("[name=persona_ense]").val();
    
    // Usar tu función existente que ya funciona
    var selectedIds = getSelectedEnseres();
    
    if (!mot || !per) {
        Swal.fire({
            icon: 'error',
            title: 'Todos los campos son requeridos',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }
    
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Selecciona al menos un enser',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }
    
    Swal.fire({
        title: '¿Estás seguro de dar de baja los enseres seleccionados?',
        text: `Se darán de baja ${selectedIds.length} enseres`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, dar de baja'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar al archivo PHP que maneja enseres seleccionados
            $.post("./saves/status_enseres_selected.php", {
                rid: rid,
                selected_ids: selectedIds,
                motivo: mot,
                persona: per
            }, function(response) {
                // Crear un contenedor temporal para ejecutar el JavaScript del PHP
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = response;
                
                // Buscar y ejecutar cualquier script que venga del PHP
                var scripts = tempDiv.getElementsByTagName('script');
                for (var i = 0; i < scripts.length; i++) {
                    eval(scripts[i].innerHTML);
                }
            });
                    }
    });
}
// Funciones para mostrar/ocultar modal
function showStatusModal() {
    $('#statusModal').show();
}

function hideStatusModal() {
    $('#statusModal').hide();
}