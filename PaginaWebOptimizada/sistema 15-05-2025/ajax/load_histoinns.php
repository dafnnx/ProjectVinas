<div class="info gral">
<?php
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM historial_inventarios WHERE id_residente=:id AND opt_historial=1");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM historial_inventarios WHERE id_residente=:id AND opt_historial=1 ORDER BY fecha_historial DESC");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  
        for($i=0; $row = $query->fetch(); $i++){
          $nombre= $row['nombre_medica'];
          $qty= $row['cantidad_medica'];
          $fecha= $row['fecha_historial']; 
          $opt= $row['opt_historial'];  
          $tot= $row['total_medica'];  
$fnmed = new DateTime($fecha);
$fmed = $fnmed->format("d-M-Y H:i");     
switch ($opt) {
  case '1':
    $action="Se ingresaron";
    break;
  case '2':
  $action="Se eliminaron";
    break;
  case '3':
  $action="Se aplicaron";
    break;
}     ?>
<div class="enlisted">   
<?php echo $action; ?> <strong> <?php echo $qty; ?></strong>  de <strong><?php echo $nombre; ?></strong> el día <strong><?php echo $fmed; ?></strong> Total: <strong><?php echo $tot; ?></strong></div>
          <?php }      }   else {  echo "Sin movimientos";   }  ?>
</div>