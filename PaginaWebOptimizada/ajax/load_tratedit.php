<?php
$idt= $_POST['idt'];
$rid= $_POST['rid'];
    require_once ("../cn/connect2.php");

    $qedit=$db2->prepare("SELECT * FROM tratamientos WHERE id_tratamiento=:id");
    $qedit->bindParam(':id', $idt);
    $qedit->execute(); 
        for($i=0; $row = $qedit->fetch(); $i++){  
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
                       } 
if ($consul) {
    $qeit=$db2->prepare("SELECT motivo_notamed AS mnmed FROM nota_medica WHERE id_notamed=:cs");
    $qeit->bindParam(':cs', $consul);
    $qeit->execute(); 
        for($i=0; $row = $qeit->fetch(); $i++){       $mnmed = $row['mnmed'];       }    }  

if ($medt) {
    $cyed= $db2->prepare("SELECT nombre_medica AS nmeded FROM medicamentos WHERE id_medica=:mt");
    $cyed->bindParam(':mt', $medt);
    $cyed->execute();
        for($i=0; $row = $cyed->fetch(); $i++){    $nmeded = $row['nmeded'];    }   }

if ($viam) {
    $cy2ed= $db2->prepare("SELECT nombre_via AS nviaed FROM vias WHERE id_via=:id");
    $cy2ed->bindParam(':id', $viam);
    $cy2ed->execute();
    for($i=0; $row = $cy2ed->fetch(); $i++){    $nviaed = $row['nviaed'];       }     }

if ($unim) {
    $cy3ed= $db2->prepare("SELECT nombre_unidad AS nunied FROM unidades WHERE id_unidad=:id");
    $cy3ed->bindParam(':id', $unim);
    $cy3ed->execute();
    for($i=0; $row = $cy3ed->fetch(); $i++){  $nunied = $row['nunied'];     }     }

?>
<div id="seledittrata">
  <input type="hidden" name="idt_up" value="<?php echo $idt ?>">
        <div class="miniseparator"></div>      
<table class="infotabtr cien">  
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
    <td><input class="nputs w95" type="date" name="fecha_inied" value="<?php echo $fini ?>"></td>  
    <td><input class="nputs w95" type="date" name="fecha_fined" value="<?php echo $ffin ?>" onchange="date_check(this.value);"></td>  
    <td>
       <select id="fmedicaed" lang="es" class="nputs w250" name="med_tratamientoed">
        <option value="<?php echo $medt ?>"><?php echo $nmeded ?></option>
      </select>
    </td>  
    <td>
      <select id="rmviaed" class="nputs w95" lang="es" class="nputs " name="via_medicamentoed">
        <option value="<?php echo $viam ?>"><?php echo $nviaed ?></option>
      </select>
    </td>  
    <td>
      <select id="rmunidaded" class="nputs w95" lang="es" class="nputs" name="unidad_medicamentoed">
        <option value="<?php echo $unim ?>"><?php echo $nunied ?></option>
      </select>
    </td>
    <td><input class="mar3" type="checkbox" name="daysup[]" value="1" <?php if (in_array("1", $dias)) echo "checked"; ?>></td> 
    <td><input class="mar3" type="checkbox" name="daysup[]" value="2" <?php if (in_array("2", $dias)) echo "checked"; ?>></td> 
    <td><input class="mar3" type="checkbox" name="daysup[]" value="3" <?php if (in_array("3", $dias)) echo "checked"; ?>></td> 
    <td><input class="mar3" type="checkbox" name="daysup[]" value="4" <?php if (in_array("4", $dias)) echo "checked"; ?>></td> 
    <td><input class="mar3" type="checkbox" name="daysup[]" value="5" <?php if (in_array("5", $dias)) echo "checked"; ?>></td> 
    <td><input class="mar3" type="checkbox" name="daysup[]" value="6" <?php if (in_array("6", $dias)) echo "checked"; ?>></td> 
    <td><input class="mar3" type="checkbox" name="daysup[]" value="7" <?php if (in_array("7", $dias)) echo "checked"; ?>></td> 
    <td><input class="variant" type="text" value="<?php echo $diat ?>" name="dia_tratamientoed" autocomplete="off" ></td> 
    <td><input class="variant" type="text" value="<?php echo $siet ?>" name="siet_tratamientoed" autocomplete="off"></td>  
    <td><input class="variant" type="text" value="<?php echo $och ?>" name="och_tratamientoed" autocomplete="off"></td>
    <td><input class="variant" type="text" value="<?php echo $trce ?>" name="trce_tratamientoed" autocomplete="off"></td>
    <td><input class="variant" type="text" value="<?php echo $dieco ?>" name="dieco_tratamientoed" autocomplete="off"></td>
    <td><input class="variant" type="text" value="<?php echo $vtuno ?>" name="vtuno_tratamientoed" autocomplete="off"></td>  
  </tr>
</table>
<div class="tratnfo">
<div class="frst">
  <input class="nputs w85per padd5" placeholder="Total semanal *" type="number" step="0.1" value="<?php echo $totl ?>" name="total_tratamientoed"><div class="ask" onclick="trquest();"></div>
</div>
  <div class="frst mleftmini">
    <select class="nputs w100per" lang="es" name="tipomed_tratamientoed">
            <option value="<?php echo $tipom ?>" selected ><?php echo $tipom ?></option>
            <option value="Aguda">Aguda</option>
            <option value="Cronica">Cronica</option>
            <option value="Placebo">Placebo</option>
            <option value="Urgente">Urgente</option>
    </select>
  </div>  
<div class="frst mleftmini">
  <input class="nputs w100per padd4" name="pauta_tratamientoed" value="<?php echo $pauta ?>" placeholder="Pauta">
</div>
<div class="frst frsthalf mleftmini"> 
    <select class="nputs w100per padd4" name="consul_tratamientoed">
            <option value="<?php echo $consul ?>" selected><?php echo $mnmed ?></option>
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
   <textarea class="tarea95new" name="variante_tratamientoed" rows="5" placeholder="Variante"><?php echo $varit ?></textarea> 
<div class="addmeds">
            <textarea class="tarea95new" name="observa_tratamientoed" placeholder="Observaciones"><?php echo $observa ?></textarea>
</div>   
        <div class="separator"></div>
    <button type="submit" class="nputsave" id="saveedittrata" onclick="save_edittrata('<?php echo $rid; ?>');">Editar</button>  
</div> 
    <?php require_once ("funcs.php"); ?>