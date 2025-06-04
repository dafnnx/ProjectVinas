<div id="modstatus" class="modal">
  <div class="modal-content">
    <span id="statusclose" class="close3"></span>
    <div class="ribbon">Cuota <input class="ed_input" id="nm_sta" disabled></div>  
<div class="tarislect">
  <div class="up_status" id="save_stat" >
    <div class="separator"></div>
        <div class="centrar">   
               <input type="hidden" id="id_m_month">
      <div class="centradofull"> Cuota mensual <input class="nputs" id="monto_month" onkeyup="s_mens(this.value);"></div>
        </div>
    <div class="separator"></div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
function s_mens(tarif){
  var rid= $('#id_m_month').val();
$.ajax({
         type: "POST",
         url: "./saves/save_tarif.php",
         data: {rid:rid, tarif:tarif},
   })  
    event.preventDefault();
}
</script>