<?php
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM iva ORDER BY nombre_iva");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM iva ORDER BY nombre_iva");
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $id= $row['id_iva'];
          $nombre= $row['nombre_iva'];
          ?>
          <tr>
            <td onclick="ivadet('<?php echo $id; ?>', '<?php echo $nombre; ?>')"><?php echo $nombre; ?></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>