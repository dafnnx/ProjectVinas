<?php
$idr= $_POST['idr'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM alergias_residente WHERE id_residente=:idr");
    $count_query->bindParam(':idr', $idr);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM alergias_residente WHERE id_residente=:idr");
    $query->bindParam(':idr', $idr);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){       
          $id= $row['id_listale'];
          $idale= $row['id_alergia'];         ?>
          <tr>
            <td>
    <?php
    $count_query= $db2->prepare("SELECT nombre_alergia AS nomale FROM alergias WHERE id_alergia=:idale");
    $count_query->bindParam(':idale', $idale);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
              <?php echo $row['nomale']; ?>                
<?php } ?>
              </td> 
            <td><a href="#" class="del" title="Eliminar" onclick="eliminar_ale('<?php echo $id ?>', 'alergias_residente', 'id_listale','<?php echo $idr ?>')"></a></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>