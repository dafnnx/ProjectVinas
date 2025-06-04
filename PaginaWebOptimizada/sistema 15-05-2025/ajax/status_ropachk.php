<?php  
require_once ("../cn/connect2.php");
$id= $_POST['idr'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM hist_ropastatus WHERE id_rresidente=:id");
    $count_query->bindParam(':id', $id);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM hist_ropastatus WHERE id_rresidente=:id");
    $query->bindParam(':id', $id);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $status= $row['status_ropastatus'];
          $motivo= $row['motivo_ropastatus'];
          $fecha= $row['fecha_ropastatus'];
          $persona= $row['persona_ropastatus'];      ?>
          <tr>
            <td><?php echo $status; ?></td>
            <td><?php echo $motivo; ?></td>
            <td><?php echo $fecha; ?></td>   
            <td><?php echo $persona; ?></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } else{ echo "¡Status no capturado!"; } ?>