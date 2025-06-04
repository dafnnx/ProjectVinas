      <div class="gralmid" id="gral3">  
<div class="cmap">

<!--
  <div class="map" id="mapenser">
    <div class="mapcntrl">
     <input type="date" class="nputs w104" title="Nuevo armario" onchange="armarioup(this.value, '<?php echo $rid ?>');">   
    </div> 
    <div class="mapcont" id="armario"></div>
  </div>
-->

            <div class="mapb" id="mapb"> 
              <div class="mapbtop">
<div id="upfrcloth">
    <input type="hidden" name="resi_id" value="<?php echo $rid ?>">
  <!--  <input type="hidden" name="arma_id" id="arma_id"> -->
      <div class="prendanfo">
<div class="subpren">
      <select id="sclothes" lang="es" style="width: 99%" name="nombre_ropa">
        <option value="N/A">Tipo</option>
      </select>
</div>
<div class="subpren">
      <select id="ssize" lang="es" style="width: 99%" name="talla_ropa">
        <option value="N/A">Talla</option>
      </select>
</div>
<div class="subpren">
      <select id="sbrandropam" lang="es" style="width: 99%" name="marca_ropa">
        <option value="N/A">Marca</option>
      </select>
</div>
<div class="subpren">
      <select id="sedo" class="slect" lang="es" style="width: 99%" name="estado_ropa">
            <option selected disabled>Estado</option>
            <option>Nuevo</option>
            <option>Usado</option>
      </select>
</div>
<div class="subpren">
    <input type="color" id="colorpicker" style="width: 99%;" name="color_ropa" value="#8ab7ff" title="Color" >
</div>
      </div>
<div class="prendanfo top5">
  <div class="subpren70">
    <textarea class="tarea" name="observa_ropa" placeholder="Observaciones..." ></textarea>
  </div>
  <div class="subpren10 mr1per">
    <input type="submit" class="nputsave " value="Guardar" onclick="upropa('<?php echo $rid ?>');">
  </div>
  <div class="subpren10 mr1per">
    <a href="reportes/reporte_ropa.php?idr=<?php echo $rid ?>"><input type="button" class="nputsave" value="Exportar"></a>
  </div>
  <div class="subpren10">
    <input type="button" class="nputsave" onclick="mdl(modenssta, 'ensstaclose')" value="Status">
  </div>
</div>    
</div>   
        </div>

<div class="paycnt">
    <div class="btnpay pointer"onclick="ens_list('<?php echo $rid ?>');" >Activos</div>
    <div class="btnpay pointer" onclick="ens_list_bajas('<?php echo $rid ?>');">Bajas</div>
</div> 
<div class="pad10half actcss" id="lsa">


<div class="subpren20ens">
            <input type="checkbox" class="thecheckgral" id="boxgral">
                <label for="boxgral" class="mleft5" ></label>
        <div class="mleft10 cpoint dpinblock">
                <p class="cpoint mleft10 munset" id="checkgral"></p>
        </div>          
</div>
        <input type="text" class="nputsearch w80per pad5half" id="qa" placeholder="Buscar enseres activos" onkeyup="ens_list('<?php echo $rid ?>');" autocomplete="off">


</div>
<div class="pad10half bajcss" id="lsb">


<div class="subpren20ens">
            <input type="checkbox" class="thecheckgralbajas" id="boxgralbajas">
                <label for="boxgralbajas" class="mleft5" ></label>
        <div class="mleft10 cpoint dpinblock">
                <p class="cpoint mleft10 munset" id="checkgralbajas"></p>
        </div>          
</div>
        <input type="text" class="nputsearch w80per pad5half" id="qb" placeholder="Buscar enseres bajas" onkeyup="ens_list_bajas('<?php echo $rid ?>');" autocomplete="off">


</div>
           <div class="mapbbtm mapaux" id="enser_list">
           </div>
        </div>
</div>
      </div>
<div class="tbldata" id="resict"></div>
<?php include ("modal_enstatus.php"); ?>

<script type="text/javascript">
var rid = $('[name=resi_id]').val(); 
  function mdl(msta, mclo){
var span = document.getElementById(mclo);
msta.style.display = "block";
span.onclick = function() {
  msta.style.display = "none";
}
    $('#stabody').load("./ajax/sta_body.php", {rid:rid});
}

  $(document).ready(function(){
   $("#sclothes").select2({
      ajax: {
        url: "./ajax/sclothes.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true

      }
   });
});


$(document).ready(function(){
   $("#ssize").select2({
      ajax: {
        url: "./ajax/ssize.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#sbrandropa").select2({
      ajax: {
        url: "./ajax/sbrand.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#sbrandropam").select2({
      ajax: {
        url: "./ajax/sbrandm.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});
</script>