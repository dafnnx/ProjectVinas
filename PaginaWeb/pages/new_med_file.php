<?php    require_once ("../cn/connect2.php");   
$nidm= $_POST['nidm'];
$nom= $_POST['nom'];
$uid= $_POST['uid']; ?>
<form method="POST" id="selnewmed">
    <div class="medislect">
      <div class="capmedi">
        <div class="medmedi">
          <div class="halfm">
            <input type="text" class="nputs w100" readonly name="mid" value="<?php echo $nidm; ?>">
            <input type="text" class="nputs w250" name="barras_medica" placeholder="Código de barras">
          </div>
          <div class="halfm">
            <input type="text" class="nputs ncinco" name="nombre_medica" value="<?php echo $nom; ?>">
          </div>
        </div>
    <div class="medmedi">
<div class="medchkbk">
             <div class="chkfull">Producto sanitario</div>
             <div class="chkfull">               
        <select class="nputs" name="sani_medica">
            <option disabled selected>Seleccionar</option>
            <option value="si">Si</option>
            <option value="no">No</option>
        </select> 
             </div>            
</div>
<div class="medchkbk">
            <div class="chkfull">Unidosis</div>      
            <div class="chkfull">      
        <select class="nputs" name="unidosis_medica">
            <option disabled selected>Seleccionar</option>
            <option value="si">Si</option>
            <option value="no">No</option>
        </select> 
            </div>  
</div>
<div class="medchkbk">
            <div class="chkfull"> 
                <input type="checkbox" value="si" name="cabedisp_medica">Cabe en dispensario<br>
                <input type="checkbox" value="si"  name="frio_medica">Necesita frío
            </div> 
</div>
    </div>
      </div>
    <div class="capactivemedi">
        <div class="ngeneric bordergray">
<div class="padd5">
    <div class="cien h30">
      <div class="wper94">
          <select id="sactivo" style="width: 100%" lang="es" class="nputs " name="sactivo">
            <option value="N/A">Nombre genérico (principios activos)</option>
          </select>
      </div>
      <div class="wper5">
        <div class="icnsmicro microplus" onclick="addactivo('<?php echo $nidm; ?>');"></div>
      </div>
    </div> 
</div>
<div class="actvia" id="activoasglist"></div>
        </div>
        <div class="ngeneric bordergray">
<div class="padd5">
    <div class="cien h30">
      <div class="wper94">
          <select id="svia" style="width: 100%" lang="es" class="nputs " name="svia">
            <option value="N/A">Vías de administracíon</option>
          </select>
      </div>
      <div class="wper5">
        <div class="icnsmicro microplus" onclick="addvia('<?php echo $nidm; ?>');"></div>
      </div>
    </div>
</div> 
<div class="actvia" id="viaasglist"></div>
        </div>
    </div>
       <div class="activemediobse">
          <textarea class="tarea95" name="observa_medica" placeholder="Observaciones..." ></textarea>
      </div>
      <div class="ctimedi bordergray">
    <div class="ngeneric">
      <div class="padd5">
          <select id="senvase" lang="es" class="nputs w200 mar10" name="envase_medica">
            <option value="N/A">Envase</option>
          </select>
      </div>     
      <div class="padd5">
          <select id="sunidad" lang="es" class="nputs w200 mar10" name="unidad_medica">
            <option value="N/A">Unidad</option>
          </select>
      </div>
      <div class="padd5">
          <select id="spresenta" lang="es" class="nputs w200 mar10" name="presenta_medica">
            <option value="N/A">Presentación</option>
          </select>
      </div>
    </div>
        <div class="ngeneric">    
    <div class="padd5">     
          <input type="text" placeholder="Cantidad" class="nputs" name="qtyind_medica" autocomplete="off">  
    </div>  
    <div class="padd5">
          <input type="text" placeholder="Stock (Inventario)" class="nputs" name="stock_medica" autocomplete="off">
    </div>
    <div class="padd5">     
          <input type="number" step="any" placeholder="Precio de compra" class="nputs" name="pcompra_medica" autocomplete="off">  
    </div>  
    <div class="padd5">     
          <input type="number" step="any" placeholder="Precio de venta" class="nputs" name="pventa_medica" autocomplete="off">  
    </div>  
        </div>
    </div>
    <div type="submit" class="divsave top5" id="savenewmed" value="Guardar" onclick="med_comple('<?php echo $uid; ?>');" >Guardar</div>
  </div>
</form>
  <?php  require_once ("../js/med_vars.php");  ?>