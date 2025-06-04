<?php 	
require_once('../cn/connect2.php'); 
	  	$uid=$_POST['uid']; 		
	$result = $db2->prepare("SELECT user_name AS usr FROM users WHERE user_id=:uid");
	$result->bindParam(':uid', $uid);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){ 	$usr= $row['usr'];	}

		$count_query= $db2->prepare("SELECT count(*) AS nrows FROM payconcept WHERE user_id=:uid AND status=1");
		$count_query->bindParam(':uid', $uid);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){	$nrows = $row['nrows'];	}

if ($nrows) {
		$cres = $db2->prepare("SELECT nombre_residente AS nres, id_residente AS ires FROM residentes WHERE id_residente=(SELECT id_residente AS idresi FROM payconcept WHERE id_pay=(SELECT MAX(id_pay) AS idp FROM payconcept WHERE user_id=:uid AND status=1))");
		$cres->bindParam(':uid', $uid);
		$cres->execute();
		for($i=0; $row = $cres->fetch(); $i++){ 
			$nres= $row['nres'];
			$ires= $row['ires']; 	}
}	?>
<!DOCTYPE html>
<html>
<body>
	<div class="maincaja">
<div class="fzone">
			<div class="superior" id="superiora">
				<input type="hidden" id="usrlabel" value="<?php echo $uid?>">
				<input type="hidden" id="ires" value="<?php echo $ires?>">
				<div class="usrlabel"><?php echo $usr?></div>			
			</div>
			<div class="mosaico">
<div class="ms">
		<input type="text" id="searbarras" onchange="addfast('<?php echo $uid;  ?>')" class="searbarras">		
</div>
<div class="ms2"> 
<select class="nputs w95per fixselect" id="resid" onchange="assgn(this.value, '<?php echo $uid;  ?>');"> 
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
			</div>
</div>
	<div class="dpcaja">
		<div class="cajaprods">
			<input type="text" id="nproducto" class="searind" placeholder="Buscar producto.." onkeyup="searind('<?php echo $uid;  ?>');">	
			<div class="searbox" id="searbox"></div>
		</div>
		<div class="cajapres">
			<div class="ribbon">PRODUCTOS SELECCIONADOS</div>
			<div class="list" id="cajapres"></div>
		</div>
	</div>
	</div>
	<script type="text/javascript" src="js/caja.js"></script>	
</body>
</html>