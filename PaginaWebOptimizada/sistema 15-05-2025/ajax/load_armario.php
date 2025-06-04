<?php
 $rid= $_POST['nrid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM armario WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM armario WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table pointer" data-responsive="table" id="resultTable">
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $ida= $row['id_armario'];
          $fecha= $row['armario_fecha'];

$armafe = new DateTime($fecha);
$cadfe = $armafe->format("d-M-Y");

          ?>
          <tr>
            <td class="fsize11" onclick="loadenser('<?php echo $ida ?>', '<?php echo $rid ?>')">
<?php echo $cadfe; ?>      
            </td>  
            <td class="w18"> 
<div class='delmini' name="ense2" title='Eliminar' onclick="eliminararma('<?php echo $ida; ?>', 'armario', 'id_armario', '<?php echo $rid; ?>')"></div>         
            </td>    
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } ?>