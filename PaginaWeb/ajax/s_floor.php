<?php
$idee= $_POST['idxx'];
    require_once ("../cn/connect2.php");
    $quer2= $db2->prepare("SELECT DISTINCT id_piso, nombre_piso FROM pisos WHERE id_edificio=:idee");
    $quer2->bindParam(':idee', $idee);
    $quer2->execute(); ?>
<table class="table" data-responsive="table" id="resultTable"> 
<?php
    for($i=0; $row = $quer2->fetch(); $i++){
    $idpp = $row['id_piso'];
    $nopi = $row['nombre_piso']; ?>
        <tr>
    <td class="pointer" onclick="showvar('<?php echo $idpp; ?>', 'room');"><?php echo $nopi; ?></td>
        </tr>
        <?php }         ?>
</table>
