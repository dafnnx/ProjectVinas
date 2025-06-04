<?php
$idrr= $_POST['idxx'];
    require_once ("../cn/connect2.php");     ?>
  <?php
  $quer2= $db2->prepare("SELECT DISTINCT id_bed, nombre_bed, status_bed, id_residente, nombre_residente FROM beds WHERE id_room=:idrr");
  $quer2->bindParam(':idrr', $idrr);
  $quer2->execute();
  for($i=0; $row = $quer2->fetch(); $i++){
      $idbb = $row['id_bed'];
      $nobe = $row['nombre_bed'];
      $status = $row['status_bed'];
      $id_r = $row['id_residente'];
      $nmeres=$row['nombre_residente'];
       ?>
          <div class="bedlist pointer">
<?php
switch ($status){ case "1":
    $quer3= $db2->prepare("SELECT nombre_room AS nrom, id_piso AS idpp FROM rooms WHERE id_room=:idrr");
    $quer3->bindParam(':idrr', $idrr);
    $quer3->execute();
    for($i=0; $row = $quer3->fetch(); $i++){
    $nrom = $row['nrom'];
    $idpp = $row['idpp'];

      $quer4= $db2->prepare("SELECT nombre_piso AS npis, id_edificio AS ided FROM pisos WHERE id_piso=:idpp");
      $quer4->bindParam(':idpp', $idpp);
      $quer4->execute();
        for($i=0; $row = $quer4->fetch(); $i++){
      $npis = $row['npis'];
      $ided = $row['ided'];

        $quer5= $db2->prepare("SELECT nombre_edificio AS nedi FROM edificios WHERE id_edificio=:ided");
        $quer5->bindParam(':ided', $ided);
        $quer5->execute();
        for($i=0; $row = $quer5->fetch(); $i++){
        $nedi = $row['nedi'];

?>
        <div class="bedfree textcenter" onclick="bedselect('<?php echo $nedi; ?>', '<?php echo $npis; ?>', '<?php echo $nrom; ?>', '<?php echo $nobe; ?>', '<?php echo $idbb; ?>');"><?php echo $nobe; ?> -Disponible</div>
<?php } } } break;    case "2": ?>
        <div class="bedbusy textcenter"><?php echo $nobe; ?> -Ocupada</div>
<?php   break;   case "3":  ?>  
        <div class="bednd textcenter"><?php echo $nobe; ?> -No disponible</div>
<?php   break;    } ?>    
            <div class="bed3"><?php echo $nmeres; ?></div>
          </div>
<?php }  ?>
