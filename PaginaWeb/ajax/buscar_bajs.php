<?php	
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
         $sta= "2";
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
					<th class='text-center'>Status</th>								
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_residente'];
						$nr=$row['nombre_residente'];
						$cr=$row['curp_residente'];
						$sr=$row['status_residente'];	 ?>	
					<tr>
						<td><a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'residentes', 'id_residente', '<?php echo $uid; ?>')"></a>						
							<div href="#" class='stat' title='Status' onclick="mdlsta(modstatus, 'statusclose', '<?php echo $id; ?>', '<?php echo $nr; ?>')"></div>
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id; ?>', '<?php echo $uid; ?>')"></a>
						</td>
						<td><?php echo $nr; ?></td>
						<td><?php echo $id; ?></td>	
						<td><?php echo $cr; ?></td>	
		<?php 
$que=$db2->prepare("SELECT nombre_statu AS nomsta FROM status WHERE id_statu=(SELECT status_status AS sta_sta FROM hist_status WHERE id_status=(SELECT MAX(id_status) AS ids FROM hist_status WHERE id_residente=:id ORDER BY id_status DESC LIMIT 1))");
$que->bindParam(':id', $id);
$que->execute();	
	for($i=0; $row = $que->fetch(); $i++){		$nomsta= $row['nomsta'];  	?>		
	<td><?php echo $nomsta; ?></td>	
	<?php } ?>												
					</tr>
					<?php   }	?>
			  </table>
			</div>
<?php	} }	
 include ("modal_status.php"); ?>
 
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


$(document).ready(function(){
   $("#ssta").select2({
      ajax: {
        url: "./ajax/ssta.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});
</script>