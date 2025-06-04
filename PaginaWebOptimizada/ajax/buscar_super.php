<?php	require_once ("../cn/connect2.php"); 	 ?>
	<div class="info gral" >
			<div class="gralmain">
<div class="paycnt pad10half" id="super_info">
	<div class="sup_data">
<table class="infotabtr cien">  
  <tr>
    <td class="textleft">Día:</td>
    <td class="textleft">Hora:</td>
    <td class="textleft paddleft10">Residentes</td>
  </tr>
  <tr>
    <td><input class="nputs" type="date" name="super_fecha" ></td>  
    <td>
<select class="nputs mr4px" id="thehour" >  
        <option value="7h" selected>7h</option>     
        <option value="8h">8h</option> 
        <option value="13h">13h</option> 
        <option value="18h">18h</option> 
        <option value="21h" >21h</option>  
</select>
    </td>  
    <td class="marleft10">
		<select class="nputs " name="super_select" onchange="test(this.value);">  
		<option value="" selected>Seleccionar...</option> 

<?php
$v1="Viñas 1";
$v2="Viñas 2";
$pb="Planta Baja";
$pa="Planta Alta";
$cun1= $db2->prepare("SELECT DISTINCT id_residente AS idr FROM residentes WHERE SUBSTRING_INDEX(cama_residente, '-', 1)=:v1 AND SUBSTRING_INDEX(SUBSTRING_INDEX(cama_residente, '-', 2), '-', -1)=:pb");
$cun1->bindParam(':v1', $v1);
$cun1->bindParam(':pb', $pb);
$cun1->execute();
$resultv1pb = $cun1->fetchAll(); 
?>
<option value="<?php foreach ($resultv1pb as $resulttv1pb) { echo $sss=  $resulttv1pb['idr'].","; }	?>">Vinas 1, Planta Baja</option>

<?php
$cun2= $db2->prepare("SELECT DISTINCT id_residente AS idr FROM residentes WHERE SUBSTRING_INDEX(cama_residente, '-', 1)=:v1 AND SUBSTRING_INDEX(SUBSTRING_INDEX(cama_residente, '-', 2), '-', -1)=:pa");
$cun2->bindParam(':v1', $v1);
$cun2->bindParam(':pa', $pa);
$cun2->execute();
$resultv1pa = $cun2->fetchAll(); 
?>
<option value="<?php foreach ($resultv1pa as $resulttv1pa) { echo $sss=  $resulttv1pa['idr'].","; }	?>">Vinas 1, Planta Alta</option>

<?php
$cun3= $db2->prepare("SELECT DISTINCT id_residente AS idr FROM residentes WHERE SUBSTRING_INDEX(cama_residente, '-', 1)=:v2 AND SUBSTRING_INDEX(SUBSTRING_INDEX(cama_residente, '-', 2), '-', -1)=:pb");
$cun3->bindParam(':v2', $v2);
$cun3->bindParam(':pb', $pb);
$cun3->execute();
$resultv2pb = $cun3->fetchAll(); 
?>
<option value="<?php foreach ($resultv2pb as $resultv2pb) { echo $sss=  $resultv2pb['idr'].","; }	?>">Vinas 2, Planta Baja</option>

<?php
$cun4= $db2->prepare("SELECT DISTINCT id_residente AS idr FROM residentes WHERE SUBSTRING_INDEX(cama_residente, '-', 1)=:v2 AND SUBSTRING_INDEX(SUBSTRING_INDEX(cama_residente, '-', 2), '-', -1)=:pa");
$cun4->bindParam(':v2', $v2);
$cun4->bindParam(':pa', $pa);
$cun4->execute();
$resultv2pa = $cun4->fetchAll(); 
?>
<option value="<?php foreach ($resultv2pa as $resultv2pa) { echo $sss=  $resultv2pa['idr'].","; }	?>">Vinas 2, Planta Alta</option>

<?php
$count_query= $db2->prepare("SELECT * FROM residentes ORDER BY nombre_residente");
$count_query->execute();
for($i=0; $row = $count_query->fetch(); $i++){ ?>
<option value="<?php echo $row['id_residente']; ?>"><?php echo $row['id_residente']; ?> - <?php echo $row['nombre_residente']; ?></option>
<?php   } 	?>


        </select>


    </td> 
  </tr>
</table>
	</div>
	<div class="sup_selected" id="sup_selected">
		<textarea class="resilist" name="super_ids" id="res_ids" placeholder="Id residentes seleccionados..."></textarea>
		<div class="super_clean del" onclick="super_clean();"></div>
	</div>
	<div class="sup_btn supsea" onclick="super_search();"></div>
</div>
<table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>	
					<th class='w300'>Residente</th>	
					<th class='w300'>Medicamento</th>
					<th class=''>Unidad</th>						
				</tr>
				</thead>
</table>
<div id="super_list"></div>
			</div>
	</div>