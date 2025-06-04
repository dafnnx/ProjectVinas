    <div class="gralfull">
          <div class="gralmid" id="gral5">  
        <div class="miniseparator"></div>
        <div class="paycnt">
            <div class="btnpay pointer" onclick="showhide('upfrtr', 'listfrtr', 'list', '<?php echo $rid; ?>');">Ver</div>
            <div class="btnpay pointer" onclick="showhide('upfrtr', 'listfrtr', 'new', '<?php echo $rid; ?>');">Nuevo Tratamiento</div>            
        </div>        
<div id="upfrtr" class="tnew">
<table class="infotabtr cien">  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">
  <input type="hidden" name="resic_treat" id="resic_treat">
 <!-- <input type="text" name="id_treat" value="<?php /* echo */ $idt; ?>"> -->
  <tr>
    <td>Inicio</td>
    <td>Fin</td>   
    <td>Descripción</td>
    <td>Vía</td> 
    <td>Unidad</td>  
    <td class="textcenter">L</td> 
    <td class="textcenter">M</td>
    <td class="textcenter">X</td>
    <td class="textcenter">J</td>
    <td class="textcenter">V</td>
    <td class="textcenter">S</td>
    <td class="textcenter">D</td>  
    <td>Día</td>
    <td>7h</td>
    <td>8h</td>
    <td>13H</td>
    <td>18H</td>
    <td>21H</td>
  </tr>
  <tr>
    <td><input class="nputs w95" type="date" name="fecha_ini"></td>  
    <td><input class="nputs w95" type="date" name="fecha_fin"></td>  
    <td>
       <select id="fmedica" lang="es" class="nputs w250" id="m_trata" name="med_tratamiento">
        <option value="N/A">Medicamento</option>
      </select>
    </td>  
    <td>
      <select id="rmvia" class="nputs w95" lang="es" class="nputs " name="via_medicamento">
        <option value="N/A">Vía</option>
      </select>
    </td>  
    <td>
      <select id="rmunidad" class="nputs w95" lang="es" class="nputs" name="unidad_medicamento">
        <option value="N/A">Unidad</option>
      </select>
    </td>
    <td><input class="mar3" type="checkbox" value="1" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="2" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="3" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="4" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="5" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="6" name="days[]"></td> 
    <td><input class="mar3" type="checkbox" value="7" name="days[]"></td> 
    <td><input class="variant" type="text" name="dia_tratamiento" autocomplete="off" ></td> 
    <td><input class="variant" type="text" name="siet_tratamiento" autocomplete="off"></td>  
    <td><input class="variant" type="text" name="och_tratamiento" autocomplete="off"></td>
    <td><input class="variant" type="text" name="trce_tratamiento" autocomplete="off"></td>
    <td><input class="variant" type="text" name="dieco_tratamiento" autocomplete="off"></td>
    <td><input class="variant" type="text" name="vtuno_tratamiento" autocomplete="off"></td>  
  </tr>
</table>
<div class="tratnfo">
<div class="frst">
  <input class="nputs w85per padd5" placeholder="Total semanal *" type="number" step="any" id="total_tratamiento" name="total_tratamiento"><div class="ask" onclick="trquest();"></div>
</div>
<!--<div class="subtrat9">
      <select id="rmpatologia" lang="es" class="slectfl" name="patolo_tratamiento">
        <option value="N/A">Patología</option>
      </select>
  </div>-->
  <div class="frst mleftmini">
    <select class="nputs w100per" lang="es" name="tipomed_tratamiento">
            <option value="N/A" selected >Tipo</option>
            <option>Aguda</option>
            <option>Cronica</option>
            <option>Placebo</option>
            <option>Urgente</option>
    </select>
  </div>  
<div class="frst mleftmini">
  <input class="nputs w100per padd4" name="pauta_tratamiento" placeholder="Pauta">
</div>
<div class="frst frsthalf mleftmini"> 
    <select class="nputs w100per padd4" lang="es" id="consul_tratamiento" name="consul_tratamiento">
            <option selected disabled>Consulta relacionada</option>
<?php
    $query=$db2->prepare("SELECT * FROM nota_medica WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){
    $idn= $row['id_notamed'];
    $fnm= $row['fec_notamed'];
    $mot= $row['motivo_notamed']; 

$fcon = new DateTime($fnm);
$fconn = $fcon->format("d-M-Y");
    ?>
            <option value="<?php echo $idn ?>"><?php echo $mot ?> - <?php echo $fconn ?></option>
     <?php      }    ?>
    </select>
</div>
</div>  
   <textarea class="tarea95new" name="variante_tratamiento" rows="5" placeholder="Variantes" ></textarea> 
<div class="addmeds">
            <textarea class="tarea95new" name="observa_tratamiento" placeholder="Observaciones / Descripción" ></textarea>
            <div type="submit" class="icnsub pointer padd10 pac" id="savetrata" onclick="newpretrata('<?php echo $rid ?>');"></div>
</div>   
    <div class="tbldata" id="resitrtable"></div>
    <button type="submit" class="nputsave" onclick="save_trata('<?php echo $rid ?>');" >Guardar</button>             
</div>

    <div id="listfrtr" class="ldcntup2">    </div>
     </div>
  </div>
<?php require_once ("funcs.php"); ?>