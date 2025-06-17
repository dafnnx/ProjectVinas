<?php 
  $mid_mid= $_POST['id_id'];
  $mid= $_POST['id'];
  require_once ("../cn/connect2.php");
    $query=$db2->prepare("SELECT * FROM medicamentos WHERE id_id_medica=:id");
    $query->bindParam(':id', $mid_mid);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){
          $barras= $row['barras_medica'];
          $nombre= $row['nombre_medica'];
          $sani= $row['sani_medica'];
          $unidosis= $row['unidosis_medica'];
          $cabedisp= $row['cabedisp_medica'];
          $frio= $row['frio_medica'];
          $observa= $row['observa_medica'];
          $envase= $row['envase_medica'];
          $unidad= $row['unidad_medica']; 
          $presenta= $row['presenta_medica']; 
          $via= $row['via_medica']; 
          $qtyind= $row['qtyind_medica'];
          $stock= $row['stock_medica'];
          $pcompra= $row['pcompra_medica'];
          $pventa= $row['pventa_medica'];
          $cve= $row['cve_sae'];
          $cvesat= $row['clave_sat'];
          $unisat= $row['unidad_sat'];
          $iva= $row['iva_medica'];
          $mililitros= $row['mililitros_medica'];
     }
 

 $quer=$db2->prepare("SELECT nombre_via AS nv FROM vias WHERE id_via=(SELECT id_via FROM rel_via_med WHERE id_medica=:idm)");
    $quer->bindParam(':idm', $mid);
    $quer->execute();
for($i=0; $row = $quer->fetch(); $i++){   $nv= $row['nv']; }

  $que=$db2->prepare("SELECT nombre_envase AS nenv FROM envases WHERE id_envase= :envase");
    $que->bindParam(':envase', $envase);
    $que->execute();
for($i=0; $row = $que->fetch(); $i++){   $nenv= $row['nenv']; }

  $que=$db2->prepare("SELECT nombre_unidad AS nuni FROM unidades WHERE id_unidad= :unidad");
    $que->bindParam(':unidad', $unidad);
    $que->execute();
for($i=0; $row = $que->fetch(); $i++){   $nuni= $row['nuni']; }

  $que=$db2->prepare("SELECT nombre_presentacion AS npre FROM presentaciones WHERE id_presentacion= :presentacion");
    $que->bindParam(':presentacion', $presentacion);
    $que->execute();
for($i=0; $row = $que->fetch(); $i++){   $npre= $row['npre']; }

  $que=$db2->prepare("SELECT nombre_iva AS niva FROM iva WHERE id_iva= :iva");
    $que->bindParam(':iva', $iva);
    $que->execute();
for($i=0; $row = $que->fetch(); $i++){   $niva= $row['niva']; }
?>

<div class="info gral">
  <div class="gralfull">
          <div class="gralmain" >
  <div class="miniseparator" ></div>
<form method="POST" id="editmed">
    <div class="medislect">
      <div class="capmedi">
        <div class="medmedi">
          <div class="halfm">
            <input type="text" class="nputs w100" readonly name="mid" value="<?php echo $mid; ?>">
            <input type="test" class="nputs w100" name="cve_sae" value="<?php echo $cve; ?>">
            <input type="text" class="nputs w250" name="barras_medica" placeholder="Código de barras" value="<?php echo $barras; ?>">
          </div>
          <div class="halfm">
            <input type="text" class="nputs ncinco" name="nombre_medica" value="<?php echo $nombre; ?>">
          </div>
        </div>
    <div class="medmedi">
<div class="medchkedit">
             <div class="chkfull">Producto sanitario</div>
             <div class="chkfull">               
        <select class="nputs" name="sani_medica">
            <option selected value="<?php echo $sani; ?>"><?php echo $sani; ?></option>
            <option value="si">Si</option>
            <option value="no">No</option>
        </select> 
             </div>            
</div>
<div class="medchkedit">
            <div class="chkfull">Unidosis</div>      
            <div class="chkfull">      
        <select class="nputs" name="unidosis_medica">
            <option selected value="<?php echo $unidosis; ?>"><?php echo $unidosis; ?></option>
            <option value="si">Si</option>
            <option value="no">No</option>
        </select> 
            </div>  
</div>
<div class="medchkedit2">
            <div class="chkfull"> 
                <input type="checkbox" value="si" <?php if ($cabedisp=="si") echo "checked"; ?> name="cabedisp_medica">Cabe en dispensario<br>
                <input type="checkbox" value="si" <?php if ($frio=="si") echo "checked"; ?>  name="frio_medica">Necesita frío
            </div> 
