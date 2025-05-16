<div class="info gral">
<?php
 $rid= $_POST['rid'];
 require_once ("../cn/connect2.php");
?>
<div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Mes</th>
          <th class='text-center'>Tarifa</th>
          <th class='text-center'>Abonos</th>
          <th class='text-center'>Diferencia</th>
          <th class='text-center'>Status</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
$tar=$db2->prepare("SELECT DISTINCT fecha_tarifa AS ftari FROM tarifas WHERE id_residente=:id ORDER BY fecha_tarifa DESC");
$tar->bindParam(':id', $rid);
$tar->execute();
for($i=0; $row = $tar->fetch(); $i++){
  $ftari= $row['ftari'];
$fnmed = new DateTime($ftari);
$fenfer = $fnmed->format("d-M-Y"); 
$mes = $fnmed->format("M");
$an = $fnmed->format("Y"); 
$dmes=$an."-".$mes;    ?>
            <tr>
            <td><?php echo $dmes; ?></td> 
<?php
$tarm=$db2->prepare("SELECT MAX(tarifa_residente) AS tmes FROM tarifas WHERE id_residente=:id AND fecha_tarifa=:ftari");
$tarm->bindParam(':id', $rid);
$tarm->bindParam(':ftari', $ftari);
$tarm->execute();
for($i=0; $row = $tarm->fetch(); $i++){
 $tmes= $row['tmes'];  ?>
            <td>$ <?php echo $tmes; ?></td>
<?php }

$abo=$db2->prepare("SELECT SUM(abono_tarifa) AS abot FROM tarifas WHERE id_residente=:id AND fecha_tarifa=:ftari");
$abo->bindParam(':id', $rid);
$abo->bindParam(':ftari', $ftari);
$abo->execute();
for($i=0; $row = $abo->fetch(); $i++){
 $abot= $row['abot']; ?>         
            <td>$ <?php echo $abot; ?></td> 
 <?php } ?>   
            <td>$ <?php echo $tmes-$abot; ?></td>
            <td>      <?php if ($abot>=$tmes) { echo "COMPLETO"; }
            else { echo "PARCIAL"; }      ?>   
            </td>
            <td><div class="acco" title="detalles" onclick="ld_ecomonc('<?php echo $rid;?>', '<?php echo $ftari;?>');"></div></td>
          </tr>
<?php }  ?>
</div>
<!--
<input type="text" class="ed_input w230" value="<?php echo $fpago; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'fpago_paym', this.value, 'paymont', 'id_paym');">
-->