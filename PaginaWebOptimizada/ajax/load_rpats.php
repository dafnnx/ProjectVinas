<?php
$idr= $_POST['idr'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM patologias_residente WHERE id_residente=:idr");
    $count_query->bindParam(':idr', $idr);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM patologias_residente WHERE id_residente=:idr");
    $query->bindParam(':idr', $idr);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){       
          $id= $row['id_listpat'];
          $idpat= $row['id_patologia'];         ?>
          <tr>
            <td>
    <?php
    $count_query= $db2->prepare("SELECT nombre_patologia AS nompat FROM patologias WHERE id_patologia=:idpat");
    $count_query->bindParam(':idpat', $idpat);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
              <?php echo $row['nompat']; ?>                
<?php } ?>
              </td> 
            <td><a href="#" class="del" title="Eliminar" onclick="eliminar_pat('<?php echo $id ?>', 'patologias_residente', 'id_listpat','<?php echo $idr ?>')"></a></td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>