<div class="infosub gral">
<?php
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM tratamientos WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){ ?>
        <div class="">
<table class="table" data-responsive="table" id="resultTable">
        <thead>
                 <tr>  
                <th class='text-center'>F. consulta</th>  
                <th class='text-center'>Consulta</th>               
                <th class='text-center'>F. inicio</th> 
                <th class='text-center'>Status</th>
                <th class='text-center'>*</th>                                                     
                 </tr>
        </thead>
<?php
        for($i=0; $row = $query->fetch(); $i++){
        $idt= $row['id_tratamiento'];
        $fini= $row['fecha_ini'];
        $consu= $row['consul_tratamiento'];
        $sta= $row['status_tratamiento'];
$fecha = new DateTime($fini);
$ffni = $fecha->format("d-M-Y");

switch ($sta) {
        case '1':            $sta="Activo";        break;
        case '2':            $sta="Inactivo";      break;
}   ?>
        <tr>
<?php
    $ry=$db2->prepare("SELECT fec_notamed AS ffnm FROM nota_medica WHERE id_notamed=:consu");
    $ry->bindParam(':consu', $consu);
    $ry->execute();
    for($i=0; $row = $ry->fetch(); $i++){  
        $ffnm= $row['ffnm'];
        $fecha2 = new DateTime($ffnm);
        $ffenm = $fecha2->format("d-M-Y");    ?>
           <td><?php echo $ffenm; ?></td>
<?php } ?>

<?php
    $ryo=$db2->prepare("SELECT motivo_notamed AS mmed FROM nota_medica WHERE id_notamed=:consu");
    $ryo->bindParam(':consu', $consu);
    $ryo->execute();
    for($i=0; $row = $ryo->fetch(); $i++){    
        $mmed= $row['mmed'];   ?>
           <td><?php echo $mmed; ?></td>
<?php } ?>
           <td><?php echo $ffni; ?></td>
           <td>
                <select name="status_trata" class="nputs" onchange="sta_trata(this.value, '<?php echo $idt; ?>','<?php echo $rid; ?>');">
                        <option disabled selected><?php echo $sta; ?></option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                </select>
           </td>
           <td> <div class="psearch" onclick="tdetalles('<?php echo $idt; ?>');"></div>  </td>
        </tr>
<?php } ?>
</table>
        </div>

 <?php    }
else {  echo "Sin captura de tratamientos";   } ?>
</div>