      <div class="gralmid" id="gral5">  
        <div class="miniseparator"></div>
        <div class="paycnt">
<div class="icnsmicro microplus pad5 mar5" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'new', '<?php echo $rid; ?>');"></div>   
<div class="icnsmicro microsea pad5 mar5" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'list', '<?php echo $rid; ?>');"></div>
<a href="reportes/exp_tratas.php?idr=<?php echo $rid;?>"><div class="microprint icnsmicro pad5 mar5" title='Imprimir'></div></a>
    <!--     <div class="btnpay pointer" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'hist', '<?php echo $rid; ?>');">Inactivos</div>
            <div class="btnpay pointer" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'movs', '<?php echo $rid; ?>');">Movimientos</div> 
    -->
                     
        </div>        
<div id="upfrtr" class="tnew">
<table class="infotabtr cien">  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">
  <input type="hidden" name="resic_treat" value="<?php echo $rid; ?>">
  <input type="hidden" name="id_treat" value="<?php echo $idt; ?>">
  <tr>
    <td>Inicio</td>
    <td>Fin</td>   
    <td>Descripción</td>
    <td class="textcenter">L</td> 
    <td class="textcenter">M</td>
    <td class="textcenter">X</td>
    <td class="textcenter">J</td>
    <td class="textcenter">V</td>
    <td class="textcenter">S</td>
    <td class="textcenter">D</td>  
    <td>Día</td>
    <td>7h</td>
    <td>8h</td>
    <td>13H</td>
    <td>18H</td>
    <td>21H</td>
  </tr>
  <tr>
    <td><input class="nputs w95" type="date" name="fecha_ini" id="fecha_ini"></td>  
    <td><input class="nputs w95" type="date" name="fecha_fin" id="fecha_fin" onchange="date_check(this.value);"></td>  
    <td>
        <select class="nputs w450" lang="es" onchange="spec_viauni(this.value);">
            <option selected disabled>Medicamento</option>
<?php
    $query=$db2->prepare("SELECT * FROM inventarios WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++) {
    $idi= $row['medicamento_inv'];    
    $qty= $row['cantidad_inv'];

    $qury=$db2->prepare("SELECT nombre_medica AS nmed, unidad_medica AS unimed, via_medica AS viamed FROM medicamentos WHERE id_medica=:idi");
    $qury->bindParam(':idi', $idi);
    $qury->execute();
    for($i=0; $row = $qury->fetch(); $i++)  { 
    $nmed= $row['nmed'];
    $unimed= $row['unimed'];
    $viamed= $row['viamed'];        }

    $ury=$db2->prepare("SELECT nombre_unidad AS nuni FROM unidades WHERE id_unidad=:unimed");
    $ury->bindParam(':unimed', $unimed);
    $ury->execute();
    for($i=0; $row = $ury->fetch(); $i++)  { 
    $nuni= $row['nuni'];            
    }

    $ry=$db2->prepare("SELECT nombre_via AS nvia FROM vias WHERE id_via=:viamed");
    $ry->bindParam(':viamed', $viamed);
    $ry->execute();
    for($i=0; $row = $ry->fetch(); $i++)  { 
    $nvia= $row['nvia'];       
           }    ?>
            <option value="<?php echo $idi ?>, <?php echo $unimed ?>, <?php echo $viamed ?>"><?php echo $nmed?> - <?php echo $nuni?> - <?php echo $nvia?> - <?php echo $qty ?></option>
<?php    }    ?>
        </select>
    </td>  
    <input type="hidden" name="med_tratamiento">
    <input type="hidden" name="via_medicamento">
    <input type="hidden" name="unidad_medicamento">
    <td><input class="mar3" type="checkbox" value="1" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="2" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="3" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="4" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="5" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="6" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="7" name="days[]"></td> 
    <td><input class="variant" type="text" name="dia_tratamiento" autocomplete="off" ></td> 
    <td><input class="variant" type="text" name="siet_tratamiento" autocomplete="off"></td>  
    <td><input class="variant" type="text" name="och_tratamiento" autocomplete="off"></td>
    <td><input class="variant" type="text" name="trce_tratamiento" autocomplete="off"></td>
    <td><input class="variant" type="text" name="dieco_tratamiento" autocomplete="off"></td>
    <td><input class="variant" type="text" name="vtuno_tratamiento" autocomplete="off"></td>  
  </tr>
