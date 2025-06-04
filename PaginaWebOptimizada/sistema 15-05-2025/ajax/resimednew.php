<div class="info gral">
  <div class="gralmini">
    <div class="paycnt">
      <div class="btnpay pointer" onclick="showhide('newnotemed', 'expemed', 'cons', '<?php echo $idr;?>');">+ NOTA MEDICA</div>
      <div class="btnpay pointer" onclick="showhide('expemed', 'newnotemed', 'mens', '<?php echo $idr;?>');">EXPEDIENTE</div>
    </div>
<div class="dpnone" id="newnotemed">  
  <div class="miniseparator"></div>
<div id="selnotamed">   
    <input type="hidden" name="id_residente" value="<?php echo $idr; ?>"> 
    <input type="hidden" name="id_usuario" value="<?php echo $uid; ?>">     
MOTIVO DE LA CONSULTA <input type="datetime-local" class="nputs fight" name="fec_notamed">
<textarea class="tarea95new" rows="1" name="motivo_notamed" id="motivo"> </textarea>
    EXPLORACIÓN
<textarea class="tarea95new" rows="3" name="explo_notamed" id="explo"> </textarea>
    SIGNOS VITALES
    <table>
     <tr>
      <td>TA:</td><td><input type="text" class="nputs w50" name="ta_notamed"></td>
      <td>FC:</td><td><input type="text" class="nputs w50" name="fc_notamed"></td>
      <td>FR:</td><td><input type="text" class="nputs w50" name="fr_notamed"></td>
      <td>SAT O2:</td><td><input type="text" class="nputs w50" name="sat_notamed"></td>
      <td>TEMPERATURA:</td><td><input type="text" class="nputs w50" name="temp_notamed"></td>
      <td>GLICEMIA:</td><td><input type="text" class="nputs w50" name="gli_notamed"></td>
     </tr>
    </table>
NOTA MÉDICA
<textarea class="tarea95new" rows="7" name="notmed_notamed" id="notmed"> </textarea>
TRATAMIENTO
<textarea class="tarea95new" rows="7" name="trata_notamed" id="trata"> </textarea>

<?php if ($areap=="Medico") { } 
 else   {  ?>
<select class="nputs w100per" name="id_medic" id="id_medic">
  <option value="" selected>Medico (Opcional)</option>
  <?php
  $ret = $db2->prepare("SELECT id_medic AS idm, nom_medic AS nom FROM medics ");
  $ret->execute();
  for($i=0; $row = $ret->fetch(); $i++){   
    $idm= $row['idm'];
    $nom= $row['nom']; ?>
    <option value="<?php echo $idm;  ?>" ><?php echo $nom;  ?></option>
<?php } ?>
</select>
<?php }  ?>
</div>
<div class="separator"></div>
  <button type="submit" class="nputsave" id="savenotamed" onclick="save_notamed('<?php echo $areap;  ?>');" >Guardar</button>  
</div>
<div id="expemed" class="dpnone">
  <div id="resiexpes"></div>
</div>
  </div>
</div>