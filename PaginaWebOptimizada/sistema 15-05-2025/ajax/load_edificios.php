<?php
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM edificios ORDER BY id_edificio");
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM edificios ORDER BY id_edificio");
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
        <?php
for($i=0; $row = $query->fetch(); $i++){    
  $nom= $row['nombre_edificio'];
  $eid= $row['id_edificio'];      ?>
    <div class="detalled bgedif poin" onclick="set_edif('<?php echo $eid; ?>', '<?php echo $nom; ?>')"> 
        <div class="subsed" > Edificio:<br><?php echo $nom; ?></div>
    </div>
<?php   }   } ?>