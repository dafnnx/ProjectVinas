<?php
// ARCHIVO: saves/status_enseres_selected.php
// Procesar solo enseres seleccionados usando la misma lógica que update_enseres.php

require_once ("../cn/connect2.php");

$rid = $_POST['rid'];
$selected_ids = $_POST['selected_ids']; // Array de IDs seleccionados
$sta = 'activo'; // Status fijo para dar de ALTA enseres
$mot = $_POST['motivo'];
$per = $_POST['persona'];
$fec = date('Y-m-d H:i:s');

// Validar que tenemos enseres seleccionados
if (empty($selected_ids) || !is_array($selected_ids)) {
    echo "No se han seleccionado enseres para procesar";
    exit;
}

// Convertir array a string para la consulta IN
$ids_string = implode(',', array_map('intval', $selected_ids));

// Verificar que los enseres seleccionados existen y pertenecen al residente
$check_query = $db2->prepare("SELECT COUNT(*) as count FROM ropa_residente WHERE id_rresidente IN ($ids_string) AND id_residente=:rid");
$check_query->bindParam(':rid', $rid);
$check_query->execute();
$check_result = $check_query->fetch();

if ($check_result['count'] > 0) {
    // Actualizar status solo de los enseres seleccionados
    $sql2 = "UPDATE ropa_residente SET status_ropa='$sta' WHERE id_rresidente IN ($ids_string) AND id_residente=$rid";
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
        echo "success"; // Respuesta exitosa para JavaScript
    } else {
        echo "Error desconocido, intenta nuevamente.";
    }
} else {
    echo "Los enseres seleccionados no pertenecen al residente o no existen";
}
?>