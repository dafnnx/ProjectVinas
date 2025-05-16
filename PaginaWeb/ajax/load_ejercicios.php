<div class="info gral">
<?php
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM ejercicios WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}

    $query=$db2->prepare("SELECT * FROM ejercicios WHERE id_residente=:id ORDER BY fecha_ejercicio ASC");
    $query->bindParam(':id', $rid);
    $query->execute(); 

    if ($numrows>0) {      ?>
        <div class="edge">
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha inicio</th>
          <th class='text-center'>Fecha final</th>
          <th class='text-center'>Resultado</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $ide= $row['id_ejercicio'];
          $min= $row['min_ejercicio'];
          $max= $row['max_ejercicio'];
          $resultado= $row['resultado_ejercicio'];    
          $fecha= $row['fecha_ejercicio'];     ?>
          <tr>
            <td><?php echo $min; ?></td>  
            <td><?php echo $max; ?></td> 
            <td><?php echo $resultado; ?></td>  
            <td><a href="#" class='det' title='Detalles' onclick="ejersdetalles('<?php echo $ide; ?>')"></a></td>   
          </tr>
          <?php } ?>
        </table>
      </div>
        </div>
<?php } 
else {  echo "Sin ejercicios";   }  ?>
</div>