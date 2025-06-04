<?php
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM edificios ORDER BY id_edificio");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM edificios ORDER BY id_edificio");
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Nombre</th>
          <th class='text-center'>Pisos</th>
          <th class='text-center'>Alta</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $eid= $row['id_edificio'];
          $nombre= $row['nombre_edificio'];
          $pisos= $row['pisos_edificio'];
          $fecha= $row['fecha_edificio'];
          ?>
          <tr class="pointer" onclick="set_edif('<?php echo $eid ?>')">
            <td><?php echo $nombre; ?></td> 
            <td><?php echo $pisos; ?></td> 
            <td><?php echo $fecha; ?></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>