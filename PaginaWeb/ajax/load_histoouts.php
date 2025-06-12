<div class="info gral">
<?php
$rid = $_POST['rid'];
require_once ("../cn/connect2.php");

$count_query = $db2->prepare("SELECT count(*) AS numrows FROM historial_inventarios WHERE id_residente=:id AND opt_historial!=1");
$count_query->bindParam(':id', $rid);
$count_query->execute();
for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];
}

$query = $db2->prepare("SELECT * FROM historial_inventarios WHERE id_residente=:id AND opt_historial!=1 ORDER BY fecha_historial DESC");
$query->bindParam(':id', $rid);
$query->execute();
?>

<?php if ($numrows > 0) { ?>
    <table class="tabla-historial">
        <thead>
            <tr>
                <th>Tipo de Movimiento</th>
                <th>Medicamento</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            for($i=0; $row = $query->fetch(); $i++){
                $nombre = $row['nombre_medica'];
                $qty = $row['cantidad_medica'];
                $fecha = $row['fecha_historial']; 
                $opt = $row['opt_historial'];  
                $tot = $row['total_medica'];  
                
                $fnmed = new DateTime($fecha);
                $fmed = $fnmed->format("d-M-Y H:i");     
                
                switch ($opt) {
                    case '1':
                        $action = "Ingreso";
                        $clase_fila = "ingreso";
                        break;
                    case '2':
                        $action = "Eliminación";
                        $clase_fila = "eliminacion";
                        break;
                    case '3':
                        $action = "Tratamiento";
                        $clase_fila = "aplicacion";
                        break;
                    default:
                        $action = "Desconocido";
                        $clase_fila = "";
                }
            ?>
            <tr class="<?php echo $clase_fila; ?>">
                <td><?php echo $action; ?></td>
                <td><strong><?php echo $nombre; ?></strong></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $fmed; ?></td>
                <td><strong><?php echo $tot; ?></strong></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="sin-movimientos">
        <p>Sin movimientos registrados</p>
    </div>
<?php } ?>
</div>

<style>
.tabla-historial {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.tabla-historial thead {
    background-color: #f8f9fa;
}

.tabla-historial th,
.tabla-historial td {
    padding: 12px 8px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.tabla-historial th {
    font-weight: bold;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
}

.tabla-historial tbody tr:hover {
    background-color: #f8f9fa;
}

/* Colores según tipo de movimiento */
.ingreso {
    border-left: 4px solid #28a745;
}

.eliminacion {
    border-left: 4px solid #dc3545;
}

.aplicacion {
    border-left: 4px solid #007bff;
}

.sin-movimientos {
    text-align: center;
    padding: 20px;
    color: #6c757d;
    font-style: italic;
}

/* Responsivo */
@media (max-width: 768px) {
    .tabla-historial {
        font-size: 14px;
    }
    
    .tabla-historial th,
    .tabla-historial td {
        padding: 8px 4px;
    }
}
</style>