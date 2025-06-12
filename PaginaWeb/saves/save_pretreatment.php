<?php
require_once ("../cn/connect2.php");

// Datos del tratamiento
$aa = $_POST['resic_treat'];
$ba = $_POST['fecha_ini'];
$ca = $_POST['fecha_fin'];
$da = $_POST['med_tratamiento'];
$ea = $_POST['via_medicamento'];
$fa = $_POST['unidad_medicamento'];
if(isset($_POST["days"])) {
    $ga = implode(",", $_POST["days"]);
}
$ha = $_POST['variante_tratamiento'];
$ia = $_POST['total_tratamiento'];
$ja = $_POST['dia_tratamiento'];
$ka = $_POST['siet_tratamiento'];
$la = $_POST['och_tratamiento'];
$ma = $_POST['trce_tratamiento'];
$na = $_POST['dieco_tratamiento'];
$oa = $_POST['vtuno_tratamiento'];
$pa = $_POST['observa_tratamiento'];
$qa = $_POST['patolo_tratamiento'];
$ra = $_POST['tipomed_tratamiento'];
$sa = $_POST['pauta_tratamiento'];
$ta = $_POST['user_id'];
$ua = "1";
$va = $_POST['consul_tratamiento'];

try {
    // Iniciar transacción
    $db2->beginTransaction();
    
    // 1. Insertar el tratamiento
    $sql2 = "INSERT INTO tratamientos (id_residente, fecha_ini, fecha_fin, med_tratamiento, via_medicamento, unidad_medicamento, semana_tratamiento, variante_tratamiento, total_tratamiento, dia_tratamiento, siet_tratamiento, och_tratamiento, trce_tratamiento, dieco_tratamiento, vtuno_tratamiento, observa_tratamiento, patolo_tratamiento, tipom_tratamiento, pauta_tratamiento, user_id, status_tratamiento, consul_tratamiento) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q, :r, :s, :t, :u, :v)";
    $sav = $db2->prepare($sql2);
    $sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa,':q'=>$qa,':r'=>$ra,':s'=>$sa,':t'=>$ta,':u'=>$ua,':v'=>$va));
    
    if($sav) {
        // 2. Buscar el id_inventario basado en id_residente y medicamento_inv
        $query_inventario = $db2->prepare("SELECT id_inventario, cantidad_inv, medicamento_inv, nombre_medica FROM inventarios WHERE id_residente = :id_residente AND medicamento_inv = :medicamento_inv");
        $query_inventario->bindParam(':id_residente', $aa);
        $query_inventario->bindParam(':medicamento_inv', $da);
        $query_inventario->execute();
        
        $inventario_encontrado = $query_inventario->fetch();
        
        if($inventario_encontrado) {
            $id_inventario = $inventario_encontrado['id_inventario'];
            $cantidad_actual = $inventario_encontrado['cantidad_inv'];
            $med = $inventario_encontrado['medicamento_inv'];
            $nom = $inventario_encontrado['nombre_medica'];
            
            // 3. Actualizar el stock (restar la cantidad del tratamiento)
            $nueva_cantidad = $cantidad_actual - $ia; // $ia es total_tratamiento
            
            $sql_update = "UPDATE inventarios SET cantidad_inv = :nueva_cantidad WHERE id_inventario = :id_inventario";
            $update_stmt = $db2->prepare($sql_update);
            $update_stmt->bindParam(':nueva_cantidad', $nueva_cantidad);
            $update_stmt->bindParam(':id_inventario', $id_inventario);
            $update_resultado = $update_stmt->execute();
            
            if($update_resultado) {
                // 4. Obtener nombre del residente
                $query_residente = $db2->prepare("SELECT nombre_residente AS nres FROM residentes WHERE id_residente = :id_residente");
                $query_residente->bindParam(':id_residente', $aa);
                $query_residente->execute();
                $residente_data = $query_residente->fetch();
                $nres = $residente_data['nres'];
                
                // 5. Registrar en historial_inventarios
                $fecha_actual = date('Y-m-d H:i');
                $operacion = '3'; // Operación de resta (salida de medicamento)
                
                $sql_historial = "INSERT INTO historial_inventarios (opt_historial, id_medicamento, nombre_medica, id_inventario, fecha_historial, id_residente, nombre_residente, cantidad_medica, total_medica) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i)";
                $historial_stmt = $db2->prepare($sql_historial);
                $historial_resultado = $historial_stmt->execute(array(
                    ':a' => $operacion, 
                    ':b' => $med, 
                    ':c' => $nom, 
                    ':d' => $id_inventario, 
                    ':e' => $fecha_actual, 
                    ':f' => $aa, 
                    ':g' => $nres, 
                    ':h' => $ia, // cantidad utilizada en el tratamiento
                    ':i' => $nueva_cantidad // stock final
                ));
                
                if($historial_resultado) {
                    // Todo correcto, confirmar transacción
                    $db2->commit();
                    echo "<span class='disponible'>Tratamiento agregado correctamente. Stock actualizado.</span>";
                } else {
                    throw new Exception("Error al registrar en historial de inventarios");
                }
            } else {
                throw new Exception("Error al actualizar el stock");
            }
        } else {
            // Si no se encuentra el inventario, solo agregar el tratamiento sin actualizar stock
            $db2->commit();
            echo "<span class='disponible'>Tratamiento agregado. No se encontró inventario para actualizar.</span>";
        }
    } else {
        throw new Exception("Error al insertar el tratamiento");
    }
    
} catch (Exception $e) {
    // Revertir transacción en caso de error
    $db2->rollBack();
    echo "<span class='disponible'>Error: " . $e->getMessage() . "</span>";
}
?>