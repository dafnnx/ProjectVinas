<?php 
$idr= $_POST['idr'];
$idt= $_POST['idt'];
$fec= $_POST['fec'];
$theh= $_POST['theh'];
require_once ("../cn/connect2.php"); ?>
    <div class="ribbon">Aplicar</div>  
<?php 	
        $ry=$db2->prepare("SELECT * FROM tratamientos WHERE id_tratamiento=:idt");
				$ry->bindParam(':idt', $idt);			
				$ry->execute();
				for($i=0; $row = $ry->fetch(); $i++){
						$med=$row['med_tratamiento'];
						$siet=$row['siet_tratamiento'];
						$och=$row['och_tratamiento'];
						$trce=$row['trce_tratamiento'];
						$dieco=$row['dieco_tratamiento'];
						$vtuno=$row['vtuno_tratamiento'];	}   

if ($theh) {

switch ($theh) {
case "7h":    $horas = array('7h' => $siet);    break;
case "8h":    $horas = array('8h' =>$och);    break;
case "13h":    $horas = array('13h' =>$trce);  break;
case "18h":    $horas = array('18h' =>$dieco);  break;
case "21h":    $horas = array('21h' =>$vtuno);  break;
  default:
}    
    } else {     $horas = array('7h' => $siet, '8h' =>$och, '13h' =>$trce, '18h' =>$dieco, '21h' =>$vtuno); }

foreach($horas as $hora => $qty)    {   
If (!empty($qty)) {

    $ctquery= $db2->prepare("SELECT * FROM hist_inventarios WHERE id_residente=:idr AND id_tratamiento=:idt AND fech_hinv=:fec");
    $ctquery->bindParam(':idr', $idr);
    $ctquery->bindParam(':idt', $idt);  
    $ctquery->bindParam(':fec', $fec);
    $ctquery->execute();
    for($i=0; $row = $ctquery->fetch(); $i++){   
     $opt = $row[''.$hora.'opt_hinv'];
     switch ($opt) {   case '1': $opt="Si"; break;
                       case '2': $opt="No"; break;      } 
     $idin = $row[''.$hora.'inc_hinv'];
     $idmot = $row[''.$hora.'mot_hinv'];
     $obs = $row[''.$hora.'obs_hinv'];   }
     
        $count_inc= $db2->prepare("SELECT nombre_incidencia AS nominc FROM incidencias WHERE id_incidencia=:idin");
        $count_inc->bindParam(':idin', $idin);
        $count_inc->execute();
        for($i=0; $row = $count_inc->fetch(); $i++){          $nominc= $row['nominc'];         }

        $count_mot= $db2->prepare("SELECT nombre_motivo AS nommot FROM motivos WHERE id_motivo=:idmot");
        $count_mot->bindParam(':idmot', $idmot);
        $count_mot->execute();
        for($i=0; $row = $count_mot->fetch(); $i++){          $nommot= $row['nommot'];         }          ?>

<div class="hrfull" id="<?php echo $hora; ?>">
  <input type="hidden" value="<?php echo $idr; ?>" name="idr_aplic">
  <input type="hidden" value="<?php echo $idt; ?>" name="idt_aplic">
  <input type="hidden" value="<?php echo $hora; ?>" name="hr_aplic">
  <input type="hidden" value="<?php echo $fec; ?>" name="fech_aplic">
  <input type="hidden" value="<?php echo $med; ?>" name="med_aplic">
  <input type="hidden" value="<?php echo $qty; ?>" name="qty_aplic">
  <div class="w5per ln30"><strong><?php echo $hora; ?></strong></div>
  <div class="w7per ln30">Dosis: <strong><?php echo $qty; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_aplic-<?php echo $hora; ?>" onchange="saveapp('<?php echo $hora; ?>');" >  
      <option selected disabled> <?php if ($opt) {  echo $opt;  } else { echo "Aplicar"; }  ?> </option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w25per mr4px" name="inc_<?php echo $hora; ?>" onchange="savevars('inc', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $hora; ?>', this.value)">  
    <option selected value="N/A" readony> <?php if ($nominc) {  echo $nominc;  } else { echo "Incidencia"; }  ?> </option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w25per mr4px" name="mot_<?php echo $hora; ?>" onchange="savevars('mot', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $hora; ?>', this.value)">  
    <option selected value="N/A" readony>  <?php if ($nommot) {  echo $nommot;  } else { echo "Motivo"; }  ?> </option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
 <input class="nputs w30per" type="text" name="obs_<?php echo $hora; ?>" value="<?php if ($obs) {  echo $obs;  } else { }  ?>" placeholder="Observaciones..." onkeyup="savevars('obs', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $hora; ?>', this.value)" >
</div>
<?php   }   }       ?>