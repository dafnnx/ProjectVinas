<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['super_fecha'];
	if(isset($_POST["hours"]))
		{	$ba=implode(",",$_POST["hours"]);  }
		if (isset($_POST["super_ids"])) 
		{	$xa=explode(",",$_POST["super_ids"]);	}
			
if ($xa) { ?>
	<table class="table" data-responsive="table" id="resultTable">
			  	
  <thead>
      <th colspan="2" scope="rowgroup">Nombre</th>
      <th colspan="2" scope="rowgroup">Medicamento</th>
      <th colspan="2" scope="rowgroup">Toma</th>
      <th colspan="2" scope="rowgroup">Dosis</th>
      <th colspan="2" scope="rowgroup">Unidad</th>
      <th colspan="2" scope="rowgroup">Administrado</th>
      <th colspan="2" scope="rowgroup">Observaciones</th>
  </thead>
  <tbody>
<?php
		$count_query= $db2->prepare("SELECT * FROM residentes WHERE id_residente IN ('".implode("','", $xa)."')");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$nomresi = $row['nombre_residente'];		?>  
    <tr>
      <td onclick="trat_disp();"><?php echo $nomresi; ?>      	
      	<div class="rtratlist" id="rtratlist"></div>
      </td>
    </tr>
<?php  }		?>
</tbody>
</table>

 <?php  }		?>