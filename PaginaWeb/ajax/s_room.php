<?php
$idpp= $_POST['idxx'];
    require_once ("../cn/connect2.php");
    $quer2= $db2->prepare("SELECT DISTINCT id_room, nombre_room FROM rooms WHERE id_piso=:idpp");
    $quer2->bindParam(':idpp', $idpp);
    $quer2->execute(); ?>
<table class="table" data-responsive="table" id="resultTable"> 
<?php
    for($i=0; $row = $quer2->fetch(); $i++){
    $idrr = $row['id_room'];
    $noro = $row['nombre_room']; ?>
        <tr>
    <td class="pointer" onclick="showvar('<?php echo $idrr; ?>', 'bed');"><?php echo $noro; ?></td>
        </tr>
<?php }         ?>
</table>