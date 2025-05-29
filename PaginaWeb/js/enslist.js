 
 // ARCHIVO: js/enslist.js
// Funciones para manejo de listas de enseres (activos y dados de baja)

// Variables globales
var currentResidentId = '';

// Función principal para cargar enseres activos
function loadenesactivos() {
    var rid = $('#tgtrid').val() || currentResidentId;
    if (!rid) {
        console.error('No se encontró ID del residente');
        return;
    }
    
    var searchQuery = $('#search-enseres-activos').val() || '';
    
    // Mostrar loading
    $('#contenedor-enseres-activos').html('<div style="text-align:center; padding:20px;"><i class="fa fa-spinner fa-spin"></i> Cargando enseres activos...</div>');
    
    $.ajax({
        url: './ajax/load_enslist.php',
        type: 'POST',
        data: {
            action: 'ajax',
            rid: rid,
            q: searchQuery
        },
        success: function(response) {
            $('#contenedor-enseres-activos').html(response);
            // Reinicializar contador después de cargar
            setTimeout(function() {
                updateSelectedCount();
            }, 100);
        },
        error: function(xhr, status, error) {
            $('#contenedor-enseres-activos').html('<div style="text-align:center; padding:20px; color:red;">Error al cargar enseres activos</div>');
            console.error('Error:', error);
        }
    });
}

// Función principal para cargar enseres dados de baja
function loadenesbaja() {
    var rid = $('#tgtrid').val() || currentResidentId;
    if (!rid) {
        console.error('No se encontró ID del residente');
        return;
    }
    
    var searchQuery = $('#search-enseres-baja').val() || '';
    
    // Mostrar loading
    $('#contenedor-enseres-baja').html('<div style="text-align:center; padding:20px;"><i class="fa fa-spinner fa-spin"></i> Cargando enseres dados de baja...</div>');
    
    $.ajax({
        url: './ajax/load_enslistbajas.php',
        type: 'POST',
        data: {
            action: 'ajax',
            rid: rid,
            q: searchQuery
        },
        success: function(response) {
            $('#contenedor-enseres-baja').html(response);
            // Reinicializar contador después de cargar
            setTimeout(function() {
                updateSelectedCountBaja();
            }, 100);
        },
        error: function(xhr, status, error) {
            $('#contenedor-enseres-baja').html('<div style="text-align:center; padding:20px; color:red;">Error al cargar enseres dados de baja</div>');
            console.error('Error:', error);
        }
    });
}

// Función para búsqueda en tiempo real - enseres activos
function searchEneresActivos() {
    clearTimeout(window.searchActivosTimeout);
    window.searchActivosTimeout = setTimeout(function() {
        loadenesactivos();
    }, 500);
}

// Función para búsqueda en tiempo real - enseres de baja
function searchEneresBaja() {
    clearTimeout(window.searchBajaTimeout);
    window.searchBajaTimeout = setTimeout(function() {
        loadenesbaja();
    }, 500);
}

