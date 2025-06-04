<?php
    require_once ("../cn/connect2.php");  
    $pid=$_POST["pid"];  
    $count_query= $db2->prepare("SELECT count(*) AS nrow FROM rooms WHERE id_piso=:pid");
    $count_query->bindParam(':pid', $pid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $nrow = $row['nrow'];}
    $query=$db2->prepare("SELECT * FROM rooms WHERE id_piso=:pid");
    $query->bindParam(':pid', $pid);
    $query->execute();
       if ($nrow>0){  
for($i=0; $row = $query->fetch(); $i++){   
  $rid= $row['id_room']; 
  $nor= $row['nombre_room'];     ?>
    <div class="detalled bgroom poin" onclick="set_room('<?php echo $rid; ?>', '<?php echo $nor; ?>', '<?php echo $pid; ?>')"> 
        <div class="subsed" > Habitación:<br><?php echo $nor; ?></div>
    </div>
<?php   }   }    ?>