</div>
    </div>
      </div>
 <div class="capactivemedi">
        <div class="ngeneric bordergray">
<?php
    $quer=$db2->prepare("SELECT DISTINCT id_activo AS ida FROM rel_act_med WHERE id_medica=:idm");
    $quer->bindParam(':idm', $mid);
    $quer->execute();
    for($i=0; $row = $quer->fetch(); $i++){   $ida= $row['ida'];
    $qer=$db2->prepare("SELECT nombre_activo AS na FROM activos WHERE id_activo=:ida");
    $qer->bindParam(':ida', $ida);
    $qer->execute();
    for($i=0; $row = $qer->fetch(); $i++){    $na= $row['na'];?>
  <div class="wper100"> <?php echo $na; ?></div>
<?php } } ?>
        </div>
        <div class="ngeneric bordergray">
<?php
    $quer=$db2->prepare("SELECT DISTINCT id_via AS idv FROM rel_via_med WHERE id_medica=:idm");
    $quer->bindParam(':idm', $mid);
    $quer->execute();
    for($i=0; $row = $quer->fetch(); $i++){   $idv= $row['idv'];
    $qer=$db2->prepare("SELECT nombre_via AS nv FROM vias WHERE id_via=:idv");
    $qer->bindParam(':idv', $idv);
    $qer->execute();
    for($i=0; $row = $qer->fetch(); $i++){    $nv= $row['nv'];?>
  <div class="wper100"> <?php echo $nv; ?></div>
<?php } } ?>
        </div>
    </div>
       <div class="activemediobse">
          <textarea class="tarea95" name="observa_medica" placeholder="Observaciones..."><?php echo $observa; ?></textarea>
      </div>
      <div class="ctimedi bordergray">
    <div class="ngeneric">
      <div class="padd5">
          <select id="senvasen" lang="es" class="nputs w200 mar10" name="envase_medica">
<?php
if ($nenv) { ?>
            <option value="<?php echo $envase; ?>"><?php echo $nenv; ?></option>
<?php } else  { ?>
            <option value="N/A">Envase</option>
<?php } ?>
          </select>
      </div>     
      <div class="padd5">
          <select id="sunidadn" lang="es" class="nputs w200 mar10" name="unidad_medica">
<?php
if ($nuni) { ?>
            <option value="<?php echo $unidad; ?>"><?php echo $nuni; ?></option>
<?php } else { ?>
            <option value="N/A">Unidad</option>
<?php } ?>
          </select>
      </div>
      <div class="padd5">
          <select id="spresentan" lang="es" class="nputs w200 mar10" name="presenta_medica">
<?php 
if ($npre) { ?>
            <option value="<?php echo $presenta; ?>"><?php echo $npre; ?></option>
<?php } else { ?>
            <option value="N/A">Presentación</option>
<?php } ?>
          </select>
      </div>
      <div class="padd5">
          <select id="siva" lang="es" class="nputs w200 mar10" name="iva_medica">
<?php 
if ($niva) { ?>
            <option value="<?php echo $iva; ?>"><?php echo $niva; ?></option>
<?php } else { ?>
            <option value="N/A">IVA</option>
<?php } ?>
          </select>
      </div>
    </div>
        <div class="ngeneric">    
    <div class="padd5">     
     <div class="meditnfo"> Cantidad </div><input type="text" class="nputs" name="qtyind_medica" value="<?php echo $qtyind; ?>" autocomplete="off">  
    </div>  
    <div class="padd5">
     <div class="meditnfo"> Stock (Inventario) </div><input type="text" class="nputs" name="stock_medica" value="<?php echo $stock; ?>" autocomplete="off">
    </div>
    <div class="padd5">     
     <div class="meditnfo"> Concentración </div><input type="number" step="0.01" class="nputs" name="mililitros_medica" value="<?php echo $mililitros; ?>" autocomplete="off">  
    </div>
    <div class="padd5">     
     <div class="meditnfo"> Clave SAT </div><input type="text" step="any" class="nputs" name="clave_sat" value="<?php echo $cvesat; ?>" autocomplete="off">  
    </div> 
    <div class="padd5">     
     <div class="meditnfo"> Unidad SAT </div><input type="text" step="any" class="nputs" name="unidad_sat" value="<?php echo $unisat; ?>" autocomplete="off">  
    </div>  
        </div>
    </div>
    <div type="submit" class="divsave top5" id="saveeditmed" value="Guardar" onclick="med_edit_comple('<?php echo $mid_mid; ?>', '<?php echo $mid; ?>');" >Actualizar</div>
  </div>
</form>
          </div>
  </div>
</div>
<?php  require_once ("../js/new_med_vars.php");  ?>