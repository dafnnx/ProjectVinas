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
    if (dosisPerDay > 0) {
        finalDosisPerDay = dosisPerDay;
    } else if (totalDosisPerDay > 0) {
        finalDosisPerDay = totalDosisPerDay;
    }
    
    // Calcular total semanal
    const calculatedWeeklyTotal = totalDays * finalDosisPerDay;
    
    return {
        days: totalDays,
        dosisPerDay: finalDosisPerDay,
        weeklyTotal: calculatedWeeklyTotal,
        usingHourlyDosis: dosisPerDay === 0 && totalDosisPerDay > 0
    };
}

// Función para validar el total semanal ingresado
function validateWeeklyTotal() {
    const calculation = calculateWeeklyTotal();
    const inputTotal = parseFloat(document.getElementById('total_tratamiento').value) || 0;
    
    const isValid = Math.abs(inputTotal - calculation.weeklyTotal) < 0.01; // Tolerancia para decimales
    
    // Mostrar información de validación
    showValidationInfo(calculation, inputTotal, isValid);
    
    return isValid;
}

// Función para mostrar información de validación en modal
function showValidationInfo(calculation, inputTotal, isValid) {
    let messageText = `
        <div class="calc-details">
            <div class="calc-row">
                <span class="calc-label">Días seleccionados:</span>
                <span class="calc-value">${calculation.days}</span>
            </div>
            <div class="calc-row">
                <span class="calc-label">Dosis por día:</span>
                <span class="calc-value">${calculation.dosisPerDay}</span>
            </div>
            <div class="calc-row calc-formula">
                <span class="calc-label">Cálculo:</span>
                <span class="calc-value">${calculation.days} × ${calculation.dosisPerDay} = ${calculation.weeklyTotal}</span>
            </div>
            <div class="calc-row">
                <span class="calc-label">Total ingresado:</span>
                <span class="calc-value">${inputTotal}</span>
            </div>
            ${calculation.usingHourlyDosis ? '<div class="calc-note">📝 Usando suma de dosis por horas</div>' : ''}
        </div>
    `;
    
    const title = isValid ? '✅ Validación Correcta' : '❌ Error en el Cálculo';
    const statusClass = isValid ? 'success' : 'error';
    
    showModal(title, messageText, statusClass);
}

// Función para auto-calcular y rellenar el total semanal
function autoCalculateTotal() {
    const calculation = calculateWeeklyTotal();
    document.getElementById('total_tratamiento').value = calculation.weeklyTotal;
    validateWeeklyTotal();
}

// Función modificada para guardar con validación
function save_trata_with_validation(rid) {
    if (!validateWeeklyTotal()) {
        if (confirm('El total semanal no coincide con el cálculo automático. ¿Desea continuar de todos modos?')) {
            save_trata(rid); // Llamar a la función original
        }
    } else {
        save_trata(rid); // Llamar a la función original
    }
}

// Función para crear y mostrar modales
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

// Función para mostrar modal de validación en tiempo real (opcional)
function showQuickValidation() {
    const calculation = calculateWeeklyTotal();
    const inputTotal = parseFloat(document.getElementById('total_tratamiento').value) || 0;
    const isValid = Math.abs(inputTotal - calculation.weeklyTotal) < 0.01;
    
    if (inputTotal > 0) { // Solo mostrar si hay algo en el campo total
        showValidationInfo(calculation, inputTotal, isValid);
    }
}
// Event listeners para validación en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    // Agregar eventos a todos los campos relevantes (validación silenciosa)
    const fieldsToWatch = [
        'input[name="days[]"]',
        'input[name="dia_tratamiento"]',
        'input[name="siet_tratamiento"]',
        'input[name="och_tratamiento"]',
        'input[name="trce_tratamiento"]',
        'input[name="dieco_tratamiento"]',
        'input[name="vtuno_tratamiento"]'
    ];
    
    fieldsToWatch.forEach(selector => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            element.addEventListener('change', function() {
                // Validación silenciosa para actualizar estilos
                const calculation = calculateWeeklyTotal();
                const inputTotal = parseFloat(document.getElementById('total_tratamiento').value) || 0;
                const isValid = Math.abs(inputTotal - calculation.weeklyTotal) < 0.01;
                
                // Agregar clase visual al campo total
                const totalField = document.getElementById('total_tratamiento');
                if (inputTotal > 0) {
                    totalField.classList.toggle('calc-valid', isValid);
                    totalField.classList.toggle('calc-invalid', !isValid);
                } else {
                    totalField.classList.remove('calc-valid', 'calc-invalid');
                }
            });
        });
    });
    
    // Agregar botón de validación manual
    const totalField = document.getElementById('total_tratamiento');
    if (totalField) {
        const validateBtn = document.createElement('button');
        validateBtn.type = 'button';
        validateBtn.textContent = '🔍 Validar';
        validateBtn.className = 'calc-validate-btn';
        validateBtn.onclick = showQuickValidation;
        
        const autoBtn = document.createElement('button');
        autoBtn.type = 'button';
        autoBtn.textContent = '⚡ Auto';
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
                <h4>Cálculo</h4>
                <div class="formula-box">
                    <strong>Días seleccionados × Dosis por día = Total semanal</strong>
                </div>
            </div>
            
            <div class="methods-section">
                <h4>💊 Dosis por día puede ser:</h4>
                <div class="method-item">
                    <span class="method-number">1</span>
                    <span class="method-text">El valor del campo "Día"</span>
                </div>
                <div class="method-item">
                    <span class="method-number">2</span>
                    <span class="method-text">La suma de: 7h + 8h + 13h + 18h + 21h</span>
                </div>
            </div>
            
            <div class="examples-section">
                <h4>Ejemplos Prácticos</h4>
                <div class="example-item">
                    <div class="example-scenario">5 días (Lunes a Viernes) × 2 dosis por día</div>
                    <div class="example-result">= 10 total semanal</div>
                </div>
                <div class="example-item">
                    <div class="example-scenario">1 día × (0.25 + 0.25 + 0.25 + 0.25) dosis</div>
                    <div class="example-result">= 1 total semanal</div>
                </div>
                <div class="example-item">
                    <div class="example-scenario">7 días × 1.5 dosis por día</div>
                    <div class="example-result">= 10.5 total semanal</div>
                </div>
            </div>
        </div>
    `;
    
    showModal('Guía de Cálculo Semanal', helpContent, 'info');
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
    background: linear-gradient(135deg, #cce7ff, #b3d9ff);
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
    background: linear-gradient(135deg,rgb(102,24,28) 0%,rgb(185,51,78) 100%);
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
    background: #17a2b8;
    color: white;
}

.calc-validate-btn:hover {
    background: #138496;
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
}</style>