</table>
<div class="tratnfo">
<div class="frst">
  <input class="nputs w85per padd5" placeholder="Total semanal *" type="number" step="0.1" id="total_tratamiento" name="total_tratamiento"><div class="ask" onclick="trquest();"></div>
</div>
<!--<div class="subtrat9">
      <select id="rmpatologia" lang="es" class="slectfl" name="patolo_tratamiento">
        <option value="N/A">Patología</option>
      </select>
  </div>-->
  <div class="frst mleftmini">
    <select class="nputs w100per" lang="es" name="tipomed_tratamiento">
            <option value="N/A" selected >Tipo</option>
            <option>Aguda</option>
            <option>Cronica</option>
            <option>Placebo</option>
            <option>Urgente</option>
    </select>
  </div>  
<div class="frst mleftmini">
  <input class="nputs w100per padd4" name="pauta_tratamiento" placeholder="Pauta">
</div>
<div class="frst frsthalf mleftmini"> 
    <select class="nputs w100per padd4" lang="es" id="consul_tratamiento" name="consul_tratamiento">
            <option selected disabled>Consulta relacionada</option>
<?php
    $query=$db2->prepare("SELECT * FROM nota_medica WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){
    $idn= $row['id_notamed'];
    $fnm= $row['fec_notamed'];
    $mot= $row['motivo_notamed']; 

$fcon = new DateTime($fnm);
$fconn = $fcon->format("d-M-Y");
    ?>
            <option value="<?php echo $idn ?>"><?php echo $mot ?> - <?php echo $fconn ?></option>
     <?php      }    ?>
    </select>
</div>
</div>  
<div class="tratnfo">
   Por Razón Necesaria  <input class="mar3" type="checkbox" name="variante_tratamiento">
</div>
<div class="addmeds">
            <textarea class="tarea95new" name="observa_tratamiento" placeholder="Observaciones / Descripción" ></textarea>
</div>   
        <div class="separator"></div>
    <!--<button type="submit" class="nputsave" id="savetrata" onclick="save_trata('<?php echo $rid ?>');" >Guardar</button>  -->
    <button type="submit" class="nputsave" id="savetrata" onclick="save_trata_with_validation('<?php echo $rid ?>');" >Guardar</button>          
</div>
<div id="listfrtr" class="ldcntup2"></div>
    <div id="movsfrtr" class="ldcntup2"></div>
        <div id="histfrtr" class="ldcntup2"></div>    
     </div>
<?php require_once ("funcs.php"); ?>
























