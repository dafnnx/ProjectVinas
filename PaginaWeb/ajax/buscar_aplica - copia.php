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

		if ($siet) {				?>

<div class="hrfull" id="7h">
	<input type="hidden" value="<?php echo $idr; ?>" name="idr_aplic">
	<input type="hidden" value="<?php echo $idt; ?>" name="idt_aplic">
	<input type="hidden" value="<?php echo $fec; ?>" name="fech_aplic">
	<input type="hidden" value="<?php echo $med; ?>" name="med_aplic">
	<input type="hidden" value="<?php echo $siet; ?>" name="qty_aplic">
	<div class="w10per ln30"><strong>7h</strong></div>
	<div class="w10per ln30">Dosis: <strong><?php echo $siet; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_7h">  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w30per mr4px" name="inc_7h">  
    <option selected value="N/A" readony>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w30per mr4px" name="mot_7h">  
    <option selected value="N/A" readony>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
<div class="nputs w10per"> 
			<button type="submit" class="nputsave" id="save_7h" onclick="saveapp('7h');">Aplicar</button>
</div>
</div>

		<?php 	}		else { } 
		if ($och) { ?>

<div class="hrfull" id="8h">
	<div class="w10per ln30"><strong>8h</strong></div>
	<div class="w10per ln30">Dosis: <strong><?php echo $och; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_<?php echo $och; ?>">  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w30per mr4px" name="inc_<?php echo $och; ?>">  
    <option selected disabled>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w30per mr4px" name="mot_<?php echo $och; ?>">  
    <option selected disabled>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
<div class="nputs w10per"> 
			<button type="submit" class="nputsave" id="save-<?php echo $och; ?>" onclick="saveapp('<?php echo $och; ?>');">Aplicar</button>
</div>
</div>

<?php		}	else { } 
		if ($trce) {		 ?>

<div class="hrfull" id="8h">
	<div class="w10per ln30"><strong>13h</strong></div>
	<div class="w10per ln30">Dosis: <strong><?php echo $trce; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_<?php echo $trce; ?>">  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w30per mr4px" name="inc_<?php echo $trce; ?>">  
    <option selected disabled>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w30per mr4px" name="mot_<?php echo $trce; ?>">  
    <option selected disabled>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
<div class="nputs w10per"> 
			<button type="submit" class="nputsave" id="save-<?php echo $trce; ?>" onclick="saveapp('<?php echo $trce; ?>');">Aplicar</button>
</div>
</div>

<?php		}	else { } 
	if ($dieco) {		 ?>

<div class="hrfull" id="8h">
	<div class="w10per ln30"><strong>18h</strong></div>
	<div class="w10per ln30">Dosis: <strong><?php echo $dieco; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_<?php echo $dieco; ?>">  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w30per mr4px" name="inc_<?php echo $dieco; ?>">  
    <option selected disabled>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w30per mr4px" name="mot_<?php echo $dieco; ?>">  
    <option selected disabled>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
<div class="nputs w10per"> 
			<button type="submit" class="nputsave" id="save-<?php echo $dieco; ?>" onclick="saveapp('<?php echo $dieco; ?>');">Aplicar</button>
</div>
</div>

<?php		}	else { } 
		if ($vtuno) {		 ?>

<div class="hrfull" id="8h">
	<div class="w10per ln30"><strong>21h</strong></div>
	<div class="w10per ln30">Dosis: <strong><?php echo $vtuno; ?></strong></div>
<select class="nputs w10per mr4px" name="opt_<?php echo $vtuno; ?>">  
      <option selected disabled>Aplicar</option> 
        <option value="1">Si</option>     
        <option value="2">No</option>       
</select>
<select class="nputs w30per mr4px" name="inc_<?php echo $vtuno; ?>">  
    <option selected disabled>Incidencia</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM incidencias ORDER BY nombre_incidencia");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_incidencia']; ?>"><?php echo $row['nombre_incidencia']; ?></option>
      <?php   }   ?>
</select>
<select class="nputs w30per mr4px" name="mot_<?php echo $vtuno; ?>">  
    <option selected disabled>Motivo</option>       
      <?php
    $count_query= $db2->prepare("SELECT * FROM motivos ORDER BY nombre_motivo");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){ ?>
          <option value="<?php echo $row['id_motivo']; ?>"><?php echo $row['nombre_motivo']; ?></option>
      <?php   }   ?>
 </select>
<div class="nputs w10per"> 
			<button type="submit" class="nputsave" id="save-<?php echo $vtuno; ?>" onclick="saveapp('<?php echo $vtuno; ?>');">Aplicar</button>
</div>
</div>

<?php		}	 ?>