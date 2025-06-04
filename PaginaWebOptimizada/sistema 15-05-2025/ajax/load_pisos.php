<?php
    require_once ("../cn/connect2.php");
    $eid=$_POST["eid"]; 
    $count_query= $db2->prepare("SELECT count(*) AS nrows FROM pisos WHERE id_edificio=:eid");
    $count_query->bindParam(':eid', $eid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $nrows = $row['nrows'];}
    $query=$db2->prepare("SELECT * FROM pisos WHERE id_edificio=:eid");
    $query->bindParam(':eid', $eid);
    $query->execute();
       if ($nrows>0){  
for($i=0; $row = $query->fetch(); $i++){   
  $pid= $row['id_piso']; 
  $nop= $row['nombre_piso'];     ?>
    <div class="detalled bgpiso poin" onclick="set_piso('<?php echo $pid; ?>', '<?php echo $nop; ?>', '<?php echo $eid; ?>')"> 
        <div class="subsed" > Piso:<br><?php echo $nop; ?></div>
    </div>
<?php   } }  ?>