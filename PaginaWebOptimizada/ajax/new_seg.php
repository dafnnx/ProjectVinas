<?php   require_once ("../cn/connect2.php");
$idr= $_POST['idr'];
$uid= $_POST['uid'];
$nid= $_POST['nid'];    ?>
        <div id="selsegnotamed">
    <input type="hidden" name="id_residente" value="<?php echo $idr; ?>"> 
    <input type="hidden" name="id_usuario" value="<?php echo $uid; ?>"> 
    <input type="hidden" name="id_notamed" value="<?php echo $nid; ?>"> 
    MOTIVO DEL SEGUIMIENTO <input type="date" class="nputs w100 fight" value="<?php echo date('Y-m-d')?>" name="fec_segnotamed">
<textarea class="tarea95new" rows="1" name="motivo_segnotamed"> </textarea>
    EXPLORACIÓN
<textarea class="tarea95new" rows="3" name="explo_segnotamed"> </textarea>
    SIGNOS VITALES
    <table>
     <tr>
      <td>TA:</td><td><input type="text" class="nputs w50" name="ta_segnotamed"></td>
      <td>FC:</td><td><input type="text" class="nputs w50" name="fc_segnotamed"></td>
      <td>FR:</td><td><input type="text" class="nputs w50" name="fr_segnotamed"></td>
      <td>SAT O2:</td><td><input type="text" class="nputs w50" name="sat_segnotamed"></td>
      <td>TEMPERATURA:</td><td><input type="text" class="nputs w50" name="temp_segnotamed"></td>
      <td>GLICEMIA:</td><td><input type="text" class="nputs w50" name="gli_segnotamed"></td>
     </tr>
    </table>
NOTA MÉDICA
<textarea class="tarea95new" rows="7" name="notmed_segnotamed"> </textarea>
TRATAMIENTO
<textarea class="tarea95new" rows="7" name="trata_segnotamed"> </textarea>
<select class="nputs w100per" name="id_segmedic" >
  <option disabled selected>Medico (Opcional)</option>
  <?php
  $ret = $db2->prepare("SELECT id_medic AS idm, nom_medic AS nom FROM medics ");
  $ret->execute();
  for($i=0; $row = $ret->fetch(); $i++){   
    $idm= $row['idm'];
    $nom= $row['nom']; ?>
    <option value="<?php echo $idm;  ?>" ><?php echo $nom;  ?></option>
<?php } ?>
</select>
     
<div class="miniseparator"></div> 
<button type="submit" class="nputsave" id="savesegnotamed" onclick="save_segnotamed('<?php echo $nid; ?>');" >Guardar</button>  
<div class="separator"></div>    
    </div>