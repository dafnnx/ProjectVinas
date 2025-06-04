      <div class="gralmid" id="gral5">  
        <div class="miniseparator"></div>
        <div class="paycnt">
<div class="icnsmicro microplus pad5 mar5" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'new', '<?php echo $rid; ?>');"></div>   
<div class="icnsmicro microsea pad5 mar5" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'list', '<?php echo $rid; ?>');"></div>
<a href="reportes/exp_tratas.php?idr=<?php echo $rid;?>"><div class="microprint icnsmicro pad5 mar5" title='Imprimir'></div></a>
    <!--     <div class="btnpay pointer" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'hist', '<?php echo $rid; ?>');">Inactivos</div>
            <div class="btnpay pointer" onclick="showhide('upfrtr', 'listfrtr', 'movsfrtr', 'histfrtr', 'movs', '<?php echo $rid; ?>');">Movimientos</div> 
    -->
                     
        </div>        
<div id="upfrtr" class="tnew">
<table class="infotabtr cien">  
  <input type="hidden" name="user_id" value="<?php echo $uid ?>">
  <input type="hidden" name="resic_treat" value="<?php echo $rid; ?>">
  <input type="hidden" name="id_treat" value="<?php echo $idt; ?>">
  <tr>
    <td>Inicio</td>
    <td>Fin</td>   
    <td>Descripción</td>
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
    <td><input class="nputs w95" type="date" name="fecha_ini" id="fecha_ini"></td>  
    <td><input class="nputs w95" type="date" name="fecha_fin" id="fecha_fin" onchange="date_check(this.value);"></td>  
    <td>
        <select class="nputs w450" lang="es" onchange="spec_viauni(this.value);">
            <option selected disabled>Medicamento</option>
<?php
    $query=$db2->prepare("SELECT * FROM inventarios WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++) {
    $idi= $row['medicamento_inv'];    
    $qty= $row['cantidad_inv'];

    $qury=$db2->prepare("SELECT nombre_medica AS nmed, unidad_medica AS unimed, via_medica AS viamed FROM medicamentos WHERE id_medica=:idi");
    $qury->bindParam(':idi', $idi);
    $qury->execute();
    for($i=0; $row = $qury->fetch(); $i++)  { 
    $nmed= $row['nmed'];
    $unimed= $row['unimed'];
    $viamed= $row['viamed'];        }

    $ury=$db2->prepare("SELECT nombre_unidad AS nuni FROM unidades WHERE id_unidad=:unimed");
    $ury->bindParam(':unimed', $unimed);
    $ury->execute();
    for($i=0; $row = $ury->fetch(); $i++)  { 
    $nuni= $row['nuni'];            
    }

    $ry=$db2->prepare("SELECT nombre_via AS nvia FROM vias WHERE id_via=:viamed");
    $ry->bindParam(':viamed', $viamed);
    $ry->execute();
    for($i=0; $row = $ry->fetch(); $i++)  { 
    $nvia= $row['nvia'];       
           }    ?>
            <option value="<?php echo $idi ?>, <?php echo $unimed ?>, <?php echo $viamed ?>"><?php echo $nmed?> - <?php echo $nuni?> - <?php echo $nvia?> - <?php echo $qty ?></option>
<?php    }    ?>
        </select>
    </td>  
    <input type="hidden" name="med_tratamiento">
    <input type="hidden" name="via_medicamento">
    <input type="hidden" name="unidad_medicamento">
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
  <input class="nputs w85per padd5" placeholder="Total semanal *" type="number" step="0.1" id="total_tratamiento" name="total_tratamiento"><div class="ask" onclick="trquest();"></div>
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
<div class="tratnfo">
   Por Razón Necesaria  <input class="mar3" type="checkbox" name="variante_tratamiento">
</div>
<div class="addmeds">
            <textarea class="tarea95new" name="observa_tratamiento" placeholder="Observaciones / Descripción" ></textarea>
</div>   
        <div class="separator"></div>
    <button type="submit" class="nputsave" id="savetrata" onclick="save_trata('<?php echo $rid ?>');" >Guardar</button>             
</div>
<div id="listfrtr" class="ldcntup2"></div>
    <div id="movsfrtr" class="ldcntup2"></div>
        <div id="histfrtr" class="ldcntup2"></div>    
     </div>
<?php require_once ("funcs.php"); ?>