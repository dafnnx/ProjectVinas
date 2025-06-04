<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center'>Fecha</th>	
					<th class='text-center'>Cant.</th>	
					<th class='text-center'>F. pago</th>			
					<th class='text-center'>Concepto</th>	
					<th class='text-center'>Persona</th>					
					<th class='text-center'>Debe</th>
					<th class='text-center'>Aporta</th>					
					<th class='text-center'>Saldo</th>				
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_venta=$row['sale_id'];
						$fecha=$row['fecha_pay'];
						$concepto=$row['concept_pay'];
						$persona=$row['persona_pay'];
						$qty=$row['cantidad_pay'];	
						$fpago= $row['fpago_pay'];
						$debe=$row['debe_pay'];
						$aporta=$row['aporta_pay'];
					/*	$iva=$row['iva_pay'];	
						if ($iva) {	$debeiva=$debe+$iva;	}
						else {	$debeiva=$debe;	}		
					*/
						$debeiva=$debe;
						$separar = (explode("T",$fecha));		
						$fec = $separar[0];							
					?>
					<tr>
						<td><?php echo $fec; ?></td>
						<td><?php echo $qty; ?></td>
						<td><?php echo $fpago; ?></td>
						<td><?php echo $concepto; ?></td>	
						<td><?php echo $persona; ?></td>						
						<td><?php if ($debe) { ?> $<?php echo number_format($debe, 2); ?> <?php } else {	} ?></td>
						<td><?php if ($aporta) { ?> $<?php echo number_format($aporta, 2); ?> <?php } else {	} ?></td>								
						<td>$ <?php
    $_qery= $db2->prepare("SELECT SUM(debe_pay) AS deb,  SUM(iva_pay) AS iv FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND fecha_pay<=:fecha AND status=2 ORDER BY fecha_pay ASC");
    $_qery->bindParam(':idr', $idr);
    $_qery->bindParam(':fin', $q1);
	  $_qery->bindParam(':ffi', $q2);
	  $_qery->bindParam(':fecha', $fecha);
    $_qery->execute();
    for($i=0; $row = $_qery->fetch(); $i++){ 
      $iv = $row['iv']; 
      $deb = $row['deb']; 
      if ($iv) {  $debiv= $deb+$iv;  }
      else {  $debiv=$deb; }
      }

    $_query= $db2->prepare("SELECT SUM(aporta_pay) AS apo FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND fecha_pay<=:fecha AND status=2 ORDER BY fecha_pay ASC");
    $_query->bindParam(':idr', $idr);
    $_query->bindParam(':fin', $q1);
	  $_query->bindParam(':ffi', $q2);
	  $_query->bindParam(':fecha', $fecha);
    $_query->execute();
    for($i=0; $row = $_query->fetch(); $i++){  $apo = $row['apo'];  }
    	$resapo= $apo-$debiv;
      echo number_format($resapo, 2);  ?>   
          			  </td> 	
					</tr>
<?php	}

 if ($_query) {    	require_once ("../saves/save_repo.php");    };

$gas=$apo-$debiv;
$totl=$apo+$gas;
					 ?>
			  </table>
 <div class="resdiv">
			  <div class="represult">
			  		<div class="resultmod">
			  			<div class="resultline">Saldo:</div>
			  			<div class="resultline">$<?php echo number_format($gas, 2);?></div>
			  		</div>
			  		<div class="resultmod">
			  			<div class="resultline">Reposición de depósito:</div>
			  			<div class="resultline"><input id="reps" class="nputs w100per bordergray"></div>
			  		</div>
			  		<div class="resultmod">
			  			<div class="resultline totsave" onclick="oper('<?php echo $gas;?>', <?php echo $idr;?>)">Total a pagar:</div>
			  			<div class="resultline"><input class="nputs w100per bordergray" id="resoper" readonly></div>
			  		</div>
			  </div>
 </div>
<a href="reportes/reporte_conceptos.php?q1=<?php echo $q1;?>&q2=<?php echo $q2;?>&idr=<?php echo $idr;?>"  target="_blank"><div class="nputsave">Generar</div></a>
</div>			


<script type="text/javascript">
		function oper(gas, idr) {
			gast= parseInt(gas);
			rept= parseInt($('#reps').val());
		
			tresu= gast-rept;
					if (tresu < 0) {  tresu = tresu * -1;	}
				$('#resoper').val(tresu);
	uprepo(rept, tresu, idr);
}  


function uprepo(rept, tresu, idr){
    $.ajax({
         type: "POST",
         url: "./saves/update_repo.php",
         data: {rept:rept, tresu:tresu, idr:idr},
            success:function(){      
            }
   })  
    event.preventDefault();
}
</script>