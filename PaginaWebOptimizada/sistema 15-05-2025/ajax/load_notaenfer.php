<?php $idnote= $_POST['idnote'];
require_once ("../cn/connect2.php");
    $query=$db2->prepare("SELECT * FROM nota_enfermeria WHERE id_notaenfer=:id");
    $query->bindParam(':id', $idnote);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){
          $ta= $row['ta_notaenfer'];
          $fc= $row['fc_notaenfer'];
          $fr= $row['fr_notaenfer'];
          $sat= $row['sat_notaenfer'];
          $temp= $row['temp_notaenfer'];
          $gli= $row['gli_notaenfer'];
          $fec= $row['fec_notaenfer'];
          $percen= $row['percen_ing_notaenfer'];
          $cant= $row['cant_liq_notaenfer'];
          $no_mic= $row['no_mic_notaenfer'];
          $no_evac= $row['no_evac_notaenfer'];
          $no_panal= $row['no_panal_notaenfer'];
          $visita= $row['visita_notaenfer'];
          $caida= $row['caida_notaenfer'];
          $deam= $row['deam_notaenfer'];
          $bano= $row['bano_notaenfer'];
          $bucal= $row['bucal_notaenfer'];
          $terap= $row['terap_notaenfer'];
          $evens= $row['evens_turno_notaenfer'];
          $feccap= $row['feccap_notaenfer'];
          $turno= $row['turno_notaenfer'];    }
$tiempo = (explode(" ",$feccap));
$day = $tiempo[0];
$today= date('Y-m-d');
$fnmed = new DateTime($fec);
$fenfer = $fnmed->format("d-M-Y H:i A");

   ?>
  <div class="gralmain">
<div id="editnotaenfer">
  <input type="hidden" name="idnote_e" value="<?php echo $idnote; ?>">
SIGNOS VITALESs<input type="text" class="nputs fight" name="fec_notaenfer_e" value="<?php echo $fenfer; ?>" readonly>
    <table>
     <tr>
      <td>TA:</td><td><input type="text" name="ta_notaenfer_e" class="nputs w50" value="<?php echo $ta; ?>"></td>
      <td>FC:</td><td><input type="text" name="fc_notaenfer_e" class="nputs w50" value="<?php echo $fc; ?>"></td>
      <td>FR:</td><td><input type="text" name="fr_notaenfer_e" class="nputs w50" value="<?php echo $fr; ?>"></td>
      <td>SAT O2:</td><td><input type="text" name="sat_notaenfer_e" class="nputs w50" value="<?php echo $sat; ?>"></td>
      <td>TEMPERATURA:</td><td><input type="text" name="temp_notaenfer_e" class="nputs w50" value="<?php echo $temp; ?>"></td>
      <td>GLICEMIA:</td><td><input type="text" name="gli_notaenfer_e" class="nputs w50" value="<?php echo $gli; ?>"></td>
     </tr>
    </table>
<div class="separator"></div>
INGESTAS Y LIQUIDOS
    <table>
     <tr>
      <td>PORCENTAJE DE COMIDA INGERIDA:</td><td><input type="text" name="percen_ing_notaenfer_e" class="nputs w50" value="<?php echo $percen; ?>" ></td>
      <td>CANT. DE LIQUIDOS CONSUMIDOS POR TURNO:</td><td><input type="text" name="cant_liq_notaenfer_e" class="nputs w50" value="<?php echo $cant; ?>" ></td>
     </tr>
    </table>
<div class="separator"></div>
MICCIONES Y EVACUACIONES
    <table>
     <tr>
      <td># DE MICCIONES:</td><td><input type="text" name="no_mic_notaenfer_e" class="nputs w50" value="<?php echo $no_mic; ?>" ></td>
      <td># DE EVACUACIONES:</td><td><input type="text" name="no_evac_notaenfer_e" class="nputs w50" value="<?php echo $no_evac; ?>" ></td>
      <td># DE PAÑALES UTILIZADOS:</td><td><input type="text" name="no_panal_notaenfer_e" class="nputs w50" value="<?php echo $no_panal; ?>" ></td>
     </tr>
    </table>