<script>
// Función para calcular y validar el total semanal del tratamiento
function calculateWeeklyTotal() {
    // Obtener días seleccionados
    const daysChecked = document.querySelectorAll('input[name="days[]"]:checked');
    const totalDays = daysChecked.length;
    
    // Obtener dosis por día
    const dosisPerDay = parseFloat(document.querySelector('input[name="dia_tratamiento"]').value) || 0;
    
    // Obtener las dosis de cada hora del día
    const dosis7h = parseFloat(document.querySelector('input[name="siet_tratamiento"]').value) || 0;
    const dosis8h = parseFloat(document.querySelector('input[name="och_tratamiento"]').value) || 0;
    const dosis13h = parseFloat(document.querySelector('input[name="trce_tratamiento"]').value) || 0;
    const dosis18h = parseFloat(document.querySelector('input[name="dieco_tratamiento"]').value) || 0;
    const dosis21h = parseFloat(document.querySelector('input[name="vtuno_tratamiento"]').value) || 0;
    
    // Calcular total de dosis por día (suma de todas las horas)
    const totalDosisPerDay = dosis7h + dosis8h + dosis13h + dosis18h + dosis21h;
    
    // Determinar qué usar: "Día" o suma de horas
    let finalDosisPerDay = 0;
    let usingHourlyDosis = false;
    
    if (dosisPerDay > 0 && totalDosisPerDay > 0) {
        // Ambos tienen valores, verificar consistencia
        usingHourlyDosis = true;
        finalDosisPerDay = dosisPerDay; // Usar el valor del día como referencia
    } else if (dosisPerDay > 0) {
        finalDosisPerDay = dosisPerDay;
    } else if (totalDosisPerDay > 0) {
        finalDosisPerDay = totalDosisPerDay;
        usingHourlyDosis = true;
    }
    
    // Calcular total semanal
    const calculatedWeeklyTotal = totalDays * finalDosisPerDay;
    
    return {
        days: totalDays,
        dosisPerDay: finalDosisPerDay,
        weeklyTotal: calculatedWeeklyTotal,
        usingHourlyDosis: usingHourlyDosis,
        dailyDosis: dosisPerDay,
        hourlyTotal: totalDosisPerDay,
        hourlyDosis: {
            h7: dosis7h,
            h8: dosis8h,
            h13: dosis13h,
            h18: dosis18h,
            h21: dosis21h
        }
    };
}

// Función para validar el total semanal ingresado
function validateWeeklyTotal() {
    const calculation = calculateWeeklyTotal();
    const inputTotal = parseFloat(document.getElementById('total_tratamiento').value) || 0;
    
    // Validar que hay días seleccionados
    if (calculation.days === 0) {
        return {
            isValid: false,
            error: 'DAYS_REQUIRED',
            message: 'Debe seleccionar al menos un día de la semana'
        };
    }
    
    // Validar que hay dosis configurada
    if (calculation.dosisPerDay === 0) {
        return {
            isValid: false,
            error: 'DOSIS_REQUIRED',
            message: 'Debe ingresar la dosis por día o configurar las horas individuales'
        };
    }
    
    // Validar que hay total semanal ingresado
    if (inputTotal === 0) {
        return {
            isValid: false,
            error: 'TOTAL_REQUIRED',
            message: 'Debe ingresar el total semanal'
        };
    }
    
    // Validar consistencia entre día y horas si ambos están llenos
    if (calculation.dailyDosis > 0 && calculation.hourlyTotal > 0) {
        const tolerance = 0.01;
        if (Math.abs(calculation.dailyDosis - calculation.hourlyTotal) > tolerance) {
            return {
                isValid: false,
                error: 'INCONSISTENT_DOSIS',
                message: `Inconsistencia: El campo "Día" (${calculation.dailyDosis}) no coincide con la suma de horas (${calculation.hourlyTotal})`,
                calculation: calculation
            };
        }
    }
    
    // Validar que el total semanal coincide
    const tolerance = 0.01;
    const isValid = Math.abs(inputTotal - calculation.weeklyTotal) < tolerance;
    
    if (!isValid) {
        return {
            isValid: false,
            error: 'TOTAL_MISMATCH',
            message: `El total semanal ingresado (${inputTotal}) no coincide con el cálculo automático (${calculation.weeklyTotal})`,
            calculation: calculation,
            inputTotal: inputTotal
        };
    }
    
    return {
        isValid: true,
        calculation: calculation,
        inputTotal: inputTotal
    };
}

