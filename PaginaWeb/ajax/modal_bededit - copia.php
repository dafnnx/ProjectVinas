<div id="modbed" class="modal">
  <div class="modal-content">
    <span id="bedclose" class="close3"></span>
    <div class="ribbon">Selecciona cama</div>
    <div class="bedslect">
      <div class="s_build">
<table class="table" data-responsive="table" id="resultTable"> 
  <thead>
        <tr>
    <th class='text-center' style="background-color: transparent;">Edificios</th>
        </tr>
  </thead>
        <?php
    $quer= $db2->prepare("SELECT DISTINCT id_edificio, nombre_edificio FROM edificios");
    $quer->execute();
    for($i=0; $row = $quer->fetch(); $i++){
    $idee = $row['id_edificio'];
    $noed = $row['nombre_edificio']; ?>
        <tr>
    <td class="pointer" onclick="showvar('<?php echo $idee; ?>', 'floor');"> <?php echo $noed; ?></td>
        </tr>
    <?php }   ?>
</table>
      </div>
      <div class="s_floor" id="s_floor">        
      </div>
      <div class="s_room" id="s_room">        
      </div>
      <div class="s_bed" id="s_bed">        
      </div>
    </div>
  </div>
</div>