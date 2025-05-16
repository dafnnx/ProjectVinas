<?php 	$idr= $_POST['idr'];
	  		$nr= $_POST['nr'];
	  require_once ("../cn/connect2.php");
	  require_once ("../functions.php");
 ?>
<div class="gastosmain">
	<div class="ribbon">GASTOS DE <?php echo $nr; ?></div>
	<div class="miniseparator"></div>	
			<div class="gralmain">
		<div class="paycnt">
			<div class="btnpay pointer" onclick="showhide('paycon', 'paymont', 'conrep', 'cons', '<?php echo $idr;?>');">CONCEPTOS</div>
			<div class="btnpay pointer" onclick="showhide('paycon', 'paymont', 'conrep', 'mens', '<?php echo $idr;?>'); ">MENSUALIDADES</div>
			<div class="btnpay pointer" onclick="showhide('paycon', 'paymont', 'conrep', 'crep', '<?php echo $idr;?>');">REPORTE</div>
		</div>
<div class="miniseparator"></div>
<div id="paycon" class="paycon">		
<div class="monthvar mb5" id="hnfo1">
	<div class="btnswitch pointer" onclick="showhide2()"></div>
	  	<input type="hidden" name="id_residente" id="id_residente" value="<?php echo $idr;?>">
		<div class="subhist20 "><input class="nputs w90per" type="datetime-local" name="fecha_pay" id="fecha_pay"> </div>
		<div class="subhist40 ">
			<input class="nputs w95per" type="text" name="concept_pay" id="concept_pay" placeholder="Concepto">
			<select class="nputs w95per dpnone" name="invconcept_pay" id="invconcept_pay" onchange="set_price(this.value)">
				<option disabled selected></option>
	<?php 		$cry= $db2->prepare("SELECT id_medica AS idm, nombre_medica AS nbm, pventa_medica AS pvem FROM medicamentos");
    			$cry->execute();
    			for($i=0; $row = $cry->fetch(); $i++){   ?> 
						<option value="<?php echo $row['idm'];?>, <?php echo $row['pvem'];?>"> <?php echo $row['nbm'];?></option>
    			<?php	} ?>
			</select>	
		</div>
		<div class="subhist15 "><input class="nputs w90per aaa" type="number" step="any" id="precio_pay" name="precio_pay" placeholder="$ Precio" onkeyup="multi();"></div>
		<div class="subhist5 "><input class="nputs w80per aaa" type="number" id="cantidad_pay" name="cantidad_pay" placeholder="Qty" value="1" step="any" onkeyup="multi();"></div>		
		<div class="subhist15 "><input class="nputs w90per" type="number" step="any" id="debe_pay" name="debe_pay" value="0" placeholder="$ Total"></div>
		<div class="subhist15 "><input class="nputs w90per" type="number" step="any" id="aporta_pay" name="aporta_pay" placeholder="$ Aporta"></div>
</div>	
<div class="monthvar">
<select name="fpago_pay" id="fpago_pay" class="nputs subpren25">
  <option disabled selected>F. pago</option>
  <?php
    $fpagos= check_fpagos();
    foreach ($fpagos as $fpagoss):  ?>
    <option value="<?php echo $fpagoss['nombre_fpago'];?>"> <?php echo $fpagoss['nombre_fpago'];?></option>
  <?php endforeach;  ?>
</select>
			<div class="subpren65 "><input type="text" id="persona_pay" name="persona_pay" placeholder="Persona" class="nputs w100per"></div>
			<div class="subhist15 "><input type="submit" class="nputsave" id="saveecon" onclick="save_pay_cons('<?php echo $idr;?>');" value="Guardar"></div>
</div>
  		<div class="tbldata" id="resiecon"></div>
</div>


<div id="paymont" class="paymont">
<div class="monthvar">
			<div class="subhist15 ">Fecha pago <?php echo $datss;?></div>
			<div class="subhist15 ">Mes a pagar</div>
			<div class="subhist15 ">Abonos del mes</div>			
			<div class="subhist15 ">Cuota del mes</div>
			<div class="subhist15 ">Diferencia</div>
			<div class="subhist15 ">Abono</div>
			<div class="subhist15 ">F. pago</div>