// Función para mostrar información de validación en modal
function showValidationInfo(validationResult) {
    let messageText = '';
    let title = '';
    let statusClass = '';
    
    if (validationResult.isValid) {
        title = '✅ Validación Correcta';
        statusClass = 'success';
        messageText = `
            <div class="calc-details">
                <div class="success-message">
                    <div class="success-icon">✅</div>
                    <div class="success-text">¡Todos los cálculos son correctos!</div>
                </div>
                <div class="calc-row">
                    <span class="calc-label">Días seleccionados:</span>
                    <span class="calc-value">${validationResult.calculation.days}</span>
                </div>
                <div class="calc-row">
                    <span class="calc-label">Dosis por día:</span>
                    <span class="calc-value">${validationResult.calculation.dosisPerDay}</span>
                </div>
                <div class="calc-row calc-formula">
                    <span class="calc-label">Cálculo:</span>
                    <span class="calc-value">${validationResult.calculation.days} × ${validationResult.calculation.dosisPerDay} = ${validationResult.calculation.weeklyTotal}</span>
                </div>
                <div class="calc-row">
                    <span class="calc-label">Total ingresado:</span>
                    <span class="calc-value">${validationResult.inputTotal}</span>
                </div>
                ${validationResult.calculation.usingHourlyDosis ? '<div class="calc-note">✓ Usando configuración de horas</div>' : ''}
            </div>
        `;
    } else {
        title = 'Error de Validación';
        statusClass = 'error';
        
        switch (validationResult.error) {
            case 'DAYS_REQUIRED':
                messageText = `
                    <div class="error-message">
                        <div class="error-text">${validationResult.message}</div>
                        <div class="error-hint">Seleccione los días de la semana en los que se aplicará el tratamiento.</div>
                    </div>
                `;
                break;
                
            case 'DOSIS_REQUIRED':
                messageText = `
                    <div class="error-message">
                        <div class="error-text">${validationResult.message}</div>
                        <div class="error-hint">Complete el campo "Día" o configure las dosis por horas (7h, 8h, 13h, 18h, 21h).</div>
                    </div>
                `;
                break;
                
            case 'TOTAL_REQUIRED':
                messageText = `
                    <div class="error-message">
                        <div class="error-text">${validationResult.message}</div>
                    </div>
                `;
                break;
                
            case 'INCONSISTENT_DOSIS':
                messageText = `
                    <div class="error-message">
                        <div class="error-text">${validationResult.message}</div>
                        <div class="error-details">
                            <div class="detail-row">
                                <span>Campo "Día":</span>
                                <span class="detail-value">${validationResult.calculation.dailyDosis}</span>
                            </div>
                            <div class="detail-row">
                                <span>Suma de horas:</span>
                                <span class="detail-value">${validationResult.calculation.hourlyTotal}</span>
                            </div>
                            <div class="detail-breakdown">
                                <div class="breakdown-title">Desglose por horas:</div>
                                <div class="breakdown-items">
                                    <span>7h: ${validationResult.calculation.hourlyDosis.h7}</span>
                                    <span>8h: ${validationResult.calculation.hourlyDosis.h8}</span>
                                    <span>13h: ${validationResult.calculation.hourlyDosis.h13}</span>
                                    <span>18h: ${validationResult.calculation.hourlyDosis.h18}</span>
                                    <span>21h: ${validationResult.calculation.hourlyDosis.h21}</span>
                                </div>
                            </div>
                        </div>
                        <div class="error-hint">Corrija uno de los dos valores para que coincidan.</div>
                    </div>
                `;
                break;
                
            case 'TOTAL_MISMATCH':
                messageText = `
                    <div class="error-message">
                        <div class="error-text">${validationResult.message}</div>
                        <div class="calc-details">
                            <div class="calc-row">
                                <span class="calc-label">Días seleccionados:</span>
                                <span class="calc-value">${validationResult.calculation.days}</span>
                            </div>
                            <div class="calc-row">
                                <span class="calc-label">Dosis por día:</span>
                                <span class="calc-value">${validationResult.calculation.dosisPerDay}</span>
                            </div>
                            <div class="calc-row calc-formula error-formula">
                                <span class="calc-label">Cálculo correcto:</span>
                                <span class="calc-value">${validationResult.calculation.days} × ${validationResult.calculation.dosisPerDay} = ${validationResult.calculation.weeklyTotal}</span>
                            </div>
                            <div class="calc-row error-input">
                                <span class="calc-label">Total ingresado:</span>
                                <span class="calc-value">${validationResult.inputTotal}</span>
                            </div>
                        </div>
                    </div>
                `;
                break;
        }
    }
    
    showModal(title, messageText, statusClass);
}

