<?php
	require_once ("../cn/connect2.php");	
	     $cat =$_POST['cat'];
         $uid =$_POST['uid'];
         $cid =$_POST['cid'];
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM productos WHERE categoria_producto=:id_c");
		$count_query->bindParam(':id_c', $cat);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows']; }
		$query=$db2->prepare("SELECT * FROM productos WHERE categoria_producto=:id_c");
		$query->bindParam(':id_c', $cat);
		$query->execute();
		//loop through fetched data
		if ($numrows>0){
		$nums=1; ?>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_producto'];
						$barras=$row['barras_producto'];
						$nombre=$row['nombre_producto'];
						$marca=$row['marca_producto'];	
						$precio=$row['venta_producto'];		
						$img=$row['img_producto'];	
						if ($img=="") {	$img="no.png";	}	
						$iva=$row['iva_producto'];
	$mode= $db2->prepare("SELECT valor_modo FROM mode WHERE id_modo=1");
	$mode->execute();
	for($i=0; $row = $mode->fetch(); $i++){	$modo = $row['valor_modo']; }
	if ($modo==1) {		
					?>					
	<div class="detalles" style="background-image: url(./prods_imgs/<?php echo $img; ?>);" onclick="addprods('<?php echo $id; ?>', '<?php echo $uid; ?>', '<?php echo $cid; ?>', '<?php echo $iva; ?>')">
	<div class="subs"><?php echo $nombre; ?></div>
	<div class="subs">$<?php echo $precio; ?></div>
				</div>	
				<?php } else { ?>
				<div class="detalles2" onclick="addprods('<?php echo $id; ?>', '<?php echo $uid; ?>', '<?php echo $cid; ?>', '<?php echo $iva; ?>')">
				 	<div class="subs2"><?php echo $barras; ?> --- <?php echo $nombre; ?> --- $<?php echo $precio; ?></div>
				</div>	
					<?php }	} }  ?>