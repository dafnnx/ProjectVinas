<?php $idnote= $_POST['idnote'];
require_once ("../cn/connect2.php");
    $query=$db2->prepare("SELECT * FROM nota_medica WHERE id_notamed=:id");
    $query->bindParam(':id', $idnote);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){
        $idr= $row['id_residente'];
        $uid= $row['id_usuario'];
        $nid= $row['id_notamed'];
          $motivo= $row['motivo_notamed'];
          $explo= $row['explo_notamed'];
          $ta= $row['ta_notamed'];
          $fc= $row['fc_notamed'];
          $fr= $row['fr_notamed'];
          $sat= $row['sat_notamed'];
          $temp= $row['temp_notamed'];
          $gli= $row['gli_notamed'];
          $fec= $row['feccap_notamed'];
          $notmed= $row['notmed_notamed'];
          $trata= $row['trata_notamed'];
          $feccap= $row['feccap_notamed'];
          $idmedic= $row['id_medic'];
$fnm2 = new DateTime($fec);
$fmed2 = $fnm2->format("d-M-Y");        } 
if ($idmedic) {
    $query=$db2->prepare("SELECT nom_medic AS nomedi FROM medics WHERE id_medic=:id");
    $query->bindParam(':id', $idmedic);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){    $nomedi= $row['nomedi'];     }
} else{
    $nomedi="N/E";
}
        ?>
  <div class="gralmainmed">
<div id="notadata">
    MOTIVO DE LA CONSULTA<input type="text" class="nputs w100 fight" name="fec_notamed" value="<?php echo $fmed2; ?>">
<textarea class="tarea95new" rows="1" name="motivo_notamed"><?php echo $motivo; ?></textarea>
    EXPLORACIÓN
<textarea class="tarea95new" rows="3" name="explo_notamed"><?php echo $explo; ?></textarea>
    SIGNOS VITALES
    <table>
     <tr>
      <td>TA:</td><td><input type="text" class="nputs w50" name="ta_notamed" value="<?php echo $ta; ?>"></td>
      <td>FC:</td><td><input type="text" class="nputs w50" name="fc_notamed" value="<?php echo $fc; ?>"></td>
      <td>FR:</td><td><input type="text" class="nputs w50" name="fr_notamed" value="<?php echo $fr; ?>"></td>
      <td>SAT O2:</td><td><input type="text" class="nputs w50" name="sat_notamed" value="<?php echo $sat; ?>"></td>
      <td>TEMPERATURA:</td><td><input type="text" class="nputs w50" name="temp_notamed" value="<?php echo $temp; ?>"></td>
      <td>GLICEMIA:</td><td><input type="text" class="nputs w50" name="gli_notamed" value="<?php echo $gli; ?>"></td>
     </tr>
    </table>
NOTA MÉDICA
<textarea class="tarea95new" rows="7" name="notmed_notamed"><?php echo $notmed; ?></textarea>
TRATAMIENTO
<textarea class="tarea95new" rows="7" name="trata_notamed"><?php echo $trata; ?></textarea>

    <input class="nputs w100per" value="<?php echo $nomedi; ?>" readonly>
<div class="separator"></div>
</div>  
  </div>
    <div class="seghist">
        <div class="ribb">Seguimientos</div> 
            <div class="seglist" id="seglist"></div> 
    </div> 
<div class="miniseparator"></div>
  <div class="nputsave" onclick="new_seg('<?php echo $idr; ?>', '<?php echo $uid; ?>', '<?php echo $nid; ?>');">Crear seguimiento</div> 