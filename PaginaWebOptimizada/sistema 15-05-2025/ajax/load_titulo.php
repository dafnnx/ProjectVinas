<?php
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM titulos ORDER BY nombre_titulo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM titulos ORDER BY nombre_titulo");
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $nombre= $row['nombre_titulo'];
          ?>
          <tr>
            <td><?php echo $nombre; ?></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>