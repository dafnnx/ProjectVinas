<?php
	require_once ("../cn/connect2.php"); 	
	$nd= date('Y-m-d');
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
          $sta= "1";
		 $aColumns = array('nombre_personal');
		 $sTable = "personal";
		 $sWhere = "WHERE status_personal='".$sta."'";
		if ( $_POST['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ") AND status_personal='".$sta."'";
		}
		$sWhere.=" order by nombre_personal";
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
					<th class='text-center'>Id</th> 
					<th class='text-center'>Nombre</th>					         			
          			<th class='text-center'>Email</th>
          			<th class='text-center'>Contrato</th>
          			<th class='text-center'>Usuario</th>         						
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id= $row['id_personal'];
          				$nombre= $row['nombre_personal'];
          				$email= $row['mail_personal'];
          				$username= $row['username_personal'];
          				$edad= $row['edad_personal'];		
					?>
					<tr>
						<td><a href="#" class='del' title='Eliminar' onclick="eliminarse('<?php echo $id; ?>', 'personal', 'id_personal', '<?php echo $uid; ?>')"></a>
								<div href="#" class='stat' title='Status' onclick="mdlsta(modstatus, 'statusclose', '<?php echo $id; ?>', '<?php echo $nombre; ?>')"></div>
								<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id; ?>')"></a>
						</td>
						<td><?php echo $id; ?></td>
						<td><?php echo $nombre; ?></td> 						             			
            			<td><?php echo $email; ?></td> 
<?php            			
		$uery=$db2->prepare("SELECT * FROM contratos WHERE id_contrato=(SELECT MAX(id_contrato) AS idcc FROM contratos WHERE id_residente=$id)");
		$uery->execute();
		for($i=0; $row = $uery->fetch(); $i++){
			$fin= $row['fin_contrato']; 
if (!$fin)  { ?>
  <td>INDEFINIDO</td> 
<?php }  else {
  if ($nd<$fin) { ?>
    <td>VIGENTE</td> 
<?php   } else { ?>
    <td>VENCIDO</td>  
 <?php   } } }?>     
            			<td><?php echo $username; ?></td>             						
					</tr>
					<?php	}	?>
			  </table>
			</div>
<?php	} } include ("modal_statusper.php"); 	?>

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
}	}
</script>