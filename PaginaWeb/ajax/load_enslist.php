<?php	
$rid =$_POST['rid']; 
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
         $q =$_POST['q'];
		 
		 // ========== OBTENER INFORMACIÓN DEL RESIDENTE ==========
		 $resident_name = 'Residente no encontrado';
		 try {
			 $resident_query = $db2->prepare("SELECT nombre_residente FROM residentes WHERE id_residente = :rid");
			 $resident_query->bindParam(':rid', $rid, PDO::PARAM_INT);
			 $resident_query->execute();
			 $resident_info = $resident_query->fetch(PDO::FETCH_ASSOC);
			 if ($resident_info && isset($resident_info['nombre_residente'])) {
				 $resident_name = $resident_info['nombre_residente'];
			 }
		 } catch (Exception $e) {
			 // En caso de error, intentar con otra consulta
			 try {
				 $resident_query = $db2->prepare("SELECT nombre FROM residentes WHERE id_residente = :rid");
				 $resident_query->bindParam(':rid', $rid, PDO::PARAM_INT);
				 $resident_query->execute();
				 $resident_info = $resident_query->fetch(PDO::FETCH_ASSOC);
				 if ($resident_info && isset($resident_info['nombre'])) {
					 $resident_name = $resident_info['nombre'];
				 }
			 } catch (Exception $e2) {
				 // Si falla todo, usar el ID como referencia
				 $resident_name = 'Residente ID: ' . $rid;
			 }
		 }
		 
		 $aColumns = array('marca_ropa', 'nombre_ropa', 'talla_ropa', 'ingreso_ropa');
		 $sTable = "ropa_residente";		 
		 $sWhere = "";
		if ($q)	{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ")";
			$sWhere.= "AND id_residente='$rid' AND status_ropa='activo'";
			$sWhere.=" ORDER BY nombre_ropa ASC";
		} else {	
			$sWhere.= "WHERE id_residente='$rid' AND status_ropa='activo'";
			$sWhere.=" ORDER BY nombre_ropa ASC";					}		
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere ");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere LIMIT 250");
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
				<input type="hidden" value="<?php echo $rid; ?>" id="tgtrid">
				<!-- Almacenar el nombre del residente en un input hidden -->
				<input type="hidden" value="<?php echo htmlspecialchars($resident_name, ENT_QUOTES, 'UTF-8'); ?>" id="resident-name-hidden-activos">
				
				<!-- Debug: Mostrar nombre del residente -->
				<div style="display: none;" id="debug-info">
					Residente: <?php echo htmlspecialchars($resident_name, ENT_QUOTES, 'UTF-8'); ?>
					ID: <?php echo htmlspecialchars($rid, ENT_QUOTES, 'UTF-8'); ?>
				</div>
				
				<!-- Script para establecer nombre del residente -->
				<script>
					// Obtener información del residente
					var residentNameFromPHP = '<?php echo addslashes($resident_name); ?>';
					var residentIdFromPHP = '<?php echo addslashes($rid); ?>';
					
					console.log('=== DEBUG INFORMACIÓN DEL RESIDENTE ===');
					console.log('Resident name from PHP:', residentNameFromPHP);
					console.log('Resident ID from PHP:', residentIdFromPHP);
					console.log('Hidden input value:', $('#resident-name-hidden-activos').val());
					
					// Función para establecer el nombre
					function setResidentNameActivos(name) {
						window.currentResidentNameActivos = name;
						console.log('Nombre del residente activos establecido:', name);
					}
					
					// Establecer inmediatamente
					setResidentNameActivos(residentNameFromPHP);
					
					// También almacenar en variable global con múltiples referencias
					window.currentResidentNameActivos = residentNameFromPHP;
					window.currentResidentIdActivos = residentIdFromPHP;
					
					console.log('=== FIN DEBUG ===');
				</script>
				
				<!-- Barra de acciones para enseres seleccionados -->
				<div class="actions-bar" style="margin-bottom: 15px; padding: 10px; background-color: #f5f5f5; border-radius: 5px;">
					<div style="display: flex; align-items: center; gap: 10px;">
						<label style="font-weight: bold;">Acciones para seleccionados:</label>
								<div class="subpren10 mr1per">
								<input type="button" class="nputsave" value="Status" onclick="handleStatusClick()" title="Cambiar status de enseres seleccionados">
								</div>

								<div class="subpren10 mr1per">
								<input type="button" class="nputsave" value="Selec. Todos" onclick="selectAllEnseres()" title="Seleccionar todos">
								</div>

								<div class="subpren10">
								<input type="button" class="nputsave" value="Deselec. Todos" onclick="unselectAllEnseres()" title="Deseleccionar todos">
								</div>
						<span id="selected-count" style="margin-left: 10px; font-weight: bold; color: #007bff;">
							Seleccionados: 0
						</span>
					</div>
				</div>
				
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>		
					<th class='text-center'>
						<input type="checkbox" id="select-all-header" onchange="toggleAllCheckboxes(this)">
						<label for="select-all-header"><strong>Sel</label>
					</th>
					<th class='text-center'><strong>Nombre</th>
					<th class='text-center'><strong>Talla</th>
					<th class='text-center'><strong>Marca</th>
					<th class='text-center'><strong>Color</th>
					<th class='text-center'><strong>Observa</th>
					<th class='text-center'><strong>Fecha</th>
					<th class='text-center'><strong>Condición</th>					
					<th class='text-center'><strong>*</th>							
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idr=$row['id_rresidente'];
						$ida=$row['id_armario'];
						$apo=$row['apodo_residente'];
						$nr=$row['nombre_ropa'];
						$tr=$row['talla_ropa'];
						$mr=$row['marca_ropa'];	
						$or=$row['observa_ropa'];
						$ir=$row['ingreso_ropa'];
						$cr=$row['color_ropa'];	
						$er=$row['estado_ropa'];
						$star=$row['status_ropa'];							?>	
					<tr>
					<td>
						<input type="checkbox" class="thecheckgralt" value="<?php echo $idr; ?>" id="boxgral-<?php echo $idr; ?>" onchange="updateSelectedCount()">
					  <label for="boxgral-<?php echo $idr; ?>" class="mleft5"></label>
					</td>
