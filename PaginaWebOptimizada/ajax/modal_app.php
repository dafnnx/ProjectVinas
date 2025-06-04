<div id="modapp" class="modal">
  <div class="modal-content">
    <span id="appclose" class="close4"></span>
    <div class="ribbon">Confirmar aplicación <input type="text" class="bgtransmini" id="hr_var" readonly></div>  
<div class="varappslect mw550" id="selapp">
  <input type="hidden" name="idr_aplic" value="<?php echo $idr; ?>">
  <input type="hidden" name="idt_aplic" value="<?php echo $idt; ?>" >
  <input type="hidden" name="hr_aplic" value="<?php echo $hou; ?>">
  <input type="hidden" name="med_aplic" value="<?php echo $med; ?>">
  <input type="hidden" name="qty_aplic">
  <input type="hidden" name="fech_aplic">
<div class="w100per dflex">
<div class="w30per">Aplicado:</div>
<select class="nputs w100per" name="opt_aplic">  
      <option value="" selected disabled>Seleccionar...</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
</div>
<div class="separator"></div>
<div class="w100per dflex">
<div class="w30per">Incidencia:</div>
<select class="nputs w100per" name="inc_aplic">  
    <option value="" selected>Seleccionar...</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
</div>
<div class="separator"></div>
<div class="w100per dflex">
<div class="w30per">Motivo:</div>
<select class="nputs w100per" name="mot_aplic">  
    <option value="" selected>Seleccionar...</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
</div> 
<div class="separator"></div>
<div class="w30per">Observaciones:</div>
<textarea class="tarea95new" rows="5" name="obs_aplic" placeholder="Observaciones..."> </textarea>
<div class="separator"></div>
<button type="submit" class="nputsave" name="saveapp" id="saveapp" onclick="saveapp();">Aplicar</button>
  </div>
</div>
</div>