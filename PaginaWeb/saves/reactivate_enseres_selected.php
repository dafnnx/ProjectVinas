<?php
// ARCHIVO: saves/reactivate_enseres_selected.php
// Procesar reactivación de enseres seleccionados (de baja a activo)

require_once ("../cn/connect2.php");

// Debug: Mostrar datos recibidos
error_log("POST data: " . print_r($_POST, true));

$rid = isset($_POST['rid']) ? $_POST['rid'] : null;
$selected_ids = isset($_POST['selected_ids']) ? $_POST['selected_ids'] : array(); // Array de IDs seleccionados
$sta = 'activo'; // Status para reactivar enseres
$mot = isset($_POST['motivo']) ? $_POST['motivo'] : '';
$per = isset($_POST['persona']) ? $_POST['persona'] : '';
$fec = date('Y-m-d H:i:s');

// Validar datos básicos
if (!$rid || empty($mot) || empty($per)) {
    echo 'error: Faltan datos obligatorios (rid, motivo o persona)';
    exit;
}

// Validar que tenemos enseres seleccionados
if (empty($selected_ids) || !is_array($selected_ids)) {
    echo 'error: Sin enseres seleccionados';
    exit;
}

// Convertir array a string para la consulta IN
$ids_string = implode(',', array_map('intval', $selected_ids));

// Verificar que los enseres seleccionados existen, pertenecen al residente y están en baja
$check_query = $db2->prepare("SELECT COUNT(*) as count FROM ropa_residente WHERE id_rresidente IN ($ids_string) AND id_residente=:rid AND status_ropa='baja'");
$check_query->bindParam(':rid', $rid);
$check_query->execute();
$check_result = $check_query->fetch();

if ($check_result['count'] > 0) {
    try {
        // Iniciar transacción
        $db2->beginTransaction();
        
        // Actualizar status solo de los enseres seleccionados (de baja a activo)
        $sql2 = "UPDATE ropa_residente SET status_ropa='$sta' WHERE id_rresidente IN ($ids_string) AND id_residente=$rid AND status_ropa='baja'";
        $svb = $db2->prepare($sql2);
        $svb->execute();
        
        if ($svb) {
            // Insertar en historial solo para los enseres seleccionados
            foreach ($selected_ids as $selected_id) {
                $sql3 = "INSERT INTO hist_ropastatus (id_rresidente, status_ropastatus, motivo_ropastatus, fecha_ropastatus, persona_ropastatus) VALUES (:a, :b, :c, :d, :e)";
                $sav = $db2->prepare($sql3);
                $sav->execute(array(
                    ':a' => intval($selected_id),
                    ':b' => $sta,
                    ':c' => $mot,
                    ':d' => $fec,
                    ':e' => $per
                ));
            }
            
            // Confirmar transacción
            $db2->commit();
            
            // Respuesta de éxito
            echo 'success: Enseres reactivados correctamente';
            
        } else {
            $db2->rollback();
            echo 'error: Error al actualizar el status de los enseres';
        }
        
    } catch (Exception $e) {
        $db2->rollback();
        echo 'error: Error en la base de datos: ' . $e->getMessage();
    }
    
} else {
    echo 'error: Los enseres seleccionados no existen, no pertenecen al residente o no están dados de baja';
}
?>