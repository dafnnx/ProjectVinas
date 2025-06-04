<?php
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM statusropa ORDER BY nombre_statu");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM statusropa ORDER BY nombre_statu");
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $nombre= $row['nombre_statu'];
          ?>
          <tr>
            <td><?php echo $nombre; ?></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>