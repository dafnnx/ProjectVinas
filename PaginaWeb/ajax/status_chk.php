<?php  
require_once ("../cn/connect2.php");
$id= $_POST['id'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM hist_status WHERE id_residente=:id");
    $count_query->bindParam(':id', $id);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM hist_status WHERE id_residente=:id");
    $query->bindParam(':id', $id);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $status= $row['status_status'];
          $motivo= $row['motivo_status'];
          $fecha= $row['fecha_status'];      ?>
          <tr>
            <td>
<?php
    $cnt_query= $db2->prepare("SELECT nombre_statu AS nmsta FROM status WHERE id_statu=:status");
    $cnt_query->bindParam(':status', $status);
    $cnt_query->execute();
    for($i=0; $row = $cnt_query->fetch(); $i++){
    $nmsta = $row['nmsta']; 
     echo $nmsta;   } ?>

              </td>
            <td><?php echo $motivo; ?></td>
            <td><?php echo $fecha; ?></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } else{ echo "¡Status no capturado!"; } ?>