<div class="separator"></div>
    <table>
     <tr>
      <td>VISITA MEDICA:</td><td>
        <select class="nputs" name="visita_notaenfer_e">
          <option value="<?php echo $visita; ?>" selected><?php echo $visita; ?></option>
<?php if (!$visita) { ?> 
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
<?php } else {
switch ($visita) {  case 'Si': ?>    <option value="No">No</option>
<?php  break;   case 'No': ?>    <option value="Si">Si</option>
<?php  break; } } ?>   
        </select>
      </td>
      <td>CAIDA:</td><td>
        <select class="nputs" name="caida_notaenfer_e">
          <option value="<?php echo $caida; ?>" selected><?php echo $caida; ?></option>
<?php if (!$caida) { ?> 
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
<?php } else {
switch ($caida) {  case 'Si': ?>    <option value="No">No</option>
<?php  break;   case 'No': ?>    <option value="Si">Si</option>
<?php  break; } } ?>  
        </select>
      </td>
      <td>DEAMBULO:</td><td>
        <select class="nputs" name="deam_notaenfer_e">
          <option value="<?php echo $deam; ?>" selected><?php echo $deam; ?></option>
<?php if (!$deam) { ?> 
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
<?php } else {
switch ($deam) {  case 'Si': ?>    <option value="No">No</option>
<?php  break;   case 'No': ?>    <option value="Si">Si</option>
<?php  break; } } ?>  
        </select>
      </td>
      <td>BAÑO:</td><td>
        <select class="nputs" name="bano_notaenfer_e">
          <option value="<?php echo $bano; ?>" selected><?php echo $bano; ?></option>
<?php if (!$bano) { ?> 
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
<?php } else {
switch ($bano) {  case 'Si': ?>    <option value="No">No</option>
<?php  break;   case 'No': ?>    <option value="Si">Si</option>
<?php  break; } } ?> 
        </select>
      </td>
      <td>ASEO BUCAL</td><td>
        <select class="nputs" name="bucal_notaenfer_e">
          <option value="<?php echo $bucal ?>" selected><?php echo $bucal ?></option>
<?php if (!$bucal) { ?> 
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
<?php } else {
switch ($bucal) {  case 'Si': ?>    <option value="No">No</option>
<?php  break;   case 'No': ?>    <option value="Si">Si</option>
<?php  break; } } ?> 
        </select>
      </td>
      <td>TERAPIA FISICA:</td><td>
        <select class="nputs" name="terap_notaenfer_e">
          <option value="<?php echo $terap; ?>" selected><?php echo $terap; ?></option>
<?php if (!$terap) { ?> 
          <option value="" selected></option>
          <option value="Si">Si</option>
          <option value="No">No</option>
<?php } else {
switch ($terap) {  case 'Si': ?>    <option value="No">No</option>
<?php  break;   case 'No': ?>    <option value="Si">Si</option>
<?php  break; } } ?>
        </select>
      </td>
     </tr>
    </table>
<div class="separator"></div>
EVENTUALIDADES DEL TURNO
<select class="nputs" name="turno_notaenfer_e">
  <option selected disabled><?php echo $turno; ?></option>
  <option value="Matutino">Matutino</option>
  <option value="Vespertino">Vespertino</option>
  <option value="Nocturno">Nocturno</option>
</select>
<textarea class="tarea95new" rows="7" name="evens_turno_notaenfer_e"><?php echo $evens; ?></textarea>
</div>  
<?php 
if ($day== $today) { ?>
  <button type="submit" class="nputsave" id="saveeditnotaenfer" onclick="edit_notaenfer();" >Actualizar</button>
<?php } else { ?>
 <input type="submit" name="" class="nputsave" value="Deshabilitado" disabled>
<?php  } ?>
  </div>