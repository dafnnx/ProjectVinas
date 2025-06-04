<?php
	require_once ("../cn/connect2.php");	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
		 $aColumns = array('sale_id');
		 $sTable = "sales";
		 $sWhere = "";
		if ( $_POST['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by sale_id";
		include 'pagination.php';
		$page = (isset($_POST['page']) && !empty($_POST['page']))?$_POST['page']:1;
		$per_page = 25;
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = './sales.php';
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere LIMIT $offset,$per_page");
		$query->execute();
		//loop through fetched data
		if ($numrows>0){
		$nums=1; ?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center'>Ticket</th>
					<th class='text-center'>Total</th>
					<th class='text-center'>Status</th>
					<th class='text-center'>Acciones</th>			
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_ticket=$row['sale_id'];
						$total=$row['amount'];
						$status=$row['status'];				
					?>
					<tr>
						<td><?php echo $id_ticket; ?></td>	
						<td>$ <?php echo number_format($total, 2); ?></td>
<?php switch ($status) {
    case 2:   ?> 
    <td>Cerrada</td>
    <td>
<a class='del' title='Cancelar' onclick="eliminartick('<?php echo $id_ticket; ?>')"></a>
	</td>	
      <?php  break;
    case 3: ?> 
    <td>Cancelada</td>
    <td></td>	
      <?php  break; } ?>
 									
					</tr>
					<?php	
					if ($nums%4==0){
						echo "<div class='clearfix'></div>";
					}
					$nums++;
				}	?>
			  </table>
			</div>
			<div class="clearfix"></div>
<?php	}	}  ?>