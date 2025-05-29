<?php	
$rid = $_POST['rid']; 
require_once ("../cn/connect2.php"); 	
$action = (isset($_POST['action']) && $_POST['action'] != NULL) ? $_POST['action'] : '';

if($action == 'ajax'){
    $q = $_POST['q'];
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
        
        <!-- Modal para reactivación -->
        <div id="reactivateModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
            <div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: none; width: 80%; max-width: 500px; border-radius: 10px;">
                <span class="close" onclick="hideReactivateModal()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
                <h3>Reactivar Enseres</h3>
                <form id="reactivateForm">
                    <input type="hidden" id="reactivate_rid" value="<?php echo $rid; ?>">
                    <input type="hidden" id="reactivate_ids" value="">
                    
                    <div style="margin-bottom: 15px;">
                        <label for="reactivate_motivo">Motivo de reactivación:</label>
                        <textarea id="reactivate_motivo" name="motivo" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required></textarea>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="reactivate_persona">Persona responsable:</label>
                        <input type="text" id="reactivate_persona" name="persona" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                    </div>
                    
                    <div style="text-align: right;">
                        <button type="button" onclick="hideReactivateModal()" style="margin-right: 10px; padding: 8px 16px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">Cancelar</button>
                        <button type="button" onclick="processReactivation()" style="padding: 8px 16px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">Reactivar</button>
                    </div>
                </form>
            </div>
        </div>

<?php	
    } else {		
        echo "<div style='text-align: center; padding: 20px; color: #666;'>Sin enseres dados de baja</div>";   	
    } 
}	 
?>

<script type="text/javascript">
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

function showReactivateModal() {
    $('#reactivateModal').show();
}

function hideReactivateModal() {
    $('#reactivateModal').hide();
    $('#reactivateForm')[0].reset();
}

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
    
    $('#reactivate_ids').val(selectedIds.join(','));
    showReactivateModal();
}

function reactivateSingleEnsere(id, rid) {
    $('#reactivate_ids').val(id);
    showReactivateModal();
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
            text: 'Completa todos los campos'
        });
        return;
    }
    
    // Mostrar loading
    Swal.fire({
        title: 'Procesando...',
        text: 'Reactivando enseres',
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
                    title: '¡Correcto!',
                    text: 'Los enseres se han reactivado correctamente',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    // Recargar la lista
                    loadenesactivos();  // Función para recargar enseres activos
                    loadenesbaja();     // Función para recargar enseres de baja
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al reactivar los enseres'
                });
            }
        },
        error: function() {
            hideReactivateModal();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error de conexión'
            });
        }
    });
}

// Inicializar contador al cargar
$(document).ready(function() {
    updateSelectedCountBaja();
});
</script>

<script type="text/javascript" src="./js/checkbox.js"></script>
<script type="text/javascript" src="./js/checkens.js"></script>
<script type="text/javascript" src="./js/enslist.js"></script>