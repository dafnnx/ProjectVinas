<?php
$aa= $_POST['idm'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM rel_act_med WHERE id_medica=:idm");
    $count_query->bindParam(':idm', $aa);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM rel_act_med WHERE id_medica=:idm");
    $query->bindParam(':idm', $aa);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="padd5">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $id_rel= $row['id_rel'];
          $idact= $row['id_activo'];
          ?>
          <tr><?php
    $c_query= $db2->prepare("SELECT nombre_activo AS na FROM activos WHERE id_activo=:idm");
    $c_query->bindParam(':idm', $idact);
    $c_query->execute();
    for($i=0; $row = $c_query->fetch(); $i++){
    $na = $row['na']; ?>
            <td><?php echo $na; ?></td>
            <td><a href="#" class='del' title='Eliminar' onclick="eliminarac('<?php echo $id_rel; ?>', 'rel_act_med', 'id_rel', '<?php echo $uid; ?>')"></a></td>    
    <?php } ?>
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>