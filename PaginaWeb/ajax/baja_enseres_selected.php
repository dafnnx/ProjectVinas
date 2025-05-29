<?php
// Función para abrir modal y enviar solo los seleccionados
function abrirModalYEnviarSeleccionados() {
    var seleccionados = [];
    var rid = $('[name=resi_id]').val();
    
    // Obtener todos los checkboxes seleccionados
    $('.thecheckgralt:checked').each(function() {
        seleccionados.push($(this).val());
    });
    
    if (seleccionados.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: '¡Selecciona al menos un ensere!',
            text: 'Debe seleccionar los enseres que desea dar de baja',
            showConfirmButton: true
        });
        return;
    }
    
    // Cargar el modal con los datos de los enseres seleccionados
    $('#stabody').load("./ajax/sta_body_selected.php", {
        rid: rid,
        selected_items: seleccionados
    }, function() {
        // Abrir el modal después de cargar el contenido
        mdl(modenssta, 'ensstaclose');
    });
}

// Función mejorada para dar de baja solo los seleccionados
function enseres_sta_selected(rid) {
    var seleccionados = [];
    var motivo = $('[name=motivo_ense]').val();
    var persona = $('[name=persona_ense]').val();
    
    // Obtener los IDs de los enseres seleccionados desde el modal
    if (typeof selectedEnseres !== 'undefined' && selectedEnseres.length > 0) {
        seleccionados = selectedEnseres;
    } else {
        // Fallback: obtener desde checkboxes si están disponibles
        $('.thecheckgralt:checked').each(function() {
            seleccionados.push($(this).val());
        });
    }
    
    if (!motivo || !persona) {
        Swal.fire({
            icon: 'error',
            title: '¡Campos requeridos!',
            text: 'Debe completar el motivo y la persona responsable',
            showConfirmButton: true
        });
        return;
    }
    
    if (seleccionados.length === 0) {
        Swal.fire({
            icon: 'error',
            title: '¡No hay enseres seleccionados!',
            showConfirmButton: true
        });
        return;
    }
    
    // Confirmación antes de proceder
    Swal.fire({
        title: '¿Está seguro?',
        text: `Se darán de baja ${seleccionados.length} ensere(s) seleccionado(s)`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, dar de baja',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "./saves/baja_enseres_selected.php",
                data: {
                    rid: rid,
                    selected_items: seleccionados,
                    motivo_ense: motivo,
                    persona_ense: persona
                },
                beforeSend: function() {
                    $('#ensedown_answ').html(loadershowmini);
                },
                success: function(response) {
                    try {
                        var result = JSON.parse(response);
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Correcto!',
                                text: `${result.affected_rows} ensere(s) dado(s) de baja exitosamente`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            
                            // Cerrar modal
                            modenssta.style.display = "none";
                            
                            // Recargar la lista de enseres
                            ens_list(rid);
                            
                            // Limpiar selecciones
                            $('.thecheckgralt').prop('checked', false);
                            $('#checkgral').text('');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.message || 'Error al dar de baja los enseres',
                                showConfirmButton: true
                            });
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        $('#ensedown_answ').html(response);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo procesar la solicitud',
                        showConfirmButton: true
                    });
                }
            });
        }
    });
}

// Función para manejar selección de todos los checkboxes
$(document).ready(function() {
    // Checkbox maestro para seleccionar/deseleccionar todos
    $('#boxgral').change(function() {
        var isChecked = $(this).is(':checked');
        $('.thecheckgralt').prop('checked', isChecked);
        updateSelectionCounter();
    });
    
    // Actualizar contador cuando se seleccionen checkboxes individuales
    $(document).on('change', '.thecheckgralt', function() {
        updateSelectionCounter();
        
        // Si todos están seleccionados, marcar el checkbox maestro
        var total = $('.thecheckgralt').length;
        var selected = $('.thecheckgralt:checked').length;
        $('#boxgral').prop('checked', selected === total && total > 0);
    });
});

// Función para actualizar el contador de elementos seleccionados
function updateSelectionCounter() {
    var selected = $('.thecheckgralt:checked').length;
    var total = $('.thecheckgralt').length;
    
    if (selected > 0) {
        $('#checkgral').text(`${selected} de ${total} seleccionados`);
    } else {
        $('#checkgral').text('');
    }
}

// Mantener las funciones originales para compatibilidad
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
            // Resetear selecciones después de recargar
            setTimeout(function() {
                updateSelectionCounter();
            }, 100);
        }
    });  
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
    });  
}