// Función modificada para guardar con validación ESTRICTA
function save_trata_with_validation(rid) {
    const validationResult = validateWeeklyTotal();
    
    if (!validationResult.isValid) {
        // Mostrar modal de error - NO permitir continuar
        showValidationInfo(validationResult);
        return false; // No continuar con el guardado
    }
    
    // Si la validación es exitosa, mostrar mensaje de éxito breve y continuar
    showSuccessAndProceed(rid, validationResult);
    return true;
}

// Función para mostrar éxito y proceder
function showSuccessAndProceed(rid, validationResult) {
   save_trata(rid);
}

// Función para auto-calcular y rellenar el total semanal
function autoCalculateTotal() {
    const calculation = calculateWeeklyTotal();
    
    // Validar que hay datos suficientes
    if (calculation.days === 0) {
        showModal('⚠️ Información Faltante', 
            '<div class="error-message"><div class="error-text">Debe seleccionar al menos un día de la semana antes de calcular.</div></div>', 
            'error');
        return;
    }
    
    if (calculation.dosisPerDay === 0) {
        showModal('⚠️ Información Faltante', 
            '<div class="error-message"><div class="error-text">Debe ingresar la dosis por día o configurar las horas individuales antes de calcular.</div></div>', 
            'error');
        return;
    }
    
    // Calcular y asignar
    document.getElementById('total_tratamiento').value = calculation.weeklyTotal;
    
    // Mostrar confirmación rápida
    const autoModal = document.createElement('div');
    autoModal.className = 'calc-modal info show quick-success';
    autoModal.innerHTML = `
        <div class="calc-modal-overlay">
            <div class="calc-modal-content quick-content">
                <div class="quick-success-content">
                    <div class="success-icon-large">🧮</div>
                    <div class="success-text-large">Calculado Automáticamente</div>
                    <div class="success-details">Total: ${calculation.weeklyTotal}</div>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(autoModal);
    
    setTimeout(() => {
        autoModal.remove();
    }, 1500);
    
    // Actualizar estilos visuales
    const totalField = document.getElementById('total_tratamiento');
    totalField.classList.add('calc-valid');
    totalField.classList.remove('calc-invalid');
}

// Función para crear y mostrar modales (mantenida igual)
function showModal(title, content, type = 'info') {
    // Remover modal existente si hay uno
    const existingModal = document.querySelector('.calc-modal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Crear modal
    const modal = document.createElement('div');
    modal.className = `calc-modal ${type}`;
    modal.innerHTML = `
        <div class="calc-modal-overlay">
            <div class="calc-modal-content">
                <div class="calc-modal-header">
                    <h3>${title}</h3>
                    <button class="calc-modal-close">&times;</button>
                </div>
                <div class="calc-modal-body">
                    ${content}
                </div>
                <div class="calc-modal-footer">
                    <button class="calc-modal-btn calc-modal-btn-primary" onclick="closeModal()">Entendido</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Event listeners para cerrar
    modal.querySelector('.calc-modal-close').onclick = closeModal;
    modal.querySelector('.calc-modal-overlay').onclick = function(e) {
        if (e.target === this) closeModal();
    };
    
    // Mostrar modal con animación
    setTimeout(() => modal.classList.add('show'), 10);
}

