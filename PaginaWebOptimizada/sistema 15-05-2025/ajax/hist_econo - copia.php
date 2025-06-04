<?php $idr= $_POST['idr'];
	  $nr= $_POST['nr'];
 ?>
<div class="gastosmain">
	<div class="ribbon">GASTOS DE <?php echo $nr; ?></div>
	<div class="separator"></div>	
			<div class="gralmain">
		<div class="paycnt">
			<div class="btnpay pointer" onclick="showhide('paycon', 'paymont', 'cons', '<?php echo $idr;?>');">CONCEPTOS</div>
			<div class="btnpay pointer" onclick="showhide('paymont', 'paycon', 'mens');">MENSUALIDADES</div>
		</div>
<div id="paycon" class="paycon">


	<div id="selecon">
	  <div class="histinfo">
	  	<input type="hidden" name="id_residente" id="id_residente" value="<?php echo $idr;?>">
		<div class="subhist15 "><input class="nputs w90per" type="date" name="fecha_pay" id="fecha_pay"> </div>
		<div class="subhist40 "><input class="nputs w95per" type="text" name="concept_pay" id="concept_pay" placeholder="Concepto"></div>
		<div class="subhist15 "><input class="nputs w90per aaa" type="number" step="any" id="precio_pay" name="precio_pay" placeholder="$ Precio" onkeyup="multi();"></div>
		<div class="subhist5 "><input class="nputs w80per aaa" type="number" id="cantidad_pay" name="cantidad_pay" placeholder="Qty" step="any" onkeyup="multi();"></div>		
		<div class="subhist15 "><input class="nputs w90per" type="number" step="any" id="debe_pay" name="debe_pay" value="0" placeholder="$ Total"></div>
		<div class="subhist15 "><input class="nputs w90per" type="number" step="any" name="aporta_pay" placeholder="$ Aporta"></div>
		<div class="subhist15 "><input type="submit" class="nputsave" id="saveecon" onclick="save_pay_cons('<?php echo $idr;?>');" value="Guardar"></div>
	  </div>	
	</div>



  		<div class="tbldata" id="resiecon"></div>
</div>
<div id="paymont" class="paymont">
	<form id="selemont" method="POST">
	  <div class="histinfo">
	  	<input type="hidden" name="id_residente" id="id_residente" value="<?php echo $idr;?>">
	  </div>	
	</form>
  		<div class="tbldata" id="resiemont"></div>
</div> 
			</div>
</div>