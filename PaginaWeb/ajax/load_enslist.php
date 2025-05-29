<?php	
$rid =$_POST['rid']; 
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
		 $aColumns = array('marca_ropa', 'nombre_ropa', 'talla_ropa', 'ingreso_ropa');
		 $sTable = "ropa_residente";		 
		 $sWhere = "";
		if ($q)	{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ")";
			$sWhere.= "AND id_residente='$rid' AND status_ropa='activo'";
			$sWhere.=" ORDER BY nombre_ropa ASC";
		} else {	
			$sWhere.= "WHERE id_residente='$rid' AND status_ropa='activo'";
			$sWhere.=" ORDER BY nombre_ropa ASC";					}		
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere ");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere LIMIT 250");
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
				<input type="hidden" value="<?php echo $rid; ?>" id="tgtrid">
				
				<!-- Barra de acciones para enseres seleccionados -->
				<div class="actions-bar" style="margin-bottom: 15px; padding: 10px; background-color: #f5f5f5; border-radius: 5px;">
					<div style="display: flex; align-items: center; gap: 10px;">
						<label style="font-weight: bold;">Acciones para seleccionados:</label>
								<div class="subpren10 mr1per">
								<input type="button" class="nputsave" value="Status" onclick="statusSelectedEnseres()" title="Cambiar status de enseres seleccionados">
								</div>

								<div class="subpren10 mr1per">
								<input type="button" class="nputsave" value="Selec. Todos" onclick="selectAllEnseres()" title="Seleccionar todos">
								</div>

								<div class="subpren10">
								<input type="button" class="nputsave" value="Deselec. Todos" onclick="unselectAllEnseres()" title="Deseleccionar todos">
								</div>
						<span id="selected-count" style="margin-left: 10px; font-weight: bold; color: #007bff;">
							Seleccionados: 0
						</span>
					</div>
				</div>
				
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>		
					<th class='text-center'>
						<input type="checkbox" id="select-all-header" onchange="toggleAllCheckboxes(this)">
						<label for="select-all-header">Sel</label>
					</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Talla</th>
					<th class='text-center'>Marca</th>
					<th class='text-center'>Color</th>
					<th class='text-center'>Observa</th>
					<th class='text-center'>Fecha</th>
					<th class='text-center'>Condición</th>					
					<th class='text-center'>*</th>							
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idr=$row['id_rresidente'];
						$ida=$row['id_armario'];
						$apo=$row['apodo_residente'];
						$nr=$row['nombre_ropa'];
						$tr=$row['talla_ropa'];
						$mr=$row['marca_ropa'];	
						$or=$row['observa_ropa'];
						$ir=$row['ingreso_ropa'];
						$cr=$row['color_ropa'];	
						$er=$row['estado_ropa'];
						$star=$row['status_ropa'];							?>	
					<tr>
					<td>
						<input type="checkbox" class="thecheckgralt" value="<?php echo $idr; ?>" id="boxgral-<?php echo $idr; ?>" onchange="updateSelectedCount()">
					  <label for="boxgral-<?php echo $idr; ?>" class="mleft5"></label>
					</td>
<?php  if (!$nr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><?php echo $nr; ?></td><?php   }	?>
<?php  if (!$tr) {	?>	<td>N/A</td>    <?php } else { ?>	<td><?php echo $tr; ?></td><?php   }	?>
<?php  if (!$mr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><?php echo $mr; ?></td><?php   }	?>
<?php  if (!$cr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><input type="color" name="ense3" disabled value="<?php echo $cr; ?>" title="Color"></td><?php   }	?>
															<td title="<?php echo $or; ?>"><?php echo $or; ?></td>	
															<td ><?php	 $fecha = new DateTime($ir);  $cadfe = $fecha->format("d-M-Y");  echo $cadfe;?>	</td>
<?php  if (!$er) {	?>	<td>N/A</td>	<?php } else { 	?>	<td><?php echo $er; ?></td><?php   }	?>	
					<td ><!-- class="w60" -->
						
					  <a class='del' title='Eliminar' onclick="eliminar_ens('<?php echo $idr; ?>', 'ropa_residente', 'id_rresidente', '<?php echo $rid; ?>')"></a>	
					<!--	<a class='delstasingle' title='Status' onclick="mdlsing(modensstasingle, 'ensstaclosesingle', '<?php echo $idr; ?>', '<?php echo $rid; ?>')"></a> -->
					</td>									
					</tr>
					<?php   }	?>
			  </table>
			</div>
			
			<!-- Modal para cambio de status -->
			<div id="statusModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
				<div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: none; width: 80%; max-width: 500px; border-radius: 10px;">
					<span class="close" onclick="hideStatusModal()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
					<div id="status_modal_body">
						<!-- Contenido del modal se carga aquí -->
					</div>
				</div>
			</div>
			
<?php	} else {		echo "Sin enseres Activos";   	} }	 

/* include ("modal_single_enstatus.php"); */ ?>

<script type="text/javascript">
// Función para contar y mostrar enseres seleccionados
function updateSelectedCount() {
    var selectedCount = $('.thecheckgralt:checked').length;
    $('#selected-count').text('Seleccionados: ' + selectedCount);
    
    // Actualizar checkbox del header
    var totalCheckboxes = $('.thecheckgralt').length;
    var headerCheckbox = $('#select-all-header');
    
    if (selectedCount === 0) {
        headerCheckbox.prop('indeterminate', false);
        headerCheckbox.prop('checked', false);
    } else if (selectedCount === totalCheckboxes) {
        headerCheckbox.prop('indeterminate', false);
        headerCheckbox.prop('checked', true);
    } else {
        headerCheckbox.prop('indeterminate', true);
    }
}

// Función para el checkbox del header
function toggleAllCheckboxes(headerCheckbox) {
    $('.thecheckgralt').prop('checked', headerCheckbox.checked);
    updateSelectedCount();
}

// Funciones para seleccionar/deseleccionar todos
function selectAllEnseres() {
    $('.thecheckgralt').prop('checked', true);
    updateSelectedCount();
}

function unselectAllEnseres() {
    $('.thecheckgralt').prop('checked', false);
    updateSelectedCount();
}

// Función para mostrar modal
function showStatusModal() {
    $('#statusModal').show();
}

// Función para ocultar modal
function hideStatusModal() {
    $('#statusModal').hide();
}

// Inicializar contador al cargar
$(document).ready(function() {
    updateSelectedCount();
});

/*
  function mdlsing(msta, mclo, idr, rid){
var span = document.getElementById(mclo);
msta.style.display = "block";
span.onclick = function() {
  msta.style.display = "none";
}
    $('#stabodysingle').load("./ajax/sta_body_single.php", {idr:idr, rid:rid});
} */
</script> 
<script type="text/javascript" src="./js/checkbox.js"></script>
<script type="text/javascript" src="./js/checkens.js"></script>
<script type="text/javascript" src="./js/enslist.js"></script>