<?php  if (!$nr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><?php echo $nr; ?></td><?php   }	?>
<?php  if (!$tr) {	?>	<td>N/A</td>    <?php } else { ?>	<td><?php echo $tr; ?></td><?php   }	?>
<?php  if (!$mr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><?php echo $mr; ?></td><?php   }	?>
<?php  if (!$cr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><input type="color" name="ense3" disabled value="<?php echo $cr; ?>" title="Color"></td><?php   }	?>
															<td title="<?php echo $or; ?>"><?php echo $or; ?></td>	
															<td ><?php	 $fecha = new DateTime($ir);  $cadfe = $fecha->format("d-M-Y");  echo $cadfe;?>	</td>
<?php  if (!$er) {	?>	<td>N/A</td>	<?php } else { 	?>	<td><?php echo $er; ?></td><?php   }	?>	
					<td ><!-- class="w60" -->
						
					  <a class='del' title='Eliminar' onclick="eliminar_ens('<?php echo $idr; ?>', 'ropa_residente', 'id_rresidente', '<?php echo $rid; ?>')"></a>	
					<!--	<a class='delstasingle' title='Status' onclick="mdlsing(modensstasingle, 'ensstaclosesingle', '<?php echo $idr; ?>', '<?php echo $rid; ?>')"></a> -->
					</td>									
					</tr>
					<?php   }	?>
			  </table>
			</div>
			
			<!-- Modal mejorado para cambio de status -->
			<div id="statusModal" class="modal" role="dialog" aria-labelledby="modal-title" aria-modal="true">
				<div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 0; border: none; width: 90%; max-width: 700px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
					
					<!-- Header del modal -->
					<div style="background-color: #dc3545; color: white; padding: 15px 20px; border-radius: 10px 10px 0 0; position: relative;">
						<h3 style="margin: 0; font-size: 18px;">Dar de Baja Enseres Seleccionados</h3>
						<span class="close" onclick="hideStatusModal()" aria-label="Cerrar modal" style="color: white; float: right; font-size: 28px; font-weight: bold; cursor: pointer; position: absolute; top: 10px; right: 15px;">&times;</span>
					</div>
					
					<!-- Contenido del modal -->
					<div style="padding: 20px;">
						
						<!-- Información del residente -->
						<div style="margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; border-left: 4px solid #dc3545;">
							<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
								<strong style="color: #495057;">Residente:</strong>
								<span id="status-resident-name" style="font-weight: bold; color: #dc3545;">Cargando...</span>
							</div>
							<div style="display: flex; justify-content: space-between; align-items: center;">
								<strong style="color: #495057;">Enseres seleccionados:</strong>
								<span id="status-selected-count" style="font-weight: bold; color: #dc3545;">0</span>
							</div>
						</div>
						
						<!-- Lista de enseres a procesar -->
						<div style="margin-bottom: 20px;">
							<h4 style="margin-bottom: 10px; color: #495057; font-size: 16px;">Enseres a procesar:</h4>
							<div style="max-height: 200px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 5px;">
								<table style="width: 100%; border-collapse: collapse;">
									<thead>
										<tr style="background-color: #f8f9fa;">
											<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dee2e6; font-size: 14px;">Nombre</th>
											<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dee2e6; font-size: 14px;">Talla</th>
											<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dee2e6; font-size: 14px;">Marca</th>
											<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dee2e6; font-size: 14px;">Estado</th>
										</tr>
									</thead>
									<tbody id="status-enseres-list">
										<!-- Se poblará dinámicamente -->
									</tbody>
								</table>
							</div>
						</div>
						
						<!-- Formulario de cambio de status -->
						<form id="statusForm">
							<input type="hidden" id="status_rid" value="">
							<input type="hidden" id="status_ids" value="">
							
							<div style="margin-bottom: 15px;">
								<label for="status_motivo" style="display: block; margin-bottom: 5px; font-weight: bold; color: #495057;">Motivo de la baja: <span style="color: #dc3545;">*</span></label>
								<textarea id="status_motivo" name="motivo" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; resize: vertical;" placeholder="Describe el motivo de la baja..." required></textarea>
							</div>
							
							<div style="margin-bottom: 20px;">
								<label for="status_persona" style="display: block; margin-bottom: 5px; font-weight: bold; color: #495057;">Persona responsable: <span style="color: #dc3545;">*</span></label>
								<input type="text" id="status_persona" name="persona" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" placeholder="Nombre de la persona responsable" required>
							</div>
							
							<!-- Botones de acción -->
							<div style="text-align: right; border-top: 1px solid #dee2e6; padding-top: 15px;">
								<button type="button" onclick="hideStatusModal()" style="margin-right: 10px; padding: 10px 20px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">
									Cancelar
								</button>
								<button type="button" onclick="processStatusChange()" style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">
									Dar de Baja
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<style>
			/* Estilos adicionales para el modal mejorado */
			#statusModal .modal-content button:hover {
				opacity: 0.9;
				transform: translateY(-1px);
			}

			#statusModal .close:hover {
				opacity: 0.8;
			}

			#status-enseres-list tr:nth-child(even) {
				background-color: #f8f9fa;
			}

			#status-enseres-list td {
				padding: 8px 10px;
				border-bottom: 1px solid #f0f0f0;
				font-size: 13px;
			}

			#statusModal textarea:focus,
			#statusModal input[type="text"]:focus {
				outline: none;
				border-color: #dc3545;
				box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.25);
			}

			#statusModal {
				display: none;
				position: fixed;
				z-index: 1000;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0,0,0,0.5);
			}
			</style>
			
