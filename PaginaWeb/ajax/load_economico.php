<div class="info gral">
<?php
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE id_residente=:id AND status=2 AND id_ejercicio IS NULL");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}

    $dtes=$db2->prepare("SELECT MIN(fecha_pay) AS min, MAX(fecha_pay) AS max FROM payconcept WHERE id_residente=:id AND status=2 AND id_ejercicio IS NULL ORDER BY fecha_pay ASC");
    $dtes->bindParam(':id', $rid);
    $dtes->execute(); 
    for($i=0; $row = $dtes->fetch(); $i++){
    $min = $row['min'];
    $max = $row['max'];}
$fmin = new DateTime($min);
$resmin = $fmin->format("d-M-Y");

$fmax = new DateTime($max);
$resmax = $fmax->format("d-M-Y");

    $query=$db2->prepare("SELECT * FROM payconcept WHERE id_residente=:id AND status=2 AND id_ejercicio IS NULL ORDER BY fecha_pay ASC");
    $query->bindParam(':id', $rid);
    $query->execute(); 




    if ($numrows>0){
    $_query= $db2->prepare("SELECT SUM(debe_pay) AS dbp FROM payconcept WHERE id_residente=:idr AND status=2 AND id_ejercicio IS NULL ORDER BY fecha_pay ASC");
    $_query->bindParam(':idr', $rid);
    $_query->execute();
    for($i=0; $row = $_query->fetch(); $i++){  $dbp = $row['dbp'];  }
      ?>
        <div class="edge">
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>Cant.</th>
          <th class='text-center'>F. pago</th>
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
          $fpago= $row['fpago_pay'];
          $concepto= $row['concept_pay'];    
          $debe= $row['debe_pay'];
          $aporta= $row['aporta_pay']; 
          $persona= $row['persona_pay']; 
          /*
          $iva= $row['iva_pay'];
          if ($iva) {   $debeiva= $debe+$iva;     }
          else {    }
          */
          $debeiva=$debe;

$fnmed = new DateTime($fecha);
$fenfer = $fnmed->format("d-M-Y");
/*$fenfer = $fnmed->format("d-M-Y h:i a");*/

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
<input type="text" class="ed_input w100" readonly value="<?php echo $fenfer; ?>" >
              </td> 
              <td>
<input type="text" class="ed_input w40" value="<?php echo $cantidad; ?>" onchange="eco_live_up('<?php echo $idpa; ?>', 'cantidad_pay', this.value, 'payconcept', 'id_pay');">
              </td> 
              <td>
<input type="text" class="ed_input w60" value="<?php echo $fpago; ?>" onchange="eco_live_up('<?php echo $idpa; ?>', 'fpago_pay', this.value, 'payconcept', 'id_pay');">
              </td> 
            <td>
<input type="text" class="ed_input w230" value="<?php echo $concepto2; ?>" onchange="eco_live_up('<?php echo $idpa; ?>', 'concept_pay', this.value, 'payconcept', 'id_pay');">
            </td> 
            <td>
<input type="text" class="ed_input w100" value="<?php echo $persona; ?>" onchange="eco_live_up('<?php echo $idpa; ?>', 'persona_pay', this.value, 'payconcept', 'id_pay');">
            </td> 
<?php if (isset($debeiva)) { ?>
  <td >
$<input type="text" class="ed_input w100" value="<?php echo $debeiva; ?>" onchange="eco_live_up('<?php echo $idpa; ?>', 'debe_pay', this.value, 'payconcept', 'id_pay');"></td>
<?php } else {?>
            <td class="subfnt">
$<input type="text" class="ed_input w100" value="" onchange="eco_live_up('<?php echo $idpa; ?>', 'debe_pay', this.value, 'payconcept', 'id_pay');"></td> 
<?php } 
 if ($aporta) { ?>
  <td>$<input type="text" class="ed_input w100" value="<?php echo $aporta; ?>" onchange="eco_live_up('<?php echo $idpa; ?>', 'aporta_pay', this.value, 'payconcept', 'id_pay');"></td>
<?php } else {  ?>
            <td class="subfnt">
$<input type="text" class="ed_input w100" value="<?php echo $aporta; ?>" onchange="eco_live_up('<?php echo $idpa; ?>', 'aporta_pay', this.value, 'payconcept', 'id_pay');">
            </td> 
<?php } ?>  
          <td>$ <?php
    $_qery= $db2->prepare("SELECT SUM(debe_pay) AS deb,  SUM(iva_pay) AS iv FROM payconcept WHERE id_residente=:idr AND fecha_pay<=:fecha AND status=2 AND id_ejercicio IS NULL ORDER BY fecha_pay ASC");
    $_qery->bindParam(':idr', $rid);
    $_qery->bindParam(':fecha', $fecha);
    $_qery->execute();
    for($i=0; $row = $_qery->fetch(); $i++){ 
      $iv = $row['iv']; 
      $deb = $row['deb']; 
      if ($iv) {  $debiv= $deb+$iv;  }
      else {  $debiv=$deb; }
      }

    $_query= $db2->prepare("SELECT SUM(aporta_pay) AS apo FROM payconcept WHERE id_residente=:idr AND fecha_pay<=:fecha AND status=2 AND id_ejercicio IS NULL ORDER BY fecha_pay ASC");
    $_query->bindParam(':idr', $rid);
    $_query->bindParam(':fecha', $fecha);
    $_query->execute();
    for($i=0; $row = $_query->fetch(); $i++){  $apo = $row['apo'];  }
      echo number_format($apo-$debiv, 2);  ?>   
          </td> 
          <td>
        <a class='del' title='Eliminar' onclick="eliminar('<?php echo $idpa; ?>', 'payconcept', 'id_pay', '<?php echo $rid; ?>')"></a>
        
  <?php if ($aporta) { ?><a class='send' title='Enviar' onclick="mdlsend('<?php echo $idpa; ?>', '<?php echo $rid; ?>')"></a>
  <?php  } else { ?>  <a class='empty'></a> <?php } ?>

          </td>  
          </tr>
          <?php } ?>
        </table>
      </div>
        </div>
          <div class="separator"></div>
<div class="monthvar">
  <div class="w20per">
      Resultados:
  </div>
  <div class="w20per">
      Inicio:   <?php echo $resmin; ?>
  </div>
  <div class="w20per">
      Final:   <?php echo $resmax; ?>
  </div>
  <div class="w20per">
      Saldo:   <?php echo number_format($apo-$debiv, 2);  ?>
  </div>
  <div class="w20per">
      <input type="hidden" name="min_date" value="<?php echo $min; ?>">
      <input type="hidden" name="max_date" value="<?php echo $max; ?>">
      <input type="hidden" name="res_exer" value="<?php echo number_format($apo-$debiv, 2);  ?>">
      <input type="hidden" name="rid_exer" value="<?php echo $rid; ?>">  
      <input type="submit" class="nputsave" value="Cerrar ejercicio" onclick="create_exer();">    
  </div>  
</div>
<?php } 
else {  echo "Sin captura de pagos";   }  ?>
</div>

<?php     include ("modal_send.php");     ?>