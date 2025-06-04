<div id="modbed" class="modal">
  <div class="modal-content">
    <span id="bedclose" class="close3"></span>
    <div class="ribbon">Selecciona cama</div>
    <div class="bedslect">
      <div class="s_build">
        <div class="s_build_top">
<table class="table" data-responsive="table" id="resultTable"> 
  <thead>
        <tr>
    <th class='text-center' style="background-color: transparent;">Edificios</th>
        </tr>
  </thead>
</table>
        </div>
        <div class="s_build_btm">
<table class="table" data-responsive="table" id="resultTable">
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
      </div>


        <div class="s_floor">
      <div class="s_floor_top">
        <table class="table" data-responsive="table" id="resultTable"> 
  <thead>
        <tr>
    <th class='text-center' style="background-color: transparent;">Pisos</th>
        </tr>
  </thead>
        </table>
      </div>
          <div class="s_floor_btm">
            <table class="table" data-responsive="table" id="resultTable"> 
        <div id="s_floor"></div>
            </table>
          </div>      
         </div>



          <div class="s_room">
            <div class="s_room_top">
          <table class="table" data-responsive="table" id="resultTable"> 
  <thead>
        <tr>
    <th class='text-center' style="background-color: transparent;">Habitaciones</th>
        </tr>
  </thead>
          </table>
            </div>
            <div class="s_room_btm">
              <table class="table" data-responsive="table" id="resultTable"> 
      <div id="s_room"></div>
              </table>
            </div>
          </div>



          <div class="s_bed">
             <div class="s_bed_top">
          <table class="table" data-responsive="table" id="resultTable"> 
  <thead>
        <tr>
    <th class='text-center' style="background-color: transparent;">Camas</th>
        </tr>
  </thead>
          </table>
            </div>
            <div class="s_bed_btm">
              <table class="table" data-responsive="table" id="resultTable"> 
      <div id="s_bed"></div>
              </table>
            </div>
          </div>


    </div>
  </div>
</div>