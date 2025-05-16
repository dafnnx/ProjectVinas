<?php
$rid= $_POST['idr'];
$nd= date('Y-m-d');
    require_once ("../cn/connect2.php");
?>
<div class="gral">
<?php
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM contratos WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM contratos WHERE id_residente=:id ORDER BY id_contrato ASC");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
<div class="miniedge">
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Alta</th>
          <th class='text-center'>inicio</th>
          <th class='text-center'>Fin</th>
          <th class='text-center'>Status</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $id= $row['id_contrato'];
          $alta= $row['alta_contrato'];
          $inicio= $row['inicio_contrato'];
          $fin= $row['fin_contrato'];
          $status= $row['status_contrato'];  

$fp1 = new DateTime($alta);
$fep1 = $fp1->format("d-M-Y");

$fp2 = new DateTime($inicio);
$fep2 = $fp2->format("d-M-Y");

$fp3 = new DateTime($fin);
$fep3 = $fp3->format("d-M-Y");

          ?>
          <tr>
            <td>
  <input type="text" class="ed_input w80" name="fin" contenteditable="true" onblur="r_live_up('<?php echo $id; ?>', 'alta_contrato', this.value, 'contratos', 'id_contrato', '<?php echo $alta; ?>');" value="<?php echo $fep1; ?>">
            </td> 
            <td>
  <input type="text" class="ed_input w80" name="fin" contenteditable="true" onblur="r_live_up('<?php echo $id; ?>', 'inicio_contrato', this.value, 'contratos', 'id_contrato', '<?php echo $inicio; ?>');" value="<?php echo $fep2; ?>">
            </td> 
            <td>
  <input type="text" class="ed_input w80" name="fin" contenteditable="true" onblur="r_live_up('<?php echo $id; ?>', 'fin_contrato', this.value, 'contratos', 'id_contrato', '<?php echo $fin; ?>');" value="<?php echo $fep3; ?>">
            </td> 
  <?php    
if (!$fin) { ?>
  <td>INDEFINIDO</td> 
<?php }
else {
  if ($nd<$fin) { ?>
    <td>VIGENTE</td> 
<?php   } else { ?>
    <td>VENCIDO</td>  
 <?php   } } ?>                
          
   <td>
    <a href="#" class="del" title="Eliminar" onclick="eliminarct('<?php echo $id; ?>', 'contratos', 'id_contrato','<?php echo $rid; ?>')"></a>
   </td>      
        </tr> 
<?php } ?>
        </table>
      </div>
</div>

<?php } ?>
</div>