// Función para cerrar modal
function closeModal() {
    const modal = document.querySelector('.calc-modal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

// Función para mostrar modal de validación manual
function showQuickValidation() {
    const validationResult = validateWeeklyTotal();
    showValidationInfo(validationResult);
}

// Event listeners para validación en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    // Agregar eventos a todos los campos relevantes
    const fieldsToWatch = [
        'input[name="days[]"]',
        'input[name="dia_tratamiento"]',
        'input[name="siet_tratamiento"]',
        'input[name="och_tratamiento"]',
        'input[name="trce_tratamiento"]',
        'input[name="dieco_tratamiento"]',
        'input[name="vtuno_tratamiento"]',
        'input[name="total_tratamiento"]'
    ];
    
    fieldsToWatch.forEach(selector => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            element.addEventListener('change', function() {
                // Validación silenciosa para actualizar estilos
                const validationResult = validateWeeklyTotal();
                
                // Agregar clase visual al campo total
                const totalField = document.getElementById('total_tratamiento');
                const inputTotal = parseFloat(totalField.value) || 0;
                
                if (inputTotal > 0) {
                    totalField.classList.toggle('calc-valid', validationResult.isValid);
                    totalField.classList.toggle('calc-invalid', !validationResult.isValid);
                } else {
                    totalField.classList.remove('calc-valid', 'calc-invalid');
                }
            });
        });
    });
    
    // Agregar botones de validación
    const totalField = document.getElementById('total_tratamiento');
    if (totalField) {
        const validateBtn = document.createElement('button');
        validateBtn.type = 'button';
        validateBtn.textContent = 'Validar';
        validateBtn.className = 'calc-validate-btn';
        validateBtn.onclick = showQuickValidation;
        
        const autoBtn = document.createElement('button');
        autoBtn.type = 'button';
        autoBtn.textContent = 'Auto';
        autoBtn.className = 'calc-auto-btn';
        autoBtn.onclick = autoCalculateTotal;
        
        // Crear contenedor para botones
        const btnContainer = document.createElement('div');
        btnContainer.className = 'calc-btn-container';
        btnContainer.appendChild(validateBtn);
        btnContainer.appendChild(autoBtn);
        
        totalField.parentNode.appendChild(btnContainer);
    }
});

// Función para mostrar/ocultar la ayuda del cálculo en modal
function trquest() {
    const helpContent = `
        <div class="help-content">
            <div class="formula-section">
                <h4Cálculo</h4>
                <div class="formula-box">
                    <strong>Días seleccionados × Dosis por día = Total semanal</strong>
                </div>
            </div>
            
            <div class="methods-section">
                <h4>Formas de especificar dosis por día:</h4>
                <div class="method-item">
                    <span class="method-number">1</span>
                    <span class="method-text">Campo "Día": Un valor único para toda la dosis diaria</span>
                </div>
                <div class="method-item">
                    <span class="method-number">2</span>
                    <span class="method-text">Horas específicas: Suma de 7h + 8h + 13h + 18h + 21h</span>
                </div>
                <div class="method-item">
                    <span class="method-number">⚠️</span>
                    <span class="method-text"><strong>Importante:</strong> Si usa ambos métodos, deben coincidir exactamente</span>
                </div>
            </div>
            
           
          
        </div>
    `;
    
    showModal(' Guía de Cálculo de Tratamientos', helpContent, 'info');
}

</script>

<style>
/* Estilos para los modales de validación */
.calc-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.calc-modal.show {
    opacity: 1;
    visibility: visible;
}

