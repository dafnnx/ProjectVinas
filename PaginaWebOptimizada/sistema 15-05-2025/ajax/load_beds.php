<?php
    require_once ("../cn/connect2.php");  
    $rid=$_POST["rid"];  
    $count_query= $db2->prepare("SELECT count(*) AS nrbed FROM beds WHERE id_room=:rid");
    $count_query->bindParam(':rid', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $nrbed = $row['nrbed'];}
    $query=$db2->prepare("SELECT * FROM beds WHERE id_room=:rid");
    $query->bindParam(':rid', $rid);
    $query->execute();
       if ($nrbed>0){  
for($i=0; $row = $query->fetch(); $i++){   
  $bid= $row['id_bed']; 
  $nob= $row['nombre_bed'];
  $sta= $row['status_bed'];
  $nre= $row['nombre_residente'];     ?>
    <div class="detalled bgbed" > 
        <div class="bednfo" > <strong>Cama:</strong> <?php echo $nob; ?></div>
<?php
switch ($sta) {  case 1: ?>
        <div class="bednfo" ><strong> Status:</strong> Disponible</div>
        <div class="bednfo" >
            <select class="nputs" onchange="bed_sta(this.value, '<?php echo $bid; ?>', '<?php echo $rid; ?>');">
                <option disabled selected>Seleccionar</option>
                <option value="3">No disponible</option>
            </select>
        </div>
<?php  break;    case 2: ?>
        <div class="bednfo" ><strong> Status:</strong> Ocupada</div>
        <div class="bednfo textcenter" > <?php echo $nre; ?></div>
        <div class="bednfo" >
            <select class="nputs" onchange="bed_sta(this.value, '<?php echo $bid; ?>', '<?php echo $rid; ?>');">
                <option disabled selected>Seleccionar</option>
                <option value="1">Disponible</option>
                <option value="3">No disponible</option>
            </select>
        </div>
<?php  break;   case 3: ?>  
        <div class="bednfo" ><strong>Status:</strong> No disponible</div>
        <div class="bednfo textcenter" > <?php echo $nre; ?></div>
        <div class="bednfo" >
            <select class="nputs" onchange="bed_sta(this.value, '<?php echo $bid; ?>', '<?php echo $rid; ?>');">
                <option disabled selected>Seleccionar</option>
                <option value="1">Disponible</option>
            </select>
        </div>
<?php  break;   } ?>        
    </div>
<?php   }   }    ?>