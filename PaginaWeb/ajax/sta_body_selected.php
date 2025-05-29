<?php
require_once ("../cn/connect2.php");

$rid = $_POST['rid'];
$selected_ids = $_POST['selected_ids'];

// Obtener información del residente
$_qry = $db2->prepare("SELECT nombre_residente AS nom_r FROM residentes WHERE id_residente = :rid");
$_qry->bindParam(':rid', $rid);
$_qry->execute();
$residente_info = $_qry->fetch();
$nom_r = $residente_info['nom_r'];

// Contar enseres seleccionados
$selected_count = count($selected_ids);

// Obtener detalles de los enseres seleccionados (opcional, para mostrar lista)
$placeholders = str_repeat('?,', count($selected_ids) - 1) . '?';
$query = "SELECT nombre_ropa, marca_ropa, talla_ropa FROM ropa_residente WHERE id_rresidente IN ($placeholders) AND status_ropa = 'activo'";
$stmt = $db2->prepare($query);
$stmt->execute($selected_ids);
$enseres_details = $stmt->fetchAll();
?>

<div class="textcenter">
    <h4>Cambiar status de enseres seleccionados</h4>
    <p>Residente: <strong><?php echo htmlspecialchars($nom_r); ?></strong></p>
    <p>Enseres seleccionados: <strong><?php echo $selected_count; ?></strong></p>
    
    <!-- Lista de enseres seleccionados (opcional) -->
    <div class="selected-items-preview" style="max-height: 150px; overflow-y: auto; margin: 10px 0; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9;">
        <h5>Enseres a procesar:</h5>
        <ul style="text-align: left; margin: 0; padding-left: 20px;">
            <?php foreach($enseres_details as $enser): ?>
                <li>
                    <?php echo htmlspecialchars($enser['nombre_ropa']); ?>
                    <?php if($enser['marca_ropa']): ?>
                        - <?php echo htmlspecialchars($enser['marca_ropa']); ?>
                    <?php endif; ?>
                    <?php if($enser['talla_ropa']): ?>
                        (<?php echo htmlspecialchars($enser['talla_ropa']); ?>)
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="separator"></div>
    
    <input type="text" class="nputs stabtn" name="motivo_ense" placeholder="Motivo de salida" required>
    <div class="separator"></div>
    <input type="text" class="nputs stabtn" name="persona_ense" placeholder="Persona responsable" required>
    <div class="separator"></div>
    
    <div class="nputsave stabtn" onclick="enseres_sta_selected('<?php echo $rid; ?>');">Aceptar</div>
    <div class="nputcancel stabtn" onclick="hideStatusModal();" style="margin-left: 10px;">Cancelar</div>
    
    <div class="separator"></div>
    <div class="sendans" id="ensedown_answ"></div>
</div>

<script type="text/javascript" src="js/utils.js"></script>