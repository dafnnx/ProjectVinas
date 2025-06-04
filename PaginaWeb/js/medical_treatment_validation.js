// Validaciones para el formulario de tratamientos médicos
//medical_treatment_validation
// Función para habilitar/deshabilitar campos según el total semanal
function toggleFieldsByTotal() {
    const totalSemanal = document.getElementById('total_tratamiento');
    const diasCheckboxes = document.querySelectorAll('input[name="days[]"]');
    const diaTratamiento = document.querySelector('input[name="dia_tratamiento"]');
    const horariosInputs = document.querySelectorAll('.variant');
    
    // Función para habilitar/deshabilitar elementos
    function toggleElements(elements, enabled) {
        elements.forEach(element => {
            element.disabled = !enabled;
            if (!enabled) {
                if (element.type === 'checkbox') {
                    element.checked = false;
                } else {
                    element.value = '';
                }
            }
        });
    }
    
    totalSemanal.addEventListener('input', function() {
        const hasTotal = this.value && parseFloat(this.value) > 0;
        
        // Habilitar campos solo si hay total semanal
        toggleElements(diasCheckboxes, hasTotal);
        diaTratamiento.disabled = !hasTotal;
        toggleElements(horariosInputs, hasTotal);
        
        if (hasTotal) {
            // Agregar listeners para validación en tiempo real
            addValidationListeners();
        }
    });
}

// Función para agregar listeners de validación
function addValidationListeners() {
    const diasCheckboxes = document.querySelectorAll('input[name="days[]"]');
    const diaTratamiento = document.querySelector('input[name="dia_tratamiento"]');
    const horariosInputs = document.querySelectorAll('.variant');
    
    // Validar cuando cambian los días
    diasCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', validateTreatment);
    });
    
    // Validar cuando cambia la dosis por día
    diaTratamiento.addEventListener('input', validateTreatment);
    
    // Validar cuando cambian los horarios
    horariosInputs.forEach(input => {
        input.addEventListener('input', validateTreatment);
    });
}

// Función principal de validación
function validateTreatment() {
    const totalSemanal = parseFloat(document.getElementById('total_tratamiento').value) || 0;
    const diasSeleccionados = document.querySelectorAll('input[name="days[]"]:checked').length;
    const dosisPorDia = parseFloat(document.querySelector('input[name="dia_tratamiento"]').value) || 0;
    
    // Obtener horarios con dosis
    const horarios = {
        '7h': parseFloat(document.querySelector('input[name="siet_tratamiento"]').value) || 0,
        '8h': parseFloat(document.querySelector('input[name="och_tratamiento"]').value) || 0,
        '13h': parseFloat(document.querySelector('input[name="trce_tratamiento"]').value) || 0,
        '18h': parseFloat(document.querySelector('input[name="dieco_tratamiento"]').value) || 0,
        '21h': parseFloat(document.querySelector('input[name="vtuno_tratamiento"]').value) || 0
    };
    
    // Calcular total de dosis por horarios
    const totalHorarios = Object.values(horarios).reduce((sum, val) => sum + val, 0);
    
    // Validaciones
    const validations = performValidations(totalSemanal, diasSeleccionados, dosisPorDia, totalHorarios, horarios);
    
    // Mostrar resultados de validación
    displayValidationResults(validations);
    
    // Habilitar/deshabilitar botón de guardar
    const saveButton = document.getElementById('savetrata');
    saveButton.disabled = !validations.isValid;
    
    return validations.isValid;
}

// Función que realiza todas las validaciones
function performValidations(totalSemanal, diasSeleccionados, dosisPorDia, totalHorarios, horarios) {
    const errors = [];
    const warnings = [];
    
    // Validación 1: Total semanal debe coincidir con días × dosis por día
    const expectedTotal = diasSeleccionados * dosisPorDia;
    if (totalSemanal !== expectedTotal && diasSeleccionados > 0 && dosisPorDia > 0) {
        errors.push(`Total semanal (${totalSemanal}) no coincide con días seleccionados (${diasSeleccionados}) × dosis por día (${dosisPorDia}) = ${expectedTotal}`);
    }
    
    // Validación 2: Si hay dosis por día, debe haber horarios que sumen esa cantidad
    if (dosisPorDia > 0 && totalHorarios !== dosisPorDia) {
        errors.push(`La suma de horarios (${totalHorarios}) debe igualar la dosis por día (${dosisPorDia})`);
    }
    
    // Validación 3: No puede haber horarios sin dosis por día
    if (totalHorarios > 0 && dosisPorDia === 0) {
        errors.push('Debe especificar la dosis por día si hay horarios definidos');
    }
    
    // Validación 4: Verificar que los horarios sean lógicos
    const horariosConDosis = Object.entries(horarios).filter(([_, dosis]) => dosis > 0);
    if (horariosConDosis.length > 0 && diasSeleccionados === 0) {
        errors.push('Debe seleccionar al menos un día de la semana');
    }
    
    // Advertencias
    if (diasSeleccionados > 0 && dosisPorDia === 0) {
        warnings.push('Ha seleccionado días pero no ha especificado dosis por día');
    }
    
    if (dosisPorDia > 0 && horariosConDosis.length === 0) {
        warnings.push('Ha especificado dosis por día pero no ha definido horarios');
    }
    
    return {
        isValid: errors.length === 0,
        errors: errors,
        warnings: warnings,
        calculations: {
            diasSeleccionados,
            dosisPorDia,
            totalHorarios,
            expectedTotal,
            actualTotal: totalSemanal
        }
    };
}