</div>
	<div class="monthvar mb5">
			<div class="subhist15 "><input class="nputs w90per" type="date" name="fecha_month" value="<?php echo date('Y-m-d');?>"> </div>
			<div class="subhist15 ">
			<select class="nputs w95per" name="month_month" id="month_month" onchange="load_count('<?php echo $idr;?>', this.value)">
				<option selected disabled>Seleccionar</option>
				<option value="<?php echo date('Y');?>-01"><?php echo date('Y');?>-01</option>
				<option value="<?php echo date('Y');?>-02"><?php echo date('Y');?>-02</option>
				<option value="<?php echo date('Y');?>-03"><?php echo date('Y');?>-03</option>
				<option value="<?php echo date('Y');?>-04"><?php echo date('Y');?>-04</option>
				<option value="<?php echo date('Y');?>-05"><?php echo date('Y');?>-05</option>
				<option value="<?php echo date('Y');?>-06"><?php echo date('Y');?>-06</option>
				<option value="<?php echo date('Y');?>-07"><?php echo date('Y');?>-07</option>
				<option value="<?php echo date('Y');?>-08"><?php echo date('Y');?>-08</option>
				<option value="<?php echo date('Y');?>-09"><?php echo date('Y');?>-09</option>
				<option value="<?php echo date('Y');?>-10"><?php echo date('Y');?>-10</option>
				<option value="<?php echo date('Y');?>-11"><?php echo date('Y');?>-11</option>
				<option value="<?php echo date('Y');?>-12"><?php echo date('Y');?>-12</option>
			</select>	
			</div>
<div class="subhist15 "><input class="nputs w90per" type="text" name="saldo_month" readonly></div>
<div class="subhist15 "><input class="nputs w90per" type="text" name="tarifa_month" readonly></div>
<div class="subhist15 "><input class="nputs w90per" type="text" name="dife_month" readonly></div>
<div class="subhist15 "><input class="nputs w90per" type="text" name="abono_month" autocomplete="off"></div>
<div class="subhist15 ">
<select name="fpago_month" id="fpago_month" class="nputs w95per">
  <option disabled selected></option>
  <?php
    $fpagos= check_fpagos();
    foreach ($fpagos as $fpagoss):  ?>
    <option value="<?php echo $fpagoss['nombre_fpago'];?>"> <?php echo $fpagoss['nombre_fpago'];?></option>
  <?php endforeach;  ?>
</select>
</div>
	</div>
<div class="monthvar">
			<div class="submont20 "><input type="text" name="int_month" id="int_month" placeholder="Interes" class="nputs w90per"></div>
			<div class="submont20 ">

					<select name="staint_month" id="staint_month" class="nputs w95per">
  						<option disabled selected>Status interes</option>
    					<option value="1">Aprobado</option>
    					<option value="2">Condonado</option>
					</select>

			</div>
			<div class="submont50 "><input type="text" name="persona_month" placeholder="Persona" class="nputs w95per"></div>
			<div class="submont10 "><input type="submit" class="nputsave" id="saveecomnt" onclick="save_pay_months('<?php echo $idr;?>');" value="Guardar"></div>
</div>
<div class="ldcntup">
    <div class="trtbl">
  		<div class="tbldata" id="resiemont"></div>  	
  	</div>
 <!--   <div class="cnbtn2 sbig pointer" onclick="loadyearm('<?php echo $idr; ?>')"></div> -->
</div>	
</div> 

<div id="conrep" class="conrep">
<div class="repscn">
	<div class="w40per">
		<input type="date" class="inn padd6" name="fi" id="q1" >		
	</div>	
	<div class="w40per mleftmini">
		<input type="date" class="inn padd6" name="ff" id="q2" >		
	</div>	
	<div class="w20per mleftmini">
		<div id="buscar" class="nputrep innmarg10" onclick="sventasfecha('<?php echo $idr;?>');">Consultar</div>
	</div>	
</div>
<div class="resultrep" id="resultrep"></div>
</div>

			</div>
</div>