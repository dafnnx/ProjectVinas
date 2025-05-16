<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['super_fecha'];
	if(isset($_POST["hours"]))
		{	$ba=implode(",",$_POST["hours"]);  }
		if (isset($_POST["super_ids"])) 
		{	$xa=explode(",",$_POST["super_ids"]);	}
if ($xa) { ?>
<div class="trspecsa">
	<?php	$count_query= $db2->prepare("SELECT * FROM residentes WHERE id_residente IN ('".implode("','", $xa)."')");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
			$idr = $row['id_residente'];
			$nomresi = $row['nombre_residente'];		?>  
			
<table class="table" data-responsive="table">
    <tr>
    <div class="cpoint tratribbon" onclick="trat_disp('<?php echo $idr; ?>', '<?php echo $aa; ?>')"><?php echo $nomresi; ?></div>    	
      	 <div class="rtratlist" id="rtratlist-<?php echo $idr; ?>">
      		<div id="rtrat_desglo-<?php echo $idr; ?>"></div>      			     		
      	</div>
    </tr>
</table>

<?php  	}	?>

</div>
<?php 	} 	?>
<div class="trspecsb">
	<div class="rtratspecs" id="rtratspecs"></div> 
</div>