 <div class="sdboard"> 	
<?php
 	$eds =$_POST['eds'];
 	$nomedifs =$_POST['nomed'];
    require_once ("../cn/connect2.php");
	$coun= $db2->prepare("SELECT * FROM pisos WHERE id_edificio=:eds");
    $coun->bindParam(':eds', $eds);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){ 
       $idpis = $row['id_piso'];	
       $nompis = $row['nombre_piso']; 	  ?> 
<div class="mosai" onclick="set_edif('<?php echo $eds; ?>', '<?php echo $nomedifs; ?>', '<?php echo $idpis; ?>', '<?php echo $nompis; ?>')"><?php echo $row['nombre_piso']; ?></div>
 <?php  }  ?> 
 </div>
<div class="diapboard" id="mdboard"></div>