<?php 
$idr= $_POST['idr'];
$idt= $_POST['idt'];
$fec= $_POST['fec'];
require_once ("../cn/connect2.php"); ?>
    <div class="ribbon">Aplicar</div>  
<?php 			$ry=$db2->prepare("SELECT * FROM tratamientos WHERE id_tratamiento=:idt");
				$ry->bindParam(':idt', $idt);			
				$ry->execute();
				for($i=0; $row = $ry->fetch(); $i++){
						$med=$row['med_tratamiento'];
						$siet=$row['siet_tratamiento'];
						$och=$row['och_tratamiento'];
						$trce=$row['trce_tratamiento'];
						$dieco=$row['dieco_tratamiento'];
						$vtuno=$row['vtuno_tratamiento'];	
}

		if ($siet) {		$valu= "7h";    		?>
			

<div class="hrfull" id="<?php echo $valu; ?>">
	<input type="hidden" value="<?php echo $idr; ?>" name="idr_aplic">
	<input type="hidden" value="<?php echo $idt; ?>" name="idt_aplic">
	<input type="hidden" value="<?php echo $valu; ?>" name="hr_aplic">
	<input type="hidden" value="<?php echo $fec; ?>" name="fech_aplic">
	<input type="hidden" value="<?php echo $med; ?>" name="med_aplic">
	<input type="hidden" value="<?php echo $siet; ?>" name="qty_aplic">
	<div class="w5per ln30"><strong><?php echo $valu; ?></strong></div>
	<div class="w7per ln30">Dosis: <strong><?php echo $siet; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_aplic" onchange="saveapp('<?php echo $valu; ?>');" >  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w25per mr4px" name="inc_<?php echo $valu; ?>" onchange="savevars('inc', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w25per mr4px" name="mot_<?php echo $valu; ?>" onchange="savevars('mot', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
 <input class="nputs w30per" type="text" name="obs_<?php echo $valu; ?>" placeholder="Observaciones..." onkeyup="savevars('obs', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)" >
</div>


		<?php 	}		else { } 
		if ($och) {   $valu= "8h";       ?>



<div class="hrfull" id="<?php echo $valu; ?>">
  <input type="hidden" value="<?php echo $idr; ?>" name="idr_aplic">
  <input type="hidden" value="<?php echo $idt; ?>" name="idt_aplic">
  <input type="hidden" value="<?php echo $valu; ?>" name="hr_aplic">
  <input type="hidden" value="<?php echo $fec; ?>" name="fech_aplic">
  <input type="hidden" value="<?php echo $med; ?>" name="med_aplic">
  <input type="hidden" value="<?php echo $och; ?>" name="qty_aplic">
  <div class="w5per ln30"><strong><?php echo $valu; ?></strong></div>
  <div class="w7per ln30">Dosis: <strong><?php echo $och; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_aplic" onchange="saveapp('<?php echo $valu; ?>');" >  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w25per mr4px" name="inc_<?php echo $valu; ?>" onchange="savevars('inc', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w25per mr4px" name="mot_<?php echo $valu; ?>" onchange="savevars('mot', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
 <input class="nputs w30per" type="text" name="obs_<?php echo $valu; ?>" placeholder="Observaciones..." onkeyup="savevars('obs', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)" >
</div>




<?php		}	else { } 
		if ($trce) {  	$valu= "13h";  	 ?>



<div class="hrfull" id="<?php echo $valu; ?>">
  <input type="hidden" value="<?php echo $idr; ?>" name="idr_aplic">
  <input type="hidden" value="<?php echo $idt; ?>" name="idt_aplic">
  <input type="hidden" value="<?php echo $valu; ?>" name="hr_aplic">
  <input type="hidden" value="<?php echo $fec; ?>" name="fech_aplic">
  <input type="hidden" value="<?php echo $med; ?>" name="med_aplic">
  <input type="hidden" value="<?php echo $trce; ?>" name="qty_aplic">
  <div class="w5per ln30"><strong><?php echo $valu; ?></strong></div>
  <div class="w7per ln30">Dosis: <strong><?php echo $trce; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_aplic" onchange="saveapp('<?php echo $valu; ?>');" >  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w25per mr4px" name="inc_<?php echo $valu; ?>" onchange="savevars('inc', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w25per mr4px" name="mot_<?php echo $valu; ?>" onchange="savevars('mot', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
 <input class="nputs w30per" type="text" name="obs_<?php echo $valu; ?>" placeholder="Observaciones..." onkeyup="savevars('obs', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)" >
</div>





<?php		}	else { } 
	if ($dieco) {		$valu= "18h";  ?>


<div class="hrfull" id="<?php echo $valu; ?>">
  <input type="hidden" value="<?php echo $idr; ?>" name="idr_aplic">
  <input type="hidden" value="<?php echo $idt; ?>" name="idt_aplic">
  <input type="hidden" value="<?php echo $valu; ?>" name="hr_aplic">
  <input type="hidden" value="<?php echo $fec; ?>" name="fech_aplic">
  <input type="hidden" value="<?php echo $med; ?>" name="med_aplic">
  <input type="hidden" value="<?php echo $dieco; ?>" name="qty_aplic">
  <div class="w5per ln30"><strong><?php echo $valu; ?></strong></div>
  <div class="w7per ln30">Dosis: <strong><?php echo $dieco; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_aplic" onchange="saveapp('<?php echo $valu; ?>');" >  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w25per mr4px" name="inc_<?php echo $valu; ?>" onchange="savevars('inc', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w25per mr4px" name="mot_<?php echo $valu; ?>" onchange="savevars('mot', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
 <input class="nputs w30per" type="text" name="obs_<?php echo $valu; ?>" placeholder="Observaciones..." onkeyup="savevars('obs', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)" >
</div>


<?php		}	else { } 
		if ($vtuno) {		$valu= "21h";  ?>



<div class="hrfull" id="<?php echo $valu; ?>">
  <input type="hidden" value="<?php echo $idr; ?>" name="idr_aplic">
  <input type="hidden" value="<?php echo $idt; ?>" name="idt_aplic">
  <input type="hidden" value="<?php echo $valu; ?>" name="hr_aplic">
  <input type="hidden" value="<?php echo $fec; ?>" name="fech_aplic">
  <input type="hidden" value="<?php echo $med; ?>" name="med_aplic">
  <input type="hidden" value="<?php echo $vtuno; ?>" name="qty_aplic">
  <div class="w5per ln30"><strong><?php echo $valu; ?></strong></div>
  <div class="w7per ln30">Dosis: <strong><?php echo $vtuno; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_aplic" onchange="saveapp('<?php echo $valu; ?>');" >  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w25per mr4px" name="inc_<?php echo $valu; ?>" onchange="savevars('inc', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w25per mr4px" name="mot_<?php echo $valu; ?>" onchange="savevars('mot', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)">  
    <option selected value="N/A" readony>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
 <input class="nputs w30per" type="text" name="obs_<?php echo $valu; ?>" placeholder="Observaciones..." onkeyup="savevars('obs', '<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>', '<?php echo $valu; ?>', this.value)" >
</div>



<?php		}	 ?>