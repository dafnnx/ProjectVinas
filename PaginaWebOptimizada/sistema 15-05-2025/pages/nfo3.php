    <div class="gralfull">
      <div class="gralmid" id="gral3">
        <div class="cmap">

<!--
  <div class="map" id="mapenser">
    <div class="mapcntrl">
       <div class="icnsens enserplus" title="Nueva fecha" onclick="armario('<?php echo $uid ?>')"></div>
      <input type="date" class="nputs w104" title="Nuevo armario" onchange="newarmarioup(this.value);"> 
      <div class="icnsmini miniprint"></div> 
    </div> 
    <div class="mapcont" id="armario"></div>
  </div>
  -->
            <div class="mapb" id="mapb"> 
              <div class="mapbtop">
  <form id="selropa" method="POST">
    <input type="hidden" name="saved_clot" id="saved_clot">
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

<div class="prendanfo top10">
  <div class="subpren85">
    <textarea class="tarea" name="observa_ropa" placeholder="Observaciones..." ></textarea>
  </div>
  <div class="subpren15">
    <input type="submit" class="nputsave" id="saveropa" value="Guardar">
  </div>
</div>    
</form>      
        </div>
           <div class="mapbbtm" >
             <div class="sbmapbbtm" id="enser_list"></div>
             <div class="sbmapbbtm hide" id="enser_pic"></div>
           </div>
        </div>
</div>
      </div>
  </div>
<div class="tbldata" id="resict"></div>