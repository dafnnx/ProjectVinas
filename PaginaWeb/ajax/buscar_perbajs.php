<?php	
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
         $sta= "2";
		 $aColumns = array('nombre_personal', 'id_personal');
		 $sTable = "personal";
		 $sWhere = "WHERE status_personal='".$sta."'";
		if ( $q != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ") AND status_personal='".$sta."'";
		}
		$sWhere.="ORDER BY status_personal";
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
					<th class='text-center pad'>Código</th>
					<th class='text-center'>Curp</th>
					<th class='text-center'>Status</th>								
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_personal'];
						$nr=$row['nombre_personal'];
						$cr=$row['curp_personal'];
						$sr=$row['status_personal'];
						switch ($sr) {  case '1':    $nombre= "Activo";    break;  
                    case '2':    $nombre= "Baja";    break;	} ?>	
					<tr>
						<td><a href="#" class='del' title='Eliminar' onclick="eliminarse('<?php echo $id; ?>', 'personal', 'id_personal', '<?php echo $uid; ?>')"></a>						
							<div href="#" class='stat' title='Status' onclick="mdlsta(modstatus, 'statusclose', '<?php echo $id; ?>', '<?php echo $nr; ?>')"></div>
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id; ?>', '<?php echo $uid; ?>')"></a>
						</td>
						<td><?php echo $nr; ?></td>
						<td><?php echo $id; ?></td>	
						<td><?php echo $cr; ?></td>	
						<td><?php echo $nombre; ?></td>											
					</tr>
					<?php   }	?>
			  </table>
			</div>
<?php	} }	
 include ("modal_statusperbajs.php"); ?>
 
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
}	}
</script>