<div id="modstatus" class="modal">
  <div class="modal-content">
    <span id="statusclose" class="close3"></span>
    <div class="ribbon">Status <input class="ed_input" id="nm_sta" disabled></div>  
<div class="statslect">
  <div class="up_status" id="save_perstat" >
    <input type="hidden" name="idp_status" id="idp_status" >
<div class="statsnfo">
<div class="halfnfo">      
      <select class="nputs w99per" id="status_perstatus" name="status_perstatus">
        <option disabled selected>Situación</option>
          <option value="1">Activo</option>
          <option value="2">Baja</option>
      </select>
</div>
<input type="date" id="fecha_perstatus" name="fecha_perstatus" class="nputs w49per" placeholder="Fecha">
</div>
<div class="separator"></div>
<div class="prendanfo">
    <div class="subpren95">
      <input type="text" id="motivo_perstatus" name="motivo_perstatus" class="nputs w100per padd5" placeholder="Motivo">
    </div>
    <div class="subhist5">
      <div class="icnsmicro microplus" onclick="save_persta();" ></div> 
    </div>
</div>
</div>
<div id="stapersta"></div>  
  </div>
  </div>
</div>