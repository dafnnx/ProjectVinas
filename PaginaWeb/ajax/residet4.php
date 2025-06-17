      <div class="gralmid" id="gral4">  
<div id="upfrinv">
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">
  <input type="hidden" name="resic_inv" value="<?php echo $rid; ?>">
<div class="miniseparator"></div>
            <div class="fixer">
  <input type="text" class="nputs w100per padd5" id="qm" onkeyup="loadmeds(<?php echo $rid; ?>);" placeholder="Buscar Medicamento" autocomplete="off">
            </div>
<div class="miniseparator"></div>
            <div class="fixer">
<div class="msearch padd5" id="tgtsearch"></div>
            </div>
<div class="miniseparator"></div>
   <div class="paneltr paddrl5">
         <div class="w50per">
      Medicamento *
         </div> 
         <div class="w25per">
      Vencimiento *
         </div> 
         <div class="w25per">
      Cantidad *
         </div> 
   </div>
   <div class="paneltr">
         <div class="w50per">
      <input class="nputs w97per" type="text" id="med_show" readonly disabled autocomplete="off">
      <input class="nputs w97per" type="hidden" id="fmedicainv" name="med_inv">
      <input class="nputs w97per" type="hidden" id="fmedicainvname" name="nombre_medica">
         </div> 
         <div class="w25per">
<input class="nputs w97per" type="date" name="vencimiento_inv" placeholder="Vencimiento" required>
         </div> 
         <div class="w25per">
      <input class="nputs w97per" type="number" step="any" id="c_inv" name="cantidad_inv">
         </div> 
   </div>    
<div class="miniseparator"></div>
<div class="invnfo">
  <div class="subinv90">
    <textarea class="tarea" name="observa_inv" placeholder="Observaciones" ></textarea>
  </div>   
  <div class="subinv13">
    <input type="submit" class="nputsave" value="Guardar" onclick="renewinvent(<?php echo $rid ?>);">
  </div>
</div>   
</div>  
    <div class="ldcntup">
            <div class="trtbl">
        <div class="tbldata" id="resiinv"></div>
            </div>     
    </div>
     </div>