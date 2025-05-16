<div id="modpat" class="modal">
  <div class="modal-content">
    <span id="patclose" class="close3"></span>
    <div class="ribbon">Agregar Patologias del Residiente</div>
    <div class="bedslect">
      <div class="w100per dpflex">
        <select class="nputs w50per mauto" id="pat" onchange="addxpat('<?php echo $idr2 ?>', 'patologia');">
          <option disabled selected >Seleccionar...</option>
          <?php 
    $nconsul= $db2->prepare("SELECT * FROM patologias ORDER BY nombre_patologia ASC");
    $nconsul->execute();
    for($i=0; $row = $nconsul->fetch(); $i++){
    $idp=$row['id_patologia'];
    $nomp=$row['nombre_patologia'];    ?> 
          <option value="<?php echo $idp ?>" ><?php echo $nomp ?></option>
    <?php   }    ?>
        </select> 
      </div>
      <div id="res_patlist"></div>
    </div>
  </div>
</div>