<?php	
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
         $sta= "1";
		 $aColumns = array('nombre_residente', 'apodo_residente');
		 $sTable = "residentes";
		 $sWhere = "WHERE status_residente='".$sta."'";
		if ( $q != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ") AND status_residente='".$sta."'";
		}
		$sWhere.="ORDER BY nombre_residente";
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere");
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>			
					<th class='text-center w90'>*</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center pad'>Alergias</th>				
				</tr>
				</thead>
<tbody class="111">
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_residente'];
						$nr=$row['nombre_residente'];
						$alergia=$row['alergia_residente'];
						
						// Determinar el color del semáforo
						$tiene_alergia = !empty($alergia) && $alergia != null;
						$color_semaforo = $tiene_alergia ? 'red' : 'green';
						$texto_alergia = $tiene_alergia ? $alergia : 'Sin alergias registradas';
					?>	
					<tr>
						<td class="w120">
							<a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'residentes', 'id_residente', '<?php echo $uid; ?>')"></a>						
							<div href="#" class='stat' title='Status' onclick="mdlsta(modstatus, 'statusclose', '<?php echo $id; ?>', '<?php echo $nr; ?>')"></div>
							<div href="#" class='pass' title='Acceso' onclick="mdlpass(modpass, 'passclose', '<?php echo $id; ?>', '<?php echo $nr; ?>')"></div>
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id; ?>', '<?php echo $uid; ?>')"></a>
						</td>
						<td><?php echo $nr; ?></td>
						<td class="text-center">
							<div class="semaforo-alergia <?php echo $color_semaforo; ?>" 
								 onclick="mostrarAlergias('<?php echo addslashes($nr); ?>', '<?php echo addslashes($texto_alergia); ?>')"
								 title="<?php echo $tiene_alergia ? 'Tiene alergias - Click para ver detalles' : 'Sin alergias registradas'; ?>">
								<div class="foco"></div>
							</div>
						</td>													
					</tr>					
					<?php    }	?>
</tbody>
			  </table>
			</div>
<?php	} }			 
include ("modal_status.php");
include ("modal_acces.php"); 			?>

<!-- Modal para mostrar alergias -->
<div id="modalAlergias" class="modal" style="display: none;">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="closeAlergias">&times;</span>
      <h2>Información de Alergias</h2>
    </div>
    <div class="modal-body">
      <h3 id="nombreResidente"></h3>
      <div class="alergia-info">
        <strong>Alergias registradas:</strong>
        <p id="detalleAlergias"></p>
      </div>
    </div>
  </div>
</div>

<style>
/* Estilos para el semáforo de alergias */
.semaforo-alergia {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin: 0 auto;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

.semaforo-alergia:hover {
    transform: scale(1.1);
    box-shadow: 0 3px 8px rgba(0,0,0,0.4);
}

.semaforo-alergia.red {
    background: linear-gradient(145deg, #ff4444, #cc0000);
    border: 2px solid #990000;
}

.semaforo-alergia.green {
    background: linear-gradient(145deg, #44ff44, #00cc00);
    border: 2px solid #009900;
}

.semaforo-alergia .foco {
    width: 15px;
    height: 15px;
    background: rgba(255,255,255,0.8);
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.3);
}

.semaforo-alergia.red .foco {
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.9), rgba(255,200,200,0.7));
}

.semaforo-alergia.green .foco {
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.9), rgba(200,255,200,0.7));
}

/* Estilos para el modal de alergias */
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 0;
    border: none;
    border-radius: 10px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.modal-header {
    background: linear-gradient(135deg,rgb(234, 102, 102) 0%,rgb(162, 95, 75) 100%);
    color: white;
    padding: 20px;
    border-radius: 10px 10px 0 0;
    position: relative;
}

.modal-header h2 {
    margin: 0;
    font-size: 24px;
}

.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 20px;
    top: 15px;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #ddd;
    text-decoration: none;
}

.modal-body {
    padding: 30px;
}

.modal-body h3 {
    color: #333;
    margin-bottom: 20px;
    font-size: 20px;
}

.alergia-info {
    background: #f8f9fa;
    border-left: 4px solidrgb(168, 76, 76);
    padding: 15px;
    border-radius: 5px;
}

.alergia-info strong {
    color: #495057;
    display: block;
    margin-bottom: 10px;
}

.alergia-info p {
    margin: 0;
    color: #6c757d;
    line-height: 1.5;
    font-size: 16px;
}

/* Animación para el semáforo */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.semaforo-alergia.red {
    animation: pulse 2s infinite;
}
</style>

<script type="text/javascript">
// Función para mostrar el modal de alergias
function mostrarAlergias(nombre, alergias) {
    document.getElementById('nombreResidente').textContent = nombre;
    document.getElementById('detalleAlergias').textContent = alergias;
    document.getElementById('modalAlergias').style.display = 'block';
}

// Cerrar modal
document.getElementById('closeAlergias').onclick = function() {
    document.getElementById('modalAlergias').style.display = 'none';
}

// Cerrar modal al hacer click fuera de él
window.onclick = function(event) {
    var modal = document.getElementById('modalAlergias');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Funciones existentes
function mdlsta(msta, mclo, id, nr){
    var span = document.getElementById(mclo);
    msta.style.display = "block";
    $('#nm_sta').val(nr);
    $('#idr_status').val(id);
    $.ajax({
        async: true,
        type: "POST",
        url:'./ajax/status_chk.php',
        data: {id:id},
        beforeSend: function(objeto){
            $('#stasta').html(loadershowmini);
        },
        success:function(data2){
            $("#stasta").html(data2).fadeIn('slow');   
        }
    })
    span.onclick = function() {
        msta.style.display = "none";
    }	
}

function mdlpass(msta, mclo, id, nr){
    var span = document.getElementById(mclo);
    msta.style.display = "block";
    $('[name="nm_pass"]').val(nr);
    $('[name="idr_pass"]').val(id);
    $.ajax({
        async: true,
        type: "POST",
        url:'./ajax/status_chk.php',
        data: {id:id},
        beforeSend: function(objeto){
            $('#stasta').html(loadershowmini);
        },
        success:function(data2){
            $("#stasta").html(data2).fadeIn('slow');   
        }
    })
    span.onclick = function() {
        msta.style.display = "none";
    }	
}
</script>