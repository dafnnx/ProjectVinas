<?php
	require_once ("../cn/connect2.php");	
         $nproducto =$_POST['nproducto'];
         $uid =$_POST['uid'];
if(isset($nproducto)){
		 $aColumns = array('barras_medica', 'nombre_medica');
		 $sTable = "medicamentos";
		 $sWhere = "";
		if ( $nproducto != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$nproducto."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by nombre_medica";
		include 'pagination.php';
		$page = (isset($_POST['page']) && !empty($_POST['page']))?$_POST['page']:1;
		$per_page = 30;
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = './medicamentos.php';
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere LIMIT $offset,$per_page");
		$query->execute();
		//loop through fetched data
		if ($numrows>0){ ?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center'>C. barras</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Cantidad Ind</th>
					<th class='text-center'>Stock</th>
					<th class='text-center'>*</th>			
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_id_medica'];
						$barras=$row['barras_medica'];
						$nombre=$row['nombre_medica'];
						$qty=$row['qtyind_medica'];
						$stock=$row['stock_medica'];	
					?>	

					<tr>
						<td><?php echo $barras; ?></td>	
						<td><?php echo $nombre; ?></td>
						<td style="text-align: center;"><?php echo $qty; ?></td>
						<td style="text-align: center;"><?php echo $stock; ?></td>
						<td><div class="addp" title="Agregar" onclick="addprods('<?php echo $id; ?>', '<?php echo $uid; ?>')"></div>
						</td>			
					</tr>					
					<?php }	?>
 			 </table>
			</div>
<?php	}	 }  ?>