<?php	} else {		echo "Sin enseres Activos";   	} }	 

/* include ("modal_single_enstatus.php"); */ ?>

<script type="text/javascript">
// Variable global para almacenar el nombre del residente activos
var currentResidentNameActivos = '';
var currentResidentIdActivos = '';

// Función mejorada para obtener el nombre del residente activos
function getResidentNameActivos() {
	console.log('=== getResidentNameActivos called ===');
	
	// Intentar obtener de múltiples fuentes en orden de prioridad
	var name = window.currentResidentNameActivos || 
			  $('#resident-name-hidden-activos').val() || 
			  currentResidentNameActivos ||
			  '';
	
	console.log('Sources checked:');
	console.log('- window.currentResidentNameActivos:', window.currentResidentNameActivos);
	console.log('- hidden input value:', $('#resident-name-hidden-activos').val());
	console.log('- currentResidentNameActivos:', currentResidentNameActivos);
	console.log('Final name selected:', name);
	
	return name || 'Residente no disponible';
}

// Función para establecer el nombre del residente activos
function setResidentNameActivos(name) {
	console.log('setResidentNameActivos called with:', name);
	window.currentResidentNameActivos = name;
	currentResidentNameActivos = name;
	
	// Verificar que se estableció correctamente
	console.log('Name set successfully. Verification:');
	console.log('- window.currentResidentNameActivos:', window.currentResidentNameActivos);
	console.log('- currentResidentNameActivos:', currentResidentNameActivos);
}