.calc-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.calc-modal-content {
    background: white;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    max-width: 500px;
    width: 100%;
    max-height: 80vh;
    display: flex;
    flex-direction: column;
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.calc-modal.show .calc-modal-content {
    transform: scale(1);
}

.calc-modal-header {
    padding: 20px 20px 15px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.calc-modal-header h3 {
    margin: 0;
    font-size: 1.2em;
    font-weight: 600;
    color: #333;
}

.calc-modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #999;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.calc-modal-close:hover {
    background: #f8f9fa;
    color: #666;
}

.calc-modal-body {
    padding: 20px;
    overflow-y: auto;
    flex: 1;
}

.calc-modal-footer {
    padding: 15px 20px 20px;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: flex-end;
}

.calc-modal-btn {
    padding: 8px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s ease;
}

.calc-modal-btn-primary {
    background: rgb(142,51,69);
    color: white;
}

.calc-modal-btn-primary:hover {
    background: rgb(185,51,78);
    transform: translateY(-1px);
}

/* Estilos específicos para validación */
.calc-modal.success .calc-modal-header {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
}

.calc-modal.error .calc-modal-header {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
}

.calc-modal.info .calc-modal-header {
    background: linear-gradient(135deg, rgb(188,164,108), rgb(217,200,168));
    color: #004085;
}

/* Detalles del cálculo */
.calc-details {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.calc-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f1f3f5;
}

.calc-row:last-child {
    border-bottom: none;
}

.calc-label {
    font-weight: 500;
    color: #495057;
}

.calc-value {
    font-weight: 600;
    color: #212529;
}

.calc-formula {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 6px;
    margin: 8px 0;
    border: 1px solid #e9ecef;
}

.calc-formula .calc-value {
    color: rgb(142,51,69);
    font-family: 'Courier New', monospace;
}

.calc-note {
    background: #fff3cd;
    color: #856404;
    padding: 8px 12px;
    border-radius: 4px;
    margin-top: 10px;
    font-size: 0.9em;
    border: 1px solid #ffeaa7;
}

/* Estilos para la ayuda */
.help-content {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.formula-section,
.methods-section,
.examples-section {
    margin-bottom: 20px;
}

.formula-section h4,
.methods-section h4,
.examples-section h4 {
    color: #495057;
    margin-bottom: 12px;
    font-size: 1.1em;
}

.formula-box {
    background: linear-gradient(135deg,rgb(188,164,108), rgb(217,200,168)  );
    color: white;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    font-size: 1.1em;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.method-item {
    display: flex;
    align-items: center;
    margin: 10px 0;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
    border-left: 4px solid rgb(142,51,69);
}

.method-number {
    background: rgb(142,51,69);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.9em;
    margin-right: 12px;
    flex-shrink: 0;
}

.method-text {
    flex: 1;
    color: #495057;
}

.example-item {
    margin: 12px 0;
    padding: 12px;
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.example-scenario {
    color: #495057;
    margin-bottom: 5px;
}

.example-result {
    color: #28a745;
    font-weight: 600;
    font-size: 1.05em;
}

/* Botones de validación */
.calc-btn-container {
    margin-top: 10px;
    display: flex;
    gap: 8px;
}

.calc-validate-btn,
.calc-auto-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.85em;
    font-weight: 500;
    transition: all 0.2s ease;
}

.calc-validate-btn {
    background: rgb(188,164,108);
    color: white;
}

.calc-validate-btn:hover {
    background: rgb(188,164,108);
    transform: translateY(-1px);
}

.calc-auto-btn {
    background: #28a745;
    color: white;
}

.calc-auto-btn:hover {
    background: #218838;
    transform: translateY(-1px);
}

/* Estilos visuales para el campo total */
.calc-valid {
    border: 2px solid #28a745 !important;
    background: #f8fff8 !important;
}

.calc-invalid {
    border: 2px solid #dc3545 !important;
    background: #fff8f8 !important;
}

/* Animaciones */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.calc-modal.error .calc-modal-content {
    animation: shake 0.5s ease-in-out;
}

/* Responsivo */
@media (max-width: 600px) {
    .calc-modal-content {
        margin: 10px;
        max-width: none;
    }
    
    .calc-modal-overlay {
        padding: 10px;
    }
    
    .calc-row {
        flex-direction: column;
        gap: 4px;
    }
    
    .calc-btn-container {
        flex-direction: column;
    }
    /* Mensajes de error mejorados */
.error-message {
    text-align: center;
    padding: 20px;
}

.error-icon, .success-icon {
    font-size: 3em;
    margin-bottom: 15px;
    display: block;
}

.error-text, .success-text {
    font-size: 1.1em;
    font-weight: 600;
    margin-bottom: 15px;
    color: #495057;
}

.error-hint {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 6px;
    color: #6c757d;
    font-size: 0.95em;
    border-left: 4px solid #ffc107;
    margin-top: 15px;
}

.error-details {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 6px;
    padding: 15px;
    margin: 15px 0;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px solid #f1f3f5;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-value {
    font-weight: 600;
    color: #dc3545;
}

.breakdown-title {
    font-weight: 600;
    margin: 10px 0 8px 0;
    color: #495057;
}

.breakdown-items {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.breakdown-items span {
    background: #e9ecef;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85em;
    color: #495057;
}

.error-formula {
    background: #f8d7da !important;
    border-color: #f5c6cb !important;
}

.error-input {
    background: #fff5f5;
    font-weight: 600;
}

.error-input .calc-value {
    color: #dc3545;
}

/* Mensaje de éxito mejorado */
.success-message {
    text-align: center;
    padding: 20px;
}

.success-icon {
    color: #28a745;
}

/* Modal de éxito rápido */
.quick-success {
    z-index: 10001;
}

.quick-content {
    max-width: 350px;
    padding: 0;
}

.quick-success-content {
    padding: 30px 20px;
    text-align: center;
}

.success-icon-large {
    font-size: 4em;
    margin-bottom: 15px;
    display: block;
}

.success-text-large {
    font-size: 1.3em;
    font-weight: 600;
    color: #28a745;
    margin-bottom: 10px;
}

.success-details {
    color: #6c757d;
    font-size: 0.95em;
}

/* Ejemplos con estado de error */
.error-example .example-scenario {
    color: #dc3545 !important;
    font-weight: 600;
}

.error-example .example-result {
    color: #dc3545 !important;
    background: #f8d7da;
    padding: 8px;
    border-radius: 4px;
}

/* Sección de validaciones */
.validation-section {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    margin-top: 20px;
}

.validation-section h4 {
    margin-bottom: 15px;
    color: #495057;
}

.validation-item {
    padding: 5px 0;
    color: #28a745;
    font-weight: 500;
}

.validation-item::before {
    content: '';
    margin-right: 8px;
}

/* Animaciones mejoradas */
@keyframes pulse-error {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

@keyframes pulse-success {
    0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
}

.calc-invalid {
    animation: pulse-error 1s;
}

.calc-valid {
    animation: pulse-success 1s;
}

/* Botones mejorados */
.calc-validate-btn:active,
.calc-auto-btn:active {
    transform: translateY(1px);
}

.calc-btn-container {
    display: flex;
    gap: 8px;
    margin-top: 8px;
}

/* Tooltips para botones */
.calc-validate-btn::after {
    content: 'Verificar cálculos';
    position: absolute;
    bottom: -35px;
    left: 50%;
    transform: translateX(-50%);
    background: #333;
    color: white;
    padding: 5px 8px;
    border-radius: 4px;
    font-size: 0.75em;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
    z-index: 1000;
}

.calc-validate-btn:hover::after {
    opacity: 1;
}

.calc-auto-btn::after {
    content: 'Calcular automáticamente';
    position: absolute;
    bottom: -35px;
    left: 50%;
    transform: translateX(-50%);
    background: #333;
    color: white;
    padding: 5px 8px;
    border-radius: 4px;
    font-size: 0.75em;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
    z-index: 1000;
}

.calc-auto-btn:hover::after {
    opacity: 1;
}

/* Posicionamiento relativo para tooltips */
.calc-btn-container {
    position: relative;
}

}</style>