// Función para mostrar los resultados de validación
function displayValidationResults(validations) {
    // Remover mensajes anteriores
    const existingMessage = document.querySelector('.validation-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Crear contenedor de mensajes
    const messageContainer = document.createElement('div');
    messageContainer.className = 'validation-message';
    messageContainer.style.cssText = `
        margin: 10px 0;
        padding: 10px;
        border-radius: 4px;
        font-size: 14px;
    `;
    
    if (validations.errors.length > 0) {
        messageContainer.style.backgroundColor = '#ffebee';
        messageContainer.style.border = '1px solid #f44336';
        messageContainer.style.color = '#c62828';
        
        const errorList = validations.errors.map(error => `• ${error}`).join('<br>');
        messageContainer.innerHTML = `<strong>Errores:</strong><br>${errorList}`;
    } else if (validations.warnings.length > 0) {
        messageContainer.style.backgroundColor = '#fff8e1';
        messageContainer.style.border = '1px solid #ff9800';
        messageContainer.style.color = '#ef6c00';
        
        const warningList = validations.warnings.map(warning => `• ${warning}`).join('<br>');
        messageContainer.innerHTML = `<strong>Advertencias:</strong><br>${warningList}`;
    } else if (validations.calculations.actualTotal > 0) {
        messageContainer.style.backgroundColor = '#e8f5e8';
        messageContainer.style.border = '1px solid #4caf50';
        messageContainer.style.color = '#2e7d32';
        messageContainer.innerHTML = '✓ Validación correcta: Todos los valores coinciden';
    }
    
    // Insertar mensaje después del campo total semanal
    const totalField = document.getElementById('total_tratamiento').parentNode;
    totalField.parentNode.insertBefore(messageContainer, totalField.nextSibling);
}

// Función para mostrar ayuda sobre el cálculo
function trquest() {
    const helpText = `
    <div style="background: #f5f5f5; padding: 15px; border-radius: 5px; margin: 10px 0;">
        <h4>Cómo calcular el total semanal:</h4>
        <p><strong>Fórmula:</strong> Días seleccionados × Dosis por día = Total semanal</p>
        <p><strong>Ejemplo 1:</strong> 5 días × 2 dosis = 10 tabletas/semana</p>
        <p><strong>Ejemplo 2:</strong> 7 días × 0.5 dosis = 3.5 tabletas/semana</p>
        <br>
        <h4>Horarios:</h4>
        <p>La suma de todos los horarios debe igualar la "Dosis por día"</p>
        <p><strong>Ejemplo:</strong> Si son 2 dosis al día: 7h=1, 18h=1</p>
    </div>`;
    
    // Crear modal o tooltip con la información
    const existingHelp = document.querySelector('.help-modal');
    if (existingHelp) {
        existingHelp.remove();
        return;
    }
    
    const helpModal = document.createElement('div');
    helpModal.className = 'help-modal';
    helpModal.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        z-index: 1000;
        max-width: 500px;
        width: 90%;
    `;
    
    helpModal.innerHTML = helpText + `
        <button onclick="this.parentElement.remove()" style="
            background: #007cba;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-top: 10px;
        ">Cerrar</button>
    `;
    
    document.body.appendChild(helpModal);
    
    // Crear overlay
    const overlay = document.createElement('div');
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 999;
    `;
    overlay.onclick = () => {
        helpModal.remove();
        overlay.remove();
    };
    
    document.body.appendChild(overlay);
}

// Función modificada para guardar con validación
function save_trata(rid) {
    // Realizar validación antes de guardar
    if (!validateTreatment()) {
        alert('Por favor corrija los errores de validación antes de guardar.');
        return false;
    }
    
    // Si la validación pasa, continuar con el guardado original
    // Aquí iría el código original de guardado
    console.log('Guardando tratamiento para residente:', rid);
    
    // Ejemplo de cómo podría ser la llamada AJAX
    /*
    $.ajax({
        url: 'save_treatment.php',
        method: 'POST',
        data: $('#formTratamiento').serialize(),
        success: function(response) {
            alert('Tratamiento guardado correctamente');
            // Limpiar formulario o redirigir
        },
        error: function() {
            alert('Error al guardar el tratamiento');
        }
    });
    */
}

// Inicializar validaciones cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    toggleFieldsByTotal();
    
    // Deshabilitar campos inicialmente
    const totalSemanal = document.getElementById('total_tratamiento');
    if (!totalSemanal.value) {
        const diasCheckboxes = document.querySelectorAll('input[name="days[]"]');
        const diaTratamiento = document.querySelector('input[name="dia_tratamiento"]');
        const horariosInputs = document.querySelectorAll('.variant');
        
        diasCheckboxes.forEach(cb => cb.disabled = true);
        diaTratamiento.disabled = true;
        horariosInputs.forEach(input => input.disabled = true);
    }
});

// Función auxiliar para validar números decimales
function validateDecimalInput(input) {
    const value = input.value;
    const regex = /^\d*\.?\d*$/;
    
    if (!regex.test(value)) {
        input.value = value.slice(0, -1);
    }
}