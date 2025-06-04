<?php
$aa= $_POST['idm'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM rel_via_med WHERE id_medica=:idm");
    $count_query->bindParam(':idm', $aa);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM rel_via_med WHERE id_medica=:idm");
    $query->bindParam(':idm', $aa);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="padd5">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $id_relvia= $row['id_relvia'];
          $idvia= $row['id_via'];
          ?>
          <tr><?php
    $c_query= $db2->prepare("SELECT nombre_via AS nv FROM vias WHERE id_via=:idm");
    $c_query->bindParam(':idm', $idvia);
    $c_query->execute();
    for($i=0; $row = $c_query->fetch(); $i++){
    $nv = $row['nv']; ?>
            <td><?php echo $nv; ?></td>
            <td><a href="#" class='del' title='Eliminar' onclick="eliminarvi('<?php echo $id_relvia; ?>', 'rel_via_med', 'id_relvia', '<?php echo $uid; ?>')"></a></td>    
    <?php } ?>
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>