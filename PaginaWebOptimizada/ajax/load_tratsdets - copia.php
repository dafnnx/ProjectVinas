<div class="info gral">
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
    <?php 
    if ($numrows>0){  ?>
        <div class="edge">
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Desde</th>
          <th class='text-center'>Hasta</th>
          <th class='text-center'>Tratamiento</th>
          <th class='text-center'>7h</th>
          <th class='text-center'>8h</th>
          <th class='text-center'>13h</th>
          <th class='text-center'>18h</th>
          <th class='text-center'>21h</th>
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
          <td><?php echo $siet; ?></td> 
          <td><?php echo $och; ?></td> 
          <td><?php echo $trce; ?></td> 
          <td><?php echo $dieco; ?></td> 
          <td><?php echo $vtuno; ?></td>   
          </tr>

          <tr>  
            <td>  <div class="aaas"></div> 
              <td>  <div class="aaas"></div> 
                <td>  <div class="aaas"></div> 
                  <td>  <div class="aaas"></div> 
                    <td>  <div class="aaas"></div> 
                      <td>  <div class="aaas"></div> 
                        <td>  <div class="aaas"></div> 
                          <td>  <div class="aaas"></div> 
                            <td>  <div class="aaas"></div> 
                              <td>  <div class="aaas"></div> 
                                <td>  <div class="aaas"></div> 
                                  <td>  <div class="aaas"></div> 
            </td>  
          </tr>
          <?php } ?>
        </table>
      </div>
        </div>
<?php } 
else {  echo "Sin captura de notas";   }  ?>
</div>