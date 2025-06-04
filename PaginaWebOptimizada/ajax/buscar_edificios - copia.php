<div class="info gral">
<?php
 $eds =$_POST['eds'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT nombre_edificio AS nomedf FROM edificios WHERE id_edificio=:eds");
    $count_query->bindParam(':eds', $eds);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $nomedf = $row['nomedf'];     } 

	$coun= $db2->prepare("SELECT id_piso AS idpis FROM pisos WHERE id_edificio=:eds");
    $coun->bindParam(':eds', $eds);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){    $idpis = $row['idpis'];	?>
    	<div class="detalled bgedif poin" onclick="see_rooms('<?php echo $idpis; ?>')"></div>
 <?php   	}	?> 
    
 </div>

        


 
<!--

<div class="detalled bgedif poin" onclick="set_edif('<?php echo $idpis; ?>')">     </div>




	$count= $db2->prepare("SELECT SUBSTRING_INDEX('www.mytestpage.info','.',1) AS str");
    $count->execute();
    for($i=0; $row = $count->fetch(); $i++){    $str = $row['str'];  
    echo   $str; } 




 $query= $db2->prepare("SELECT cama_residente AS camres FROM residentes");
    $query->bindParam(':eds', $eds);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){	 $camres= $row['camres']; 

        $camres=explode("-",$camres); 
echo $camres[1];
         	}

    !-->