// Función para contar y mostrar enseres seleccionados
function updateSelectedCount() {
    var selectedCount = $('.thecheckgralt:checked').length;
    var totalCount = $('.thecheckgralt').length;
    
    console.log('updateSelectedCount - Selected:', selectedCount, 'of', totalCount);
    
    $('#selected-count').text('Seleccionados: ' + selectedCount);
    
    // Actualizar checkbox del header
    var headerCheckbox = $('#select-all-header');
    
    if (selectedCount === 0) {
        headerCheckbox.prop('indeterminate', false);
        headerCheckbox.prop('checked', false);
    } else if (selectedCount === totalCount) {
        headerCheckbox.prop('indeterminate', false);
        headerCheckbox.prop('checked', true);
    } else {
        headerCheckbox.prop('indeterminate', true);
    }
}

// Función para el checkbox del header
function toggleAllCheckboxes(headerCheckbox) {
    $('.thecheckgralt').prop('checked', headerCheckbox.checked);
    updateSelectedCount();
}

// Funciones para seleccionar/deseleccionar todos
function selectAllEnseres() {
    console.log('selectAllEnseres called');
    var checkboxes = $('.thecheckgralt');
    console.log('Found', checkboxes.length, 'checkboxes to select');
    checkboxes.prop('checked', true);
    updateSelectedCount();
}

function unselectAllEnseres() {
    console.log('unselectAllEnseres called');
    var checkboxes = $('.thecheckgralt');
    console.log('Found', checkboxes.length, 'checkboxes to unselect');
    checkboxes.prop('checked', false);
    updateSelectedCount();
}

// Función para mostrar modal mejorado
function showStatusModal() {
    const modal = document.getElementById('statusModal');
    modal.style.display = 'block';
    
    // Enfocar primer elemento del modal
    const firstFocusable = modal.querySelector('input, button, textarea');
    if (firstFocusable) {
        setTimeout(() => {
            firstFocusable.focus();
        }, 100);
    }
}

// Función para ocultar modal
function hideStatusModal() {
    const modal = document.getElementById('statusModal');
    modal.style.display = 'none';
    
    // Limpiar formulario
    $('#status_motivo').val('');
    $('#status_persona').val('');
    $('#status_ids').val('');
}

