<?php	
$rid = $_POST['rid']; 
require_once ("../cn/connect2.php"); 	
$action = (isset($_POST['action']) && $_POST['action'] != NULL) ? $_POST['action'] : '';

if($action == 'ajax'){
    $q = $_POST['q'];
    
    // ========== OBTENER INFORMACIÓN DEL RESIDENTE ==========
    $resident_query = $db2->prepare("SELECT nombre_residente FROM residentes WHERE id_residente = :rid");
    $resident_query->bindParam(':rid', $rid);
    $resident_query->execute();
    $resident_info = $resident_query->fetch();
    $resident_name = $resident_info ? $resident_info['nombre_residente'] : 'Residente no encontrado';
    
    $aColumns = array('marca_ropa', 'nombre_ropa', 'talla_ropa', 'ingreso_ropa');
    $sTable = "ropa_residente";		 
    $sWhere = "";
    
    if ($q) {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ")";
        $sWhere.= " AND id_residente='$rid' AND status_ropa='baja'";
        $sWhere.=" ORDER BY nombre_ropa ASC";
    } else {	
        $sWhere.= "WHERE id_residente='$rid' AND status_ropa='baja'";
        $sWhere.=" ORDER BY nombre_ropa ASC";
    }		
    
    $count_query = $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere ");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
        $numrows = $row['numrows'];
    }
    
    $query = $db2->prepare("SELECT rr.*, 
                                   hr.motivo_ropastatus, 
                                   hr.fecha_ropastatus, 
                                   hr.persona_ropastatus 
                            FROM $sTable rr 
                            LEFT JOIN (
                                SELECT id_rresidente, motivo_ropastatus, fecha_ropastatus, persona_ropastatus
                                FROM hist_ropastatus hr1
                                WHERE hr1.status_ropastatus = 'baja'
                                AND hr1.fecha_ropastatus = (
                                    SELECT MAX(hr2.fecha_ropastatus)
                                    FROM hist_ropastatus hr2
                                    WHERE hr2.id_rresidente = hr1.id_rresidente
                                    AND hr2.status_ropastatus = 'baja'
                                )
                            ) hr ON rr.id_rresidente = hr.id_rresidente
                            $sWhere LIMIT 250");
    $query->execute();
    
    if ($numrows > 0) { ?>
        <div class="">
            <input type="hidden" value="<?php echo $rid; ?>" id="tgtrid">
            <!-- FIX 1: Almacenar el nombre del residente en un input hidden -->
            <input type="hidden" value="<?php echo htmlspecialchars($resident_name, ENT_QUOTES, 'UTF-8'); ?>" id="resident-name-hidden">
            
            <!-- FIX 2: Script mejorado para establecer nombre del residente -->
            <script>
                // Establecer el nombre del residente inmediatamente
                var residentNameFromPHP = '<?php echo addslashes($resident_name); ?>';
                
                // Función para establecer el nombre
                function setResidentName(name) {
                    window.currentResidentName = name;
                    console.log('Nombre del residente establecido:', name);
                }
                
                // Establecer inmediatamente
                setResidentName(residentNameFromPHP);
                
                // También almacenar en variable global
                window.currentResidentName = residentNameFromPHP;
                
                // Para debugging
                console.log('Resident name from PHP:', residentNameFromPHP);
            </script>
            
            <!-- Barra de acciones para enseres seleccionados -->
            <div class="actions-bar" style="margin-bottom: 15px; padding: 10px; background-color: #f5f5f5; border-radius: 5px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <label style="font-weight: bold;">Acciones para seleccionados:</label>
                    <div class="subpren10 mr1per">
                        <input type="button" class="nputsave" value="Reactivar" onclick="reactivateSelectedEnseres()" title="Reactivar enseres seleccionados">
                    </div>
                    <div class="subpren10 mr1per">
                        <input type="button" class="nputsave" value="Selec. Todos" onclick="selectAllEnseresBaja()" title="Seleccionar todos">
                    </div>
                    <div class="subpren10">
                        <input type="button" class="nputsave" value="Deselec. Todos" onclick="unselectAllEnseresBaja()" title="Deseleccionar todos">
                    </div>
                    <span id="selected-count-baja" style="margin-left: 10px; font-weight: bold; color: #dc3545;">
                        Seleccionados: 0
                    </span>
                </div>
            </div>

            <!-- Información del residente visible (opcional) -->
            <div style="margin-bottom: 15px; padding: 12px; background-color: #e8f5e8; border-left: 4px solid #28a745; border-radius: 4px;">
                <strong style="color: #155724;">Residente:</strong> 
                <span style="color: #155724; font-weight: 600;"><?php echo htmlspecialchars($resident_name); ?></span>
                <span style="margin-left: 15px; color: #6c757d; font-size: 12px;">
                    Total enseres de baja: <strong><?php echo $numrows; ?></strong>
                </span>
            </div>
            
            <table class="table" data-responsive="table" id="resultTable">
                <thead>
                    <tr>		
                        <th class='text-center'>
                            <input type="checkbox" id="select-all-header-baja" onchange="toggleAllCheckboxesBaja(this)">
                            <label for="select-all-header-baja"><strong>Sel</label>
                        </th>
                        <th class='text-center'><strong>Nombre</th>
                        <th class='text-center'><strong>Talla</th>
                        <th class='text-center'><strong>Marca</th>
                        <th class='text-center'><strong>Color</th>
                        <th class='text-center'><strong>Motivo</th>
                        <th class='text-center'><strong>Fecha Baja</th>
                        <th class='text-center'><strong>Persona</th>					
                        <th class='text-center'><strong>*</th>							
                    </tr>
                </thead>
                <tbody>
                <?php
                for($i=0; $row = $query->fetch(); $i++){
                    $idr = $row['id_rresidente'];
                    $ida = $row['id_armario'];
                    $apo = $row['apodo_residente'];
                    $nr = $row['nombre_ropa'];
                    $tr = $row['talla_ropa'];
                    $mr = $row['marca_ropa'];	
                    $or = $row['observa_ropa'];
                    $ir = $row['ingreso_ropa'];
                    $cr = $row['color_ropa'];	
                    $er = $row['estado_ropa'];
                    $star = $row['status_ropa'];
                    
                    // Datos del historial de baja
                    $motivo_baja = $row['motivo_ropastatus'] ? $row['motivo_ropastatus'] : 'N/A';
                    $fecha_baja = $row['fecha_ropastatus'];
                    $persona_baja = $row['persona_ropastatus'] ? $row['persona_ropastatus'] : 'N/A';
                    ?>	
                    <tr>
                        <td>
                            <input type="checkbox" class="thecheckgraltbaja" value="<?php echo $idr; ?>" id="boxgralbaja-<?php echo $idr; ?>" onchange="updateSelectedCountBaja()">
                            <label for="boxgralbaja-<?php echo $idr; ?>" class="mleft5"></label>
                        </td>
                        <?php if (!$nr) { ?><td>N/A</td><?php } else { ?><td><?php echo $nr; ?></td><?php } ?>
                        <?php if (!$tr) { ?><td>N/A</td><?php } else { ?><td><?php echo $tr; ?></td><?php } ?>
                        <?php if (!$mr) { ?><td>N/A</td><?php } else { ?><td><?php echo $mr; ?></td><?php } ?>
                        <?php if (!$cr) { ?><td>N/A</td><?php } else { ?><td><input type="color" name="ense3" disabled value="<?php echo $cr; ?>" title="Color"></td><?php } ?>
                        <td title="<?php echo $motivo_baja; ?>"><?php echo strlen($motivo_baja) > 20 ? substr($motivo_baja, 0, 20) . '...' : $motivo_baja; ?></td>	
                        <td><?php 
                            if ($fecha_baja) {
                                $fecha = new DateTime($fecha_baja);  
                                $cadfe = $fecha->format("d-M-Y");  
                                echo $cadfe;
                            } else {
                                echo 'N/A';
                            }
                        ?></td>
                        <td><?php echo $persona_baja; ?></td>	
                        <td>
                            <a class='del' title='Eliminar permanentemente' onclick="eliminar_ens('<?php echo $idr; ?>', 'ropa_residente', 'id_rresidente', '<?php echo $rid; ?>')"></a>	
                            <a class='reactivate' title='Reactivar' onclick="reactivateSingleEnsere('<?php echo $idr; ?>', '<?php echo $rid; ?>')" style="cursor: pointer; color: #28a745; margin-left: 5px;">↻</a>
                        </td>									
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        
        <!-- Modal para reactivación mejorado -->
        <div id="reactivateModal" class="modal" role="dialog" aria-labelledby="modal-title" aria-modal="true">
            <div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 0; border: none; width: 90%; max-width: 700px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                
                <!-- Header del modal -->
                <div style="background-color: #28a745; color: white; padding: 15px 20px; border-radius: 10px 10px 0 0; position: relative;">
                    <h3 style="margin: 0; font-size: 18px;">Reactivar Enseres Seleccionados</h3>
                    <span class="close" onclick="hideReactivateModal()" aria-label="Cerrar modal">&times;</span>
                </div>
                
                <!-- Contenido del modal -->
                <div style="padding: 20px;">
                    
                    <!-- Información del residente -->
                    <div style="margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; border-left: 4px solid #28a745;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <strong style="color: #495057;">Residente:</strong>
                            <span id="reactivate-resident-name" style="font-weight: bold; color: #28a745;">Cargando...</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <strong style="color: #495057;">Enseres seleccionados:</strong>
                            <span id="reactivate-selected-count" style="font-weight: bold; color: #dc3545;">0</span>
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
                                    </tr>
                                </thead>
                                <tbody id="reactivate-enseres-list">
                                    <!-- Se poblará dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Formulario de reactivación -->
                    <form id="reactivateForm">
                        <input type="hidden" id="reactivate_rid" value="">
                        <input type="hidden" id="reactivate_ids" value="">
                        
                        <div style="margin-bottom: 15px;">
                            <label for="reactivate_motivo" style="display: block; margin-bottom: 5px; font-weight: bold; color: #495057;">Motivo de reactivación: <span style="color: #dc3545;">*</span></label>
                            <textarea id="reactivate_motivo" name="motivo" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; resize: vertical;" placeholder="Describe el motivo de la reactivación..." required></textarea>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <label for="reactivate_persona" style="display: block; margin-bottom: 5px; font-weight: bold; color: #495057;">Persona responsable: <span style="color: #dc3545;">*</span></label>
                            <input type="text" id="reactivate_persona" name="persona" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" placeholder="Nombre de la persona responsable" required>
                        </div>
                        
                        <!-- Botones de acción -->
                        <div style="text-align: right; border-top: 1px solid #dee2e6; padding-top: 15px;">
                            <button type="button" onclick="hideReactivateModal()" style="margin-right: 10px; padding: 10px 20px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">
                                Cancelar
                            </button>
                            <button type="button" onclick="processReactivation()" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;">
                                Reactivar Enseres
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
        /* Estilos adicionales para el modal mejorado */
        #reactivateModal .modal-content button:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        #reactivateModal .close:hover {
            opacity: 0.8;
        }

        #reactivate-enseres-list tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        #reactivate-enseres-list td {
            padding: 8px 10px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }

        #reactivateModal textarea:focus,
        #reactivateModal input[type="text"]:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.25);
        }
        </style>

        <script type="text/javascript">
        // FIX 3: JavaScript mejorado para manejar el nombre del residente
        
        // Variable global para almacenar el nombre del residente
        var currentResidentName = window.currentResidentName || '';

        console.log('Current resident name inicial:', currentResidentName);

        // Función mejorada para obtener el nombre del residente
        function getResidentName() {
            // Intentar obtener de múltiples fuentes
            var name = window.currentResidentName || 
                      $('#resident-name-hidden').val() || 
                      window.tempResidentName || 
                      '';
            
            console.log('Getting resident name:', name);
            return name;
        }

        // Función para establecer el nombre del residente
        function setResidentName(name) {
            window.currentResidentName = name;
            currentResidentName = name;
            console.log('Resident name set to:', name);
        }

        // Funciones específicas para enseres de baja
        function updateSelectedCountBaja() {
            var selectedCount = $('.thecheckgraltbaja:checked').length;
            $('#selected-count-baja').text('Seleccionados: ' + selectedCount);
            
            // Actualizar checkbox del header
            var totalCheckboxes = $('.thecheckgraltbaja').length;
            var headerCheckbox = $('#select-all-header-baja');
            
            if (selectedCount === 0) {
                headerCheckbox.prop('indeterminate', false);
                headerCheckbox.prop('checked', false);
            } else if (selectedCount === totalCheckboxes) {
                headerCheckbox.prop('indeterminate', false);
                headerCheckbox.prop('checked', true);
            } else {
                headerCheckbox.prop('indeterminate', true);
            }
        }

        function toggleAllCheckboxesBaja(headerCheckbox) {
            $('.thecheckgraltbaja').prop('checked', headerCheckbox.checked);
            updateSelectedCountBaja();
        }

        function selectAllEnseresBaja() {
            $('.thecheckgraltbaja').prop('checked', true);
            updateSelectedCountBaja();
        }

        function unselectAllEnseresBaja() {
            $('.thecheckgraltbaja').prop('checked', false);
            updateSelectedCountBaja();
        }

        // Función corregida para mostrar modal de reactivación
        function showReactivateModal() {
            const modal = document.getElementById('reactivateModal');
            modal.style.display = 'block';
            
            // Enfocar primer elemento del modal
            const firstFocusable = modal.querySelector('input, button, textarea');
            if (firstFocusable) {
                setTimeout(() => {
                    firstFocusable.focus();
                }, 100);
            }
        }

        function hideReactivateModal() {
            const modal = document.getElementById('reactivateModal');
            modal.style.display = 'none';
            
            // Limpiar formulario
            $('#reactivate_motivo').val('');
            $('#reactivate_persona').val('');
            $('#reactivate_ids').val('');
        }

        // Función mejorada para mostrar modal de reactivación con múltiples enseres
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
            
            // Establecer valores en el formulario
            $('#reactivate_ids').val(selectedIds.join(','));
            $('#reactivate_rid').val($('#tgtrid').val());
            
            // FIX 4: Obtener el nombre del residente de forma más robusta
            var residentName = getResidentName();
            console.log('Resident name for modal:', residentName);
            
            // Mostrar modal con información detallada
            showReactivateModalDetailed(selectedIds, residentName);
        }

        // Función mejorada para reactivar un solo ensere
        function reactivateSingleEnsere(id, rid) {
            $('#reactivate_ids').val(id);
            $('#reactivate_rid').val(rid);
            
            // FIX 5: Obtener el nombre del residente de forma más robusta
            var residentName = getResidentName();
            console.log('Resident name for single reactivation:', residentName);
            
            // Mostrar modal con información detallada para un solo ensere
            showReactivateModalDetailed([id], residentName);
        }

        // Función principal para mostrar el modal con información detallada
        function showReactivateModalDetailed(selectedIds, residentName) {
            console.log('showReactivateModalDetailed called with:', selectedIds, residentName);
            
            // FIX 6: Verificar y usar nombre alternativo si es necesario
            var displayName = residentName || getResidentName() || 'Residente no disponible';
            
            // Actualizar información del residente
            $('#reactivate-resident-name').text(displayName);
            
            // Contar enseres seleccionados
            var selectedCount = selectedIds.length;
            $('#reactivate-selected-count').text(selectedCount);
            
            // Limpiar la tabla de enseres
            var tableBody = $('#reactivate-enseres-list');
            tableBody.empty();
            
            // Poblar la tabla con los enseres seleccionados
            selectedIds.forEach(function(id) {
                var checkbox = $('#boxgralbaja-' + id);
                if (checkbox.length > 0) {
                    var row = checkbox.closest('tr');
                    var nombre = row.find('td:nth-child(2)').text().trim();
                    var talla = row.find('td:nth-child(3)').text().trim();
                    var marca = row.find('td:nth-child(4)').text().trim();
                    
                    // Limpiar valores "N/A" y mostrar guión si está vacío
                    nombre = (nombre && nombre !== 'N/A') ? nombre : '-';
                    talla = (talla && talla !== 'N/A') ? talla : '-';
                    marca = (marca && marca !== 'N/A') ? marca : '-';
                    
                    tableBody.append(
                        '<tr>' +
                        '<td>' + nombre + '</td>' +
                        '<td>' + talla + '</td>' +
                        '<td>' + marca + '</td>' +
                        '</tr>'
                    );
                }
            });
            
            // Si no se encontraron enseres en la tabla, mostrar mensaje
            if (tableBody.children().length === 0) {
                tableBody.append(
                    '<tr>' +
                    '<td colspan="3" style="text-align: center; color: #6c757d; font-style: italic;">No se encontraron detalles de los enseres</td>' +
                    '</tr>'
                );
            }
            
            // Mostrar el modal
            showReactivateModal();
        }

        // Función para procesar la reactivación
        function processReactivation() {
            var motivo = $('#reactivate_motivo').val().trim();
            var persona = $('#reactivate_persona').val().trim();
            var ids = $('#reactivate_ids').val();
            var rid = $('#reactivate_rid').val();
            
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
                    text: 'Faltan datos necesarios para procesar la reactivación'
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
                    console.log('Respuesta del servidor:', response);
                    hideReactivateModal();
                    
                    if (response.includes('success')) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Reactivación exitosa!',
                            text: 'Los enseres se han reactivado correctamente',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en la reactivación',
                            text: response || 'No se pudieron reactivar los enseres. Inténtalo de nuevo.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error AJAX:', error);
                    console.error('Response:', xhr.responseText);
                    hideReactivateModal();
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
            if (e.key === "Escape" && $('#reactivateModal').is(':visible')) {
                hideReactivateModal();
            }
        });

        $('#reactivateModal').click(function(e) {
            if (e.target === this) {
                hideReactivateModal();
            }
        });

        // FIX 7: Inicializar al cargar el documento
        $(document).ready(function() {
            updateSelectedCountBaja();
            
            // Asegurar que el nombre del residente esté disponible
            var hiddenName = $('#resident-name-hidden').val();
            if (hiddenName && !window.currentResidentName) {
                setResidentName(hiddenName);
            }
            
            console.log('Document ready - resident name:', getResidentName());
        });
        </script>

<?php	
    } else {		
        echo "<div style='text-align: center; padding: 20px; color: #666;'>Sin enseres dados de baja</div>";   	
    } 
}	 
?>