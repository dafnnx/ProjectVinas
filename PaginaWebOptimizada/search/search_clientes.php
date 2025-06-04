<?php
	require_once ("../cn/connect2.php");	
	$ncliente =$_POST['ncliente'];
	if(isset($ncliente)){
		 $aColumns = array('nombre_cliente');
		 $sTable = "clientes";
		 $sWhere = "";
		if ( $_POST['ncliente'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$ncliente."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by nombre_cliente";
		include 'pagination.php';
		$page = (isset($_POST['page']) && !empty($_POST['page']))?$_POST['page']:1;
		$per_page = 10;
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = './clientes.php';
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere LIMIT $offset,$per_page");
		$query->execute();
		//loop through fetched data
		if ($numrows>0){
		$nums=1;				
			?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center'>Id</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center'></th>			
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_cliente=$row['id_cliente'];
						$nombre=$row['nombre_cliente'];	
					?>
					<tr>
						<td><?php echo $id_cliente; ?></td>	
						<td><?php echo $nombre; ?></td>
						<td>
<a class='sele' title='Seleccionar' onclick="slectcliente('<?php echo $id_cliente; ?>', '<?php echo $nombre; ?>')"></a>
					</td>				
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
				<div class='row text-center'>
					<div ><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></div>
				</div>	
<?php	}	}  ?>
