<div class="info gral">
<?php
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE id_residente=:id AND status=2");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM payconcept WHERE id_residente=:id AND status=2 ORDER BY fecha_pay ASC");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){
    $_query= $db2->prepare("SELECT SUM(debe_pay) AS dbp FROM payconcept WHERE id_residente=:idr AND status=2 ORDER BY fecha_pay ASC");
    $_query->bindParam(':idr', $rid);
    $_query->execute();
    for($i=0; $row = $_query->fetch(); $i++){  $dbp = $row['dbp'];  }
      ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>Cantidad</th>
          <th class='text-center'>Concepto</th>
          <th class='text-center'>Persona</th>
          <th class='text-center'>Debe</th>
          <th class='text-center'>Aporta</th>
          <th class='text-center'>Saldo</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $idpa= $row['id_pay'];
          $fecha= $row['fecha_pay'];
          $cantidad= $row['cantidad_pay'];
          $concepto= $row['concept_pay'];    
          $debe= $row['debe_pay'];
          $aporta= $row['aporta_pay']; 
          $persona= $row['persona_pay']; 
          $iva= $row['iva_pay'];
          if ($iva) {   $debeiva= $debe+$iva;     }
          else {  $debeiva=$debe;  }
          

$fnmed = new DateTime($fecha);
$fenfer = $fnmed->format("d-M-Y");
          if (is_numeric($concepto)) {
        $cery= $db2->prepare("SELECT nombre_medica AS nomedic FROM medicamentos WHERE id_medica=:nm");
        $cery->bindParam(':nm', $concepto);
        $cery->execute();
          for($i=0; $row = $cery->fetch(); $i++){      
            $nomedic = $row['nomedic'];
            $concepto2 = $nomedic;         }
    } else  {
          $concepto2= $concepto; }
          ?>
          <tr>
            <td>
<input type="text" class="ed_input w80" readonly value="<?php echo $fenfer; ?>" >
              </td> 
              <td>
<input type="text" class="ed_input w80" value="<?php echo $cantidad; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'cantidad_pay', this.value, 'payconcept', 'id_pay');">
              </td> 
            <td>
<input type="text" class="ed_input w230" value="<?php echo $concepto2; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'concept_pay', this.value, 'payconcept', 'id_pay');">
            </td> 
            <td>
<input type="text" class="ed_input w200" value="<?php echo $persona; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'persona_pay', this.value, 'payconcept', 'id_pay');">
            </td> 
<?php if ($debeiva) { ?>
  <td >
$<input type="text" class="ed_input w80" value="<?php echo $debeiva; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'debe_pay', this.value, 'payconcept', 'id_pay');"></td>
<?php } else {?>
            <td class="subfnt">
$<input type="text" class="ed_input w80" value="" onblur="eco_live_up('<?php echo $idpa; ?>', 'debe_pay', this.value, 'payconcept', 'id_pay');"></td> 
<?php } 
 if ($aporta) { ?>
  <td>
$<input type="text" class="ed_input w80" value="<?php echo $aporta; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'aporta_pay', this.value, 'payconcept', 'id_pay');"></td>
<?php } else {?>
            <td class="subfnt">
$<input type="text" class="ed_input w80" value="<?php echo $aporta; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'aporta_pay', this.value, 'payconcept', 'id_pay');">
            </td> 
<?php } ?>  
          <td>$ <?php
    $_qery= $db2->prepare("SELECT SUM(debe_pay) AS deb,  SUM(iva_pay) AS iv FROM payconcept WHERE id_residente=:idr AND id_pay<=:idpa AND status=2 ORDER BY fecha_pay ASC");
    $_qery->bindParam(':idr', $rid);
    $_qery->bindParam(':idpa', $idpa);
    $_qery->execute();
    for($i=0; $row = $_qery->fetch(); $i++){ 
      $iv = $row['iv']; 
      $deb = $row['deb']; 
      if ($iv) {  $debiv= $deb+$iv;  }
      else {  $debiv=$deb; }
      }

    $_query= $db2->prepare("SELECT SUM(aporta_pay) AS apo FROM payconcept WHERE id_residente=:idr AND id_pay<=:idpa AND status=2 ORDER BY fecha_pay ASC");
    $_query->bindParam(':idr', $rid);
    $_query->bindParam(':idpa', $idpa);
    $_query->execute();
    for($i=0; $row = $_query->fetch(); $i++){  $apo = $row['apo'];  }
      echo number_format($apo-$debiv, 2); 
 ?>   
          </td> 
          <td>
              <a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $idpa; ?>', 'payconcept', 'id_pay', '<?php echo $rid; ?>')"></a>
          </td>  
          </tr>
          <?php } ?>
        </table>
      </div>
<?php } 
else {  echo "Sin captura de pagos";   }  ?>
</div>