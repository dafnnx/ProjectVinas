<?php
	require_once ("../cn/connect2.php"); 	
	$nd = date('Y-m-d');
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	
	// Función para calcular días entre fechas
	function calcularDiasRestantes($fechaFin) {
		$hoy = new DateTime();
		$fechaVencimiento = new DateTime($fechaFin);
		$diferencia = $hoy->diff($fechaVencimiento);
		
		if ($fechaVencimiento < $hoy) {
			// Fecha ya pasó - negativo
			return -$diferencia->days;
		} else {
			// Fecha futura - positivo
			return $diferencia->days;
		}
	}
	
	if($action == 'ajax'){
		$q = $_POST['q'];
		$sta = "1";
		$aColumns = array('nombre_personal');
		$sTable = "personal";
		$sWhere = "WHERE status_personal='".$sta."'";
		
		if ( $_POST['q'] != "" ) {
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ") AND status_personal='".$sta."'";
		}
		$sWhere.=" order by nombre_personal";
		
		$count_query = $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
			$numrows = $row['numrows'];
		}
		
		$query = $db2->prepare("SELECT * FROM $sTable $sWhere");
		$query->execute();
		
		if ($numrows>0){ ?>
			<style>
			.status-indicator {
				display: inline-flex;
				align-items: center;
				padding: 5px 10px;
				border-radius: 15px;
				font-size: 12px;
				font-weight: bold;
				margin: 2px 0;
			}
			
			.status-vencido {
				background-color: #ffebee;
				color: #c62828;
				border: 1px solid #ef5350;
			}
			
			.status-indefinido {
				background-color: #fffbf0;
				color: #f57c00;
				border: 1px solid #ffb74d;
			}
			
			.status-vigente {
				background-color: #e8f5e8;
				color: #2e7d32;
				border: 1px solid #66bb6a;
			}
			
			.status-proximo {
				background-color: #fff3e0;
				color: #ef6c00;
				border: 1px solid #ffab40;
			}
			
			.status-light {
				width: 12px;
				height: 12px;
				border-radius: 50%;
				display: inline-block;
				margin-right: 8px;
				animation: pulse 2s infinite;
			}
			
			.light-red { background-color: #f44336; }
			.light-yellow { background-color: #ffeb3b; }
			.light-green { background-color: #4caf50; }
			.light-orange { background-color: #ff9800; }
			
			@keyframes pulse {
				0% { opacity: 1; }
				50% { opacity: 0.5; }
				100% { opacity: 1; }
			}
			
			.contract-details {
				font-size: 11px;
				margin-top: 3px;
				color: #666;
			}
			</style>
			
			<div class="">
				<table class="table" data-responsive="table" id="resultTable">
					<thead>
						<tr>
							<th class='text-center w90'>*</th>
							<th class='text-center'>Id</th> 
							<th class='text-center'>Nombre</th>					         			
							<th class='text-center'>Email</th>
							<th class='text-center'>Estado del Contrato</th>
							<th class='text-center'>Usuario</th>         						
						</tr>
					</thead>
					<?php
					for($i=0; $row = $query->fetch(); $i++){
						$id = $row['id_personal'];
						$nombre = $row['nombre_personal'];
						$email = $row['mail_personal'];
						$username = $row['username_personal'];
						$edad = $row['edad_personal'];
						?>
						<tr>
							<td>
								<a href="#" class='del' title='Eliminar' onclick="eliminarse('<?php echo $id; ?>', 'personal', 'id_personal', '<?php echo $uid; ?>')"></a>
								<div href="#" class='stat' title='Status' onclick="mdlsta(modstatus, 'statusclose', '<?php echo $id; ?>', '<?php echo $nombre; ?>')"></div>
								<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id; ?>')"></a>
							</td>
							<td><?php echo $id; ?></td>
							<td><?php echo $nombre; ?></td>             			
							<td><?php echo $email; ?></td> 
							<td>
								<?php            			
								$uery = $db2->prepare("SELECT * FROM contratos WHERE id_contrato=(SELECT MAX(id_contrato) AS idcc FROM contratos WHERE id_residente=$id)");
								$uery->execute();
								$contratoEncontrado = false;
								
								for($j=0; $rowContrato = $uery->fetch(); $j++){
									$contratoEncontrado = true;
									$fin = $rowContrato['fin_contrato']; 
									$inicio = $rowContrato['inicio_contrato'];
									
									if (!$fin || $fin == '' || $fin == '0000-00-00') { 
										// CONTRATO INDEFINIDO - AMARILLO
										?>
										<div class="status-indicator status-indefinido">
											<span class="status-light light-yellow"></span>
											INDEFINIDO
										</div>
										<div class="contract-details">
											No se definió fecha de fin del contrato
										</div>
										<?php 
									} else {
										$diasRestantes = calcularDiasRestantes($fin);
										
										if ($diasRestantes < 0) { 
											// CONTRATO VENCIDO - ROJO
											$diasVencidos = abs($diasRestantes);
											?>
											<div class="status-indicator status-vencido">
												<span class="status-light light-red"></span>
												VENCIDO
											</div>
											<div class="contract-details">
												Se venció hace <?php echo $diasVencidos; ?> día<?php echo ($diasVencidos != 1) ? 's' : ''; ?> (<?php echo date('d/m/Y', strtotime($fin)); ?>)
											</div>
											<?php   
										} else if ($diasRestantes <= 7) { 
											// PRÓXIMO A VENCER (7 días o menos) - NARANJA
											?>
											<div class="status-indicator status-proximo">
												<span class="status-light light-orange"></span>
												PRÓXIMO A VENCER
											</div>
											<div class="contract-details">
												<?php if ($diasRestantes == 0) { ?>
													Vence HOY (<?php echo date('d/m/Y', strtotime($fin)); ?>)
												<?php } else { ?>
													Faltan <?php echo $diasRestantes; ?> día<?php echo ($diasRestantes != 1) ? 's' : ''; ?> para vencer (<?php echo date('d/m/Y', strtotime($fin)); ?>)
												<?php } ?>
											</div>
											<?php
										} else { 
											// CONTRATO VIGENTE - VERDE
											?>
											<div class="status-indicator status-vigente">
												<span class="status-light light-green"></span>
												VIGENTE
											</div>
											<div class="contract-details">
												Vence en <?php echo $diasRestantes; ?> días (<?php echo date('d/m/Y', strtotime($fin)); ?>)
											</div>
											<?php 
										} 
									}
								}
								
								if (!$contratoEncontrado) {
									// NO HAY CONTRATO
									?>
									<div class="status-indicator status-vencido">
										<span class="status-light light-red"></span>
										SIN CONTRATO
									</div>
									<div class="contract-details">
										No se encontró contrato registrado
									</div>
									<?php
								}
								?>     
							</td>
							<td><?php echo $username; ?></td>             						
						</tr>
					<?php } ?>
				</table>
			</div>
		<?php } 
	} 
	include ("modal_statusper.php"); 
?>

<script type="text/javascript">
	function mdlsta(msta, mclo, id, nr){
		var span = document.getElementById(mclo);
		msta.style.display = "block";
		$('#nm_sta').val(nr);
		$('#idp_status').val(id);
		
		$.ajax({
			async: true,
			type: "POST",
			url:'./ajax/status_perchk.php',
			data: {id:id},
			beforeSend: function(objeto){
				$('#stapersta').html(loadershowmini);
			},
			success:function(data2){
				$("#stapersta").html(data2).fadeIn('slow');   
			}
		})
		
		span.onclick = function() {
			msta.style.display = "none";
			show('personal', '<?php echo $uid; ?>');
		}	
	}
</script>