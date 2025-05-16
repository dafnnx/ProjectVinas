<?php	require_once ("../cn/connect2.php"); 		?>
<div class="info gral">
 <div id="repenfer">
	<div class="repscn">
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="ta" value="ta"><br>TA</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="fc" value="fc"><br>FC</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="fr" value="fr"><br>FR</div>
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="sat" value="sat"><br>O2</div>
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="temp" value="temp"><br>Temp</div>
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="gli" value="gli"><br>Glicemia</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="percen_ing" value="percen_ing"><br>% Comida</div>
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="cant_liq" value="cant_liq"><br>Cant. Liq.</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="no_mic" value="no_mic"><br>#Micciones</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="no_evac" value="no_evac"><br>#Evacua</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="no_panal" value="no_panal"><br>#Pañales</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="visita" value="visita"><br>Visita</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="caida" value="caida"><br>Caida</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="deam" value="deam"><br>Deambulo</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="bano" value="bano"><br>Baño</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="bucal" value="bucal"><br>A. Bucal</div>	
		<div class="padd3 tcenter textcenter"><input type="checkbox" name="terap" value="terap"><br>T. Fisica</div>	
	</div>
<div class="repscn">
	<div class="w40per mleftmini">
<select class="nputs w100per innmarg10" name="f3" id="q3"> 
		<option disabled selected>Selecciona residente</option>
<?php
	$result = $db2->prepare("SELECT id_residente AS idr, nombre_residente AS nor FROM residentes WHERE status_residente=1 ORDER BY nombre_residente ASC");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){ 	
		$idr= $row['idr'];
		$nor= $row['nor']; ?>
		<option value="<?php echo $idr;  ?>" ><?php echo $nor;  ?></option>
<?php	} ?>
</select>
	</div>	
	<div class="w15per">
		<input type="date" class="inn padd6" name="fi" id="q1" >		
	</div>	
	<div class="w15per mleftmini">
		<input type="date" class="inn padd6" name="ff" id="q2" >		
	</div>	
	<div class="w15per mleftmini">
<select class="nputs w100per innmarg10" name="orient" id="orient"> 
		<option disabled selected>Orientación</option>
		<option value="1" >Vertical</option>
		<option value="2" >Horizontal</option>
</select>	
	</div>		
	<div class="w15per mleftmini">
		<div id="buscar" class="nputrep innmarg10" onclick="xenferfecha();">Consultar</div>
	</div>	
</div>
</div>
<div class="resultrep" id="xresuenfe"></div>
</div>