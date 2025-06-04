<div id="modstatus" class="modal">
  <div class="modal-content">
    <span id="statusclose" class="close3"></span>
    <div class="ribbon">Status <input class="ed_input" id="nm_sta" disabled></div>  


<div class="statslect">
  <div class="up_status" id="save_stat" >


    <input type="hidden" name="idr_status" id="idr_status" >


<div class="statsnfo">
  <div class="halfnfo">
      <select class="nputs w99per" name="status_status" required>
        <option value="N/A">Status</option>
<?php
  $result = $db2->prepare("SELECT * FROM status ORDER BY nombre_statu");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){   
    $ids= $row['id_statu'];
    $nos= $row['nombre_statu']; ?>
    <option value="<?php echo $ids;  ?>" ><?php echo $nos;  ?></option>
<?php } ?>
      </select>
  </div>



<div class="halfnfo">      
      <select class="nputs w99per" id="situa_status" name="situa_status">
        <option disabled selected>Situación residente</option>
          <option value="1">Activo</option>
          <option value="2">Inactivo</option>
      </select>
</div>

<input type="date" id="fecha_status" name="fecha_status" class="nputs w49per" placeholder="Fecha">

</div>


<div class="separator"></div>

<div class="prendanfo">
    <div class="subpren95">
      <input type="text" id="motivo_status" name="motivo_status" class="nputs w100per padd5" placeholder="Motivo">
    </div>
    <div class="subhist5">
      <div class="icnsmicro microplus" onclick="save_sta();" ></div> 
    </div>
</div>



</div>
<div id="stasta"></div>  
  </div>


  </div>
</div>