// Función para cambiar status de enseres seleccionados (dar de baja)
function statusSelectedEnseres() {
    var selectedIds = [];
    $('.thecheckgralt:checked').each(function() {
        selectedIds.push($(this).val());
    });
    
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Sin selección',
            text: 'Selecciona al menos un ensere para cambiar status'
        });
        return;
    }
    
    // Mostrar modal de confirmación con formulario
    Swal.fire({
        title: 'Dar de baja enseres',
        html: `
            <div style="text-align: left; margin: 20px 0;">
                <p><strong>Enseres seleccionados:</strong> ${selectedIds.length}</p>
                <div style="margin: 15px 0;">
                    <label for="motivo-baja" style="display: block; margin-bottom: 5px;">Motivo de baja:</label>
                    <textarea id="motivo-baja" class="swal2-textarea" placeholder="Describe el motivo de la baja..." rows="3" style="width: 100%;"></textarea>
                </div>
                <div style="margin: 15px 0;">
                    <label for="persona-baja" style="display: block; margin-bottom: 5px;">Persona responsable:</label>
                    <input type="text" id="persona-baja" class="swal2-input" placeholder="Nombre completo" style="margin: 0;">
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Dar de baja',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        preConfirm: () => {
            const motivo = document.getElementById('motivo-baja').value.trim();
            const persona = document.getElementById('persona-baja').value.trim();
            
            if (!motivo || !persona) {
                Swal.showValidationMessage('Completa todos los campos');
                return false;
            }
            
            return { motivo: motivo, persona: persona };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            processStatusChange(selectedIds, result.value.motivo, result.value.persona);
        }
    });
}

// Procesar cambio de status (dar de baja)
function processStatusChange(selectedIds, motivo, persona) {
    var rid = $('#tgtrid').val() || currentResidentId;
    
    // Mostrar loading
    Swal.fire({
        title: 'Procesando...',
        text: 'Dando de baja enseres seleccionados',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: './saves/status_enseres_selected.php',
        type: 'POST',
        data: {
            rid: rid,
            selected_ids: selectedIds,
            motivo: motivo,
            persona: persona
        },
        success: function(response) {
            if (response.includes('success') || response.includes('Correcto')) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Correcto!',
                    text: 'Los enseres se han dado de baja correctamente',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    // Recargar ambas listas
                    loadenesactivos();
                    loadenesbaja();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al procesar la solicitud'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor'
            });
            console.error('Error:', error);
        }
    });
}

// Función para reactivar enseres seleccionados
function reactivateSelectedEnseres() {
    var selectedIds = [];
    $('.thecheckgraltbaja:checked').each(function() {
        selectedIds.push($(this).val());
    });
    
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Sin selección',
            text: 'Selecciona al menos un ensere para reactivar'
        });
        return;
    }
    
    // Mostrar modal de confirmación con formulario
    Swal.fire({
        title: 'Reactivar enseres',
        html: `
            <div style="text-align: left; margin: 20px 0;">
                <p><strong>Enseres seleccionados:</strong> ${selectedIds.length}</p>
                <div style="margin: 15px 0;">
                    <label for="motivo-reactivacion" style="display: block; margin-bottom: 5px;">Motivo de reactivación:</label>
                    <textarea id="motivo-reactivacion" class="swal2-textarea" placeholder="Describe el motivo de la reactivación..." rows="3" style="width: 100%;"></textarea>
                </div>
                <div style="margin: 15px 0;">
                    <label for="persona-reactivacion" style="display: block; margin-bottom: 5px;">Persona responsable:</label>
                    <input type="text" id="persona-reactivacion" class="swal2-input" placeholder="Nombre completo" style="margin: 0;">
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Reactivar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        preConfirm: () => {
            const motivo = document.getElementById('motivo-reactivacion').value.trim();
            const persona = document.getElementById('persona-reactivacion').value.trim();
            
            if (!motivo || !persona) {
                Swal.showValidationMessage('Completa todos los campos');
                return false;
            }
            
            return { motivo: motivo, persona: persona };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            processReactivation(selectedIds, result.value.motivo, result.value.persona);
        }
    });
}
function processReactivation() {
    var motivo = $('#reactivate_motivo').val().trim();
    var persona = $('#reactivate_persona').val().trim();
    var ids = $('#reactivate_ids').val();
    var rid = $('#reactivate_rid').val();
    
    if (!motivo || !persona) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos requeridos',
            text: 'Completa todos los campos obligatorios'
        });
        return;
    }
    
    // Mostrar loading
    Swal.fire({
        title: 'Procesando...',
        text: 'Reactivando enseres seleccionados',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: './saves/reactivate_enseres_selected.php',
        type: 'POST',
        data: {
            rid: rid,
            selected_ids: ids.split(','),
            motivo: motivo,
            persona: persona
        },
        success: function(response) {
            hideReactivateModal();
            if (response.includes('success')) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Reactivación exitosa!',
                    text: 'Los enseres se han reactivado correctamente',
                    showConfirmButton: false,
                    timer: 2500
                }).then(() => {
                    // Recargar las listas
                    if (typeof loadenesactivos === 'function') {
                        loadenesactivos();
                    }
                    if (typeof loadenesbaja === 'function') {
                        loadenesbaja();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la reactivación',
                    text: 'No se pudieron reactivar los enseres. Inténtalo de nuevo.'
                });
            }
        },
        error: function(xhr, status, error) {
            hideReactivateModal();
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor. Verifica tu conexión e inténtalo de nuevo.'
            });
        }
    });
}
// Procesar reactivación
function processReactivationN(selectedIds, motivo, persona) {
    var rid = $('#tgtrid').val() || currentResidentId;
    
    // Mostrar loading
    Swal.fire({
        title: 'Procesando...',
        text: 'Reactivando enseres seleccionados',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: './saves/reactivate_enseres_selected.php',
        type: 'POST',
        data: {
            rid: rid,
            selected_ids: selectedIds,
            motivo: motivo,
            persona: persona
        },
        success: function(response) {
            if (response.includes('success')) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Correcto!',
                    text: 'Los enseres se han reactivado correctamente',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    // Recargar ambas listas
                    loadenesactivos();
                    loadenesbaja();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al reactivar los enseres'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor'
            });
            console.error('Error:', error);
        }
    });
}

// Función para reactivar un ensere individual
function reactivateSingleEnsere(id, rid) {
    Swal.fire({
        title: 'Reactivar ensere',
        html: `
            <div style="text-align: left; margin: 20px 0;">
                <div style="margin: 15px 0;">
                    <label for="motivo-single-reactivacion" style="display: block; margin-bottom: 5px;">Motivo de reactivación:</label>
                    <textarea id="motivo-single-reactivacion" class="swal2-textarea" placeholder="Describe el motivo..." rows="3" style="width: 100%;"></textarea>
                </div>
                <div style="margin: 15px 0;">
                    <label for="persona-single-reactivacion" style="display: block; margin-bottom: 5px;">Persona responsable:</label>
                    <input type="text" id="persona-single-reactivacion" class="swal2-input" placeholder="Nombre completo" style="margin: 0;">
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Reactivar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#28a745',
        preConfirm: () => {
            const motivo = document.getElementById('motivo-single-reactivacion').value.trim();
            const persona = document.getElementById('persona-single-reactivacion').value.trim();
            
            if (!motivo || !persona) {
                Swal.showValidationMessage('Completa todos los campos');
                return false;
            }
            
            return { motivo: motivo, persona: persona };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            processReactivation([id], result.value.motivo, result.value.persona);
        }
    });
}

// Función para establecer el ID del residente actual
function setCurrentResidentId(rid) {
    currentResidentId = rid;
}

// Función para refrescar ambas listas
function refreshAllEnseres() {
    loadenesactivos();
    loadenesbaja();
}

// Inicialización cuando el documento esté listo
$(document).ready(function() {
    // Establecer ID del residente si existe
    if ($('#tgtrid').length > 0) {
        currentResidentId = $('#tgtrid').val();
    }
    
    // Event listeners para búsqueda
    $(document).on('keyup', '#search-enseres-activos', function() {
        searchEneresActivos();
    });
    
    $(document).on('keyup', '#search-enseres-baja', function() {
        searchEneresBaja();
    });
    
    // Event listeners para botones de refresh
    $(document).on('click', '.btn-refresh-activos', function() {
        loadenesactivos();
    });
    
    $(document).on('click', '.btn-refresh-baja', function() {
        loadenesbaja();
    });
});
 
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
/*
// Función para procesar el cambio de status de enseres seleccionados
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