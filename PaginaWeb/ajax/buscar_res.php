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
					<th class='text-center pad'>Código</th>
					<th class='text-center'>Curp</th>						
				</tr>
				</thead>
<tbody class="111">
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_residente'];
						$nr=$row['nombre_residente'];
						$cr=$row['curp_residente'];	?>	
					<tr>
						<td class="w120"><a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'residentes', 'id_residente', '<?php echo $uid; ?>')"></a>						
							<div href="#" class='stat' title='Status' onclick="mdlsta(modstatus, 'statusclose', '<?php echo $id; ?>', '<?php echo $nr; ?>')"></div>
							<div href="#" class='pass' title='Acceso' onclick="mdlpass(modpass, 'passclose', '<?php echo $id; ?>', '<?php echo $nr; ?>')"></div>
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id; ?>', '<?php echo $uid; ?>')"></a>
						</td>
						<td><?php echo $nr; ?></td>
						<td><?php echo $id; ?></td>	
						<td><?php echo $cr; ?></td>													
					</tr>					
					<?php    }	?>
</tbody>
			  </table>
			</div>
<?php	} }			 
include ("modal_status.php");
include ("modal_acces.php"); 			?>
<script type="text/javascript">
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
}	}


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
}	}

</script>