<div class="infosub gral">
<?php
 $idt= $_POST['idt'];
    require_once ("../cn/connect2.php"); 
    $query=$db2->prepare("SELECT * FROM tratamientos WHERE id_tratamiento=:idt");
    $query->bindParam(':idt', $idt);
    $query->execute(); 
        $j=1;
        for($i=0; $row = $query->fetch(); $i++){
          $rid= $row['id_residente'];
          $fini= $row['fecha_ini'];
          $ffin= $row['fecha_fin'];  
          $medt= $row['med_tratamiento'];
          $viam= $row['via_medicamento'];
          $unim= $row['unidad_medicamento'];
          $semm= $row['semana_tratamiento'];
          if(isset($semm))
                {       $dias=explode(",",$semm);  }
          $varit= $row['variante_tratamiento'];
          $totl= $row['total_tratamiento'];
          $diat= $row['dia_tratamiento'];
          $siet= $row['siet_tratamiento'];
          $och= $row['och_tratamiento'];
          $trce= $row['trce_tratamiento'];
          $dieco= $row['dieco_tratamiento'];
          $vtuno= $row['vtuno_tratamiento'];
          $pauta= $row['pauta_tratamiento'];
          $observa= $row['observa_tratamiento'];
          $patolo= $row['patolo_tratamiento'];
          $tipom= $row['tipom_tratamiento'];
          $status= $row['status_tratamiento'];
          $consul= $row['consul_tratamiento'];  

    $ery=$db2->prepare("SELECT * FROM nota_medica WHERE id_notamed=:consul");
    $ery->bindParam(':consul', $consul);
    $ery->execute();
    for($i=0; $row = $ery->fetch(); $i++){
    $idned= $row['id_notamed'];
    $fnmed= $row['fec_notamed'];
    $moted= $row['motivo_notamed']; 
$fconed = new DateTime($fnmed);
$fconned = $fconed->format("d-M-Y");
}         


$finife = new DateTime($fini);
$finif = $finife->format("d-M-Y");
$ffinf = new DateTime($ffin);
$ffinef = $ffinf->format("d-M-Y");  ?>
<div id="upfrtredit">
<table class="infotabtr cien">  
  <tr>
    <td>Desde</td>
    <td>Hasta</td>   
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
      <input type="hidden" name="idt" value="<?php echo $idt ?>" readonly>
    <td><input class="nputs w95" type="date" name="fecha_inied" value="<?php echo $fini ?>"></td>  
    <td><input class="nputs w95" type="date" name="fecha_fined" value="<?php echo $ffin ?>"></td>  
    <td>
       <select id="fmedicaed" lang="es" class="nputs w250" id="m_trataed" name="med_tratamientoed">
        <option value="<?php echo $medt ?>">Medicamento</option>
      </select>
    </td>  
    <td>
      <select id="rmviaed" class="nputs w95" lang="es" class="nputs " name="via_medicamentoed">
        <option value="<?php echo $viam ?>">Vía</option>
      </select>
    </td>  
    <td>
      <select id="rmunidaded" class="nputs w95" lang="es" class="nputs" name="unidad_medicamentoed">
        <option value="<?php echo $unim ?>">Unidad</option>
      </select>
    </td>
    <td><input class="mar3" type="checkbox" <?php if (in_array("1", $dias)) echo "checked"; ?> value="1" name="daysed[]"></td> 
    <td><input class="mar3" type="checkbox" <?php if (in_array("2", $dias)) echo "checked"; ?> value="2" name="daysed[]"></td> 
    <td><input class="mar3" type="checkbox" <?php if (in_array("3", $dias)) echo "checked"; ?> value="3" name="daysed[]"></td> 
    <td><input class="mar3" type="checkbox" <?php if (in_array("4", $dias)) echo "checked"; ?> value="4" name="daysed[]"></td> 
    <td><input class="mar3" type="checkbox" <?php if (in_array("5", $dias)) echo "checked"; ?> value="5" name="daysed[]"></td> 
    <td><input class="mar3" type="checkbox" <?php if (in_array("6", $dias)) echo "checked"; ?> value="6" name="daysed[]"></td> 
    <td><input class="mar3" type="checkbox" <?php if (in_array("7", $dias)) echo "checked"; ?> value="7" name="daysed[]"></td> 
    <td><input class="variant" type="text" name="dia_tratamientoed" value="<?php echo $diat ?>" autocomplete="off" ></td> 
    <td><input class="variant" type="text" name="siet_tratamientoed" value="<?php echo $siet ?>" autocomplete="off"></td>  
    <td><input class="variant" type="text" name="och_tratamientoed" value="<?php echo $och ?>" autocomplete="off"></td>
    <td><input class="variant" type="text" name="trce_tratamientoed" value="<?php echo $trce ?>" autocomplete="off"></td>
    <td><input class="variant" type="text" name="dieco_tratamientoed" value="<?php echo $dieco ?>" autocomplete="off"></td>
    <td><input class="variant" type="text" name="vtuno_tratamientoed" value="<?php echo $vtuno ?>" autocomplete="off"></td>  
  </tr>
</table>
<div class="tratnfo">
<div class="frst">
  <input class="nputs w75per padd5" placeholder="Total semanal *" value="<?php echo $totl ?>" type="number" step="any" id="total_tratamientoed" name="total_tratamientoed"><div class="ask" onclick="trquest();"></div>
</div>
<!--<div class="subtrat9">
      <select id="rmpatologia" lang="es" class="slectfl" name="patolo_tratamiento">
        <option value="N/A">Patología</option>
      </select>
  </div>-->
  <div class="frst mleftmini">
    <select class="nputs w100per" lang="es" name="tipomed_tratamientoed">
            <option selected><?php echo $tipom ?></option>
            <option>Cronica</option>
            <option>Placebo</option>
            <option>Urgente</option>
    </select>
  </div>  
<div class="frst mleftmini">
  <input class="nputs w100per padd4" name="pauta_tratamientoed" value="<?php echo $pauta ?>" placeholder="Pauta">
</div>
<div class="frst frsthalf mleftmini"> 
    <select class="nputs w100per padd4" lang="es" id="consul_tratamientoed" name="consul_tratamientoed">
            <option selected value="<?php echo $idned ?>"><?php echo $moted ?> - <?php echo $fconned ?></option>
<?php
    $query=$db2->prepare("SELECT * FROM nota_medica WHERE id_residente=:id");
    $query->bindParam(':id', $rid);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){
    $idn= $row['id_notamed'];
    $fnm= $row['fec_notamed'];
    $mot= $row['motivo_notamed']; 

$fcon = new DateTime($fnm);
$fconn = $fcon->format("d-M-Y");    ?>
            <option value="<?php echo $idn ?>"><?php echo $mot ?> - <?php echo $fconn ?></option>
     <?php      }    ?>
    </select>
</div>
<div class="frst mleftmini">
  <input type="submit" class="nputsave" id="savetrataed" value="Actualizar" onclick="actrata('<?php echo $idt ?>');">
</div>
</div>  
   <textarea class="tarea95new" name="variante_tratamientoed" rows="5" placeholder="Variantes" ><?php echo $varit ?></textarea> 
   <textarea class="tarea" name="observa_tratamientoed" placeholder="Observaciones" ><?php echo $observa ?></textarea>
</div> 

<?php } ?>
    <div id="listfrtr" class="ldcntup2">
        <div class="tbldata" id="resitrtable"></div>      
    </div>
  </div>
</div>

<?php 
include ("modal_trataedited.php");
include ("funcs.php"); ?>