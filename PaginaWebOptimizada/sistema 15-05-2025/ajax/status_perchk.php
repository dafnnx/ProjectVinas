<?php  
require_once ("../cn/connect2.php");
$id= $_POST['id'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM hist_perstatus WHERE id_personal=:id");
    $count_query->bindParam(':id', $id);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM hist_perstatus WHERE id_personal=:id");
    $query->bindParam(':id', $id);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $status= $row['status_perstatus'];
          $motivo= $row['motivo_perstatus'];
          $fecha= $row['fecha_perstatus'];  
switch ($status) {  case '1':    $nombre= "Activo";    break;  
                    case '2':    $nombre= "Baja";    break;
}               ?>
          <tr>
            <td><?php echo $nombre; ?></td>
            <td><?php echo $motivo; ?></td>
            <td><?php echo $fecha; ?></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } else{ echo "¡Status no capturado!"; } ?>