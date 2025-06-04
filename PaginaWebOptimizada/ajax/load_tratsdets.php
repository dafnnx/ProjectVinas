<div class="info gral dflex">
<?php
 $rid= $_POST['idr'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM tratamientos WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>    
        <div class="subedge padd10">
    <?php   if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>*</th>
          <th class='text-center'>Desde</th>
          <th class='text-center'>Hasta</th>
          <th class='text-center'>Tratamiento</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $idtrata= $row['id_tratamiento'];
          $fini= $row['fecha_ini'];
          $ffin= $row['fecha_fin'];          
          $medt= $row['med_tratamiento'];
          $siet= $row['siet_tratamiento'];
          $och= $row['och_tratamiento'];
          $trce= $row['trce_tratamiento'];
          $dieco= $row['dieco_tratamiento'];
          $vtuno= $row['vtuno_tratamiento'];
        ?>       
          <tr>
            <td><a class='det' title='Detalles' onclick="trat_detalles('<?php echo $idtrata; ?>')"></a></td>
            <td><?php echo $fini; ?></td> 
            <td><?php echo $ffin; ?></td> 
<?php
    $cy= $db2->prepare("SELECT nombre_medica AS nmed FROM medicamentos WHERE id_medica=:id");
    $cy->bindParam(':id', $medt);
    $cy->execute();
    for($i=0; $row = $cy->fetch(); $i++){
    $nmed = $row['nmed']; ?>
        <td><?php echo $nmed; ?></td>
<?php } ?>
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } else {  echo "Sin tratamientos vigentes";   }  ?>
        </div>
   <div class="subedge padd10">
        <div id="tr_specs" class="tr_specs">         
                <div class="textcenter bggray">  Selecciona un tratamiento. </div>
        </div>
   </div>
</div>