// Función wrapper para manejar el click del botón Status
function handleStatusClick() {
    console.log('=== handleStatusClick LLAMADA ===');
    
    // Prevenir cualquier interferencia de otros scripts
    event.preventDefault();
    event.stopPropagation();
    
    // Llamar directamente a nuestra función
    statusSelectedEnseres();
    
    return false;
}

// Función principal para cambiar status de enseres seleccionados
function statusSelectedEnseres() {
    console.log('=== statusSelectedEnseres LLAMADA ===');
    
    // Verificar checkboxes seleccionados
    var allCheckboxes = $('.thecheckgralt');
    var checkedCheckboxes = $('.thecheckgralt:checked');
    
    console.log('Total checkboxes found:', allCheckboxes.length);
    console.log('Checked checkboxes found:', checkedCheckboxes.length);
    
    var selectedIds = [];
    checkedCheckboxes.each(function(index) {
        var value = $(this).val();
        console.log('Checkbox', index + 1, 'value:', value);
        selectedIds.push(value);
    });
    
    console.log('Selected IDs array:', selectedIds);
    
    if (selectedIds.length === 0) {
        console.log('No items selected, showing warning');
        Swal.fire({
            icon: 'warning',
            title: 'Sin selección',
            text: 'Selecciona al menos un ensere para cambiar su status'
        });
        return;
    }
    
    // Establecer valores en el formulario
    var idsString = selectedIds.join(',');
    var ridValue = $('#tgtrid').val();
    
    console.log('Setting form values:');
    console.log('- IDs string:', idsString);
    console.log('- RID value:', ridValue);
    
    $('#status_ids').val(idsString);
    $('#status_rid').val(ridValue);
    
    // Verificar que se establecieron
    console.log('Form values verification:');
    console.log('- status_ids value:', $('#status_ids').val());
    console.log('- status_rid value:', $('#status_rid').val());
    
    // Obtener el nombre del residente de forma robusta
    var residentName = getResidentNameActivos();
    console.log('Resident name for status modal:', residentName);
    
    // Mostrar modal con información detallada
    console.log('Calling showStatusModalDetailed...');
    showStatusModalDetailed(selectedIds, residentName);
    
    // Forzar mostrar el modal si no se abrió
    setTimeout(function() {
        if (!$('#statusModal').is(':visible')) {
            console.log('Modal not visible, forcing display...');
            $('#statusModal').show();
        }
    }, 500);
}

// Función principal para mostrar el modal con información detallada
function showStatusModalDetailed(selectedIds, residentName) {
    console.log('=== showStatusModalDetailed called ===');
    console.log('selectedIds:', selectedIds);
    console.log('residentName parameter:', residentName);
    
    // Obtener el nombre del residente con múltiples intentos
    var displayName = residentName || getResidentNameActivos();
    
    // Si aún no tenemos nombre, intentar obtenerlo directamente del DOM
    if (!displayName || displayName === 'Residente no disponible') {
        var hiddenInput = $('#resident-name-hidden-activos');
        if (hiddenInput.length > 0) {
            displayName = hiddenInput.val() || 'Residente no disponible';
            console.log('Name from hidden input:', displayName);
        }
    }
    
    // Como último recurso, usar el ID del residente
    if (!displayName || displayName === 'Residente no disponible') {
        var residentId = $('#tgtrid').val() || window.currentResidentIdActivos || '';
        displayName = residentId ? 'Residente ID: ' + residentId : 'Residente no disponible';
        console.log('Using fallback name:', displayName);
    }
    
    console.log('Final display name:', displayName);
    
    // Actualizar información del residente en el modal
    $('#status-resident-name').text(displayName);
    
    // Contar enseres seleccionados
    var selectedCount = selectedIds.length;
    $('#status-selected-count').text(selectedCount);
    
    console.log('Selected count:', selectedCount);
    
    // Limpiar la tabla de enseres
    var tableBody = $('#status-enseres-list');
    tableBody.empty();
    
    console.log('Building enseres table...');
    
    // Poblar la tabla con los enseres seleccionados
    var itemsFound = 0;
    selectedIds.forEach(function(id) {
        console.log('Processing item ID:', id);
        var checkbox = $('#boxgral-' + id);
        
        if (checkbox.length > 0) {
            var row = checkbox.closest('tr');
            console.log('Found row for ID:', id);
            
            // Obtener datos de las celdas
            var cells = row.find('td');
            console.log('Row has', cells.length, 'cells');
            
            // Usar índices específicos para cada columna (basado en tu tabla)
            var nombre = cells.eq(1).text().trim(); // Columna 2: Nombre
            var talla = cells.eq(2).text().trim();  // Columna 3: Talla
            var marca = cells.eq(3).text().trim();  // Columna 4: Marca
            var estado = cells.eq(7).text().trim(); // Columna 8: Estado
            
            console.log('Item data:', {nombre, talla, marca, estado});
            
            // Limpiar valores "N/A" y mostrar guión si está vacío
            nombre = (nombre && nombre !== 'N/A') ? nombre : '-';
            talla = (talla && talla !== 'N/A') ? talla : '-';
            marca = (marca && marca !== 'N/A') ? marca : '-';
            estado = (estado && estado !== 'N/A') ? estado : '-';
            
            tableBody.append(
                '<tr>' +
                '<td>' + nombre + '</td>' +
                '<td>' + talla + '</td>' +
                '<td>' + marca + '</td>' +
                '<td>' + estado + '</td>' +
                '</tr>'
            );
            
            itemsFound++;
        } else {
            console.log('Checkbox not found for ID:', id);
        }
    });
    
    console.log('Items found and processed:', itemsFound);
    
    // Si no se encontraron enseres en la tabla, mostrar mensaje
    if (itemsFound === 0) {
        console.log('No items found, showing placeholder message');
        tableBody.append(
            '<tr>' +
            '<td colspan="4" style="text-align: center; color: #6c757d; font-style: italic;">No se encontraron detalles de los enseres seleccionados</td>' +
            '</tr>'
        );
    }
    
    // Mostrar el modal
    console.log('Showing modal...');
    showStatusModal();
}

// Función para procesar el cambio de status
function processStatusChange() {
    var motivo = $('#status_motivo').val().trim();
    var persona = $('#status_persona').val().trim();
    var ids = $('#status_ids').val();
    var rid = $('#status_rid').val();
    
    console.log('Datos a enviar:', { rid: rid, ids: ids, motivo: motivo, persona: persona });
    
    if (!motivo || !persona) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos requeridos',
            text: 'Completa todos los campos obligatorios'
        });
        return;
    }
    
    if (!ids || !rid) {
        Swal.fire({
            icon: 'error',
            title: 'Error de datos',
            text: 'Faltan datos necesarios para procesar el cambio de status'
        });
        return;
    }
    
    // Mostrar loading
    Swal.fire({
        title: 'Procesando...',
        text: 'Cambiando status de enseres seleccionados',
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
            selected_ids: ids.split(','),
            motivo: motivo,
            persona: persona
        },
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            hideStatusModal();
            
            // El archivo PHP devuelve scripts de Sweet Alert, ejecutarlos
            if (response.includes('Swal.fire')) {
                // Crear un div temporal para ejecutar los scripts
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = response;
                document.body.appendChild(tempDiv);
                
                // Ejecutar los scripts contenidos en la respuesta
                var scripts = tempDiv.getElementsByTagName('script');
                for (var i = 0; i < scripts.length; i++) {
                    try {
                        eval(scripts[i].innerHTML);
                    } catch (e) {
                        console.error('Error ejecutando script:', e);
                    }
                }
                
                // Limpiar el div temporal
                document.body.removeChild(tempDiv);
            } else {
                // Respuesta no esperada
                Swal.fire({
                    icon: 'success',
                    title: 'Proceso completado',
                    text: 'El cambio de status se ha procesado correctamente',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX:', error);
            console.error('Response:', xhr.responseText);
            hideStatusModal();
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor. Verifica tu conexión e inténtalo de nuevo.'
            });
        }
    });
}

// Event listeners
$(document).keydown(function(e) {
    if (e.key === "Escape" && $('#statusModal').is(':visible')) {
        hideStatusModal();
    }
});

$('#statusModal').click(function(e) {
    if (e.target === this) {
        hideStatusModal();
    }
});

// Inicializar al cargar el documento
$(document).ready(function() {
    console.log('=== Document Ready - Inicializando ===');
    
    updateSelectedCount();
    
    // Verificar elementos en el DOM
    console.log('Checking DOM elements:');
    console.log('- Hidden input exists:', $('#resident-name-hidden-activos').length > 0);
    console.log('- Hidden input value:', $('#resident-name-hidden-activos').val());
    console.log('- Target RID input exists:', $('#tgtrid').length > 0);
    console.log('- Target RID value:', $('#tgtrid').val());
    console.log('- Status modal exists:', $('#statusModal').length > 0);
    console.log('- Result table exists:', $('#resultTable').length > 0);
    
    // Verificar checkboxes
    var allCheckboxes = $('.thecheckgralt');
    console.log('- Total checkboxes found:', allCheckboxes.length);
    
    // Verificar botones de acción
    console.log('- Status button exists:', $('input[value="Status"]').length > 0);
    console.log('- Select all button exists:', $('input[value="Selec. Todos"]').length > 0);
    
    // Asegurar que el nombre del residente esté disponible
    var hiddenName = $('#resident-name-hidden-activos').val();
    if (hiddenName && hiddenName.trim() !== '') {
        console.log('Setting resident name from hidden input:', hiddenName);
        setResidentNameActivos(hiddenName.trim());
    } else {
        console.log('No name found in hidden input');
    }
    
    // Verificar variables globales
    console.log('Global variables:');
    console.log('- window.currentResidentNameActivos:', window.currentResidentNameActivos);
    console.log('- window.currentResidentIdActivos:', window.currentResidentIdActivos);
    
    // Test de la función getResidentNameActivos
    var testName = getResidentNameActivos();
    console.log('Test getResidentNameActivos result:', testName);
    
    // Event listeners adicionales para debug
    $('input[value="Status"]').click(function(e) {
        console.log('=== STATUS BUTTON CLICKED VIA JQUERY ===');
        e.preventDefault();
        e.stopPropagation();
        handleStatusClick();
        return false;
    });
    
    $('input[value="Selec. Todos"]').click(function() {
        console.log('=== SELECT ALL BUTTON CLICKED ===');
    });
    
    // Event listener para los checkboxes individuales
    $(document).on('change', '.thecheckgralt', function() {
        console.log('Checkbox changed:', $(this).val(), 'checked:', $(this).is(':checked'));
    });
    
    console.log('=== Document Ready - Finalizado ===');
    
    // Forzar override de cualquier función conflictiva después de que se carguen otros scripts
    setTimeout(function() {
        console.log('=== Override Functions - Iniciando ===');
        
        // Asegurar que nuestras funciones estén disponibles globalmente
        window.statusSelectedEnseres = statusSelectedEnseres;
        window.handleStatusClick = handleStatusClick;
        window.showStatusModalDetailed = showStatusModalDetailed;
        
        console.log('Functions overridden:');
        console.log('- statusSelectedEnseres:', typeof window.statusSelectedEnseres);
        console.log('- handleStatusClick:', typeof window.handleStatusClick);
        console.log('- showStatusModalDetailed:', typeof window.showStatusModalDetailed);
        
        console.log('=== Override Functions - Finalizado ===');
    }, 1000);
});
</script> 
