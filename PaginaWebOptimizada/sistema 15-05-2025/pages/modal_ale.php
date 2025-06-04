<div id="modale" class="modal">
  <div class="modal-content">
    <span id="aleclose" class="close3"></span>
    <div class="ribbon">Agregar Alergias del Residiente</div>
    <div class="bedslect">
      <div class="w100per dpflex">
        <select class="nputs w50per mauto" id="ale" onchange="addxale('<?php echo $idr2 ?>', 'alergia');">
          <option disabled selected >Seleccionar...</option>
          <?php 
    $nconsul= $db2->prepare("SELECT * FROM alergias ORDER BY nombre_alergia ASC");
    $nconsul->execute();
    for($i=0; $row = $nconsul->fetch(); $i++){
    $ida=$row['id_alergia'];
    $noma=$row['nombre_alergia'];    ?> 
          <option value="<?php echo $ida ?>" ><?php echo $noma ?></option>
    <?php   }    ?>
        </select> 
      </div>
      <div id="res_alelist"></div>
    </div>
  </div>
</div>