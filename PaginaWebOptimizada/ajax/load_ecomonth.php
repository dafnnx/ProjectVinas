<div class="info gral">
<?php
 $rid= $_POST['rid'];
 $mes= $_POST['mes'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM tarifas WHERE id_residente=:id AND fecha_tarifa=:mes");
    $count_query->bindParam(':id', $rid);
    $count_query->bindParam(':mes', $mes);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM tarifas WHERE id_residente=:id AND fecha_tarifa=:mes");
    $query->bindParam(':id', $rid);
    $query->bindParam(':mes', $mes);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>Cantidad</th>
          <th class='text-center'>Persona</th>
          <th class='text-center'>f. pago</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $idpa= $row['id_tarifa'];
          $fecha= $row['dia_tarifa'];
          $cantidad= $row['abono_tarifa'];
          $fpago= $row['fpago_tarifa']; 
          $ppago= $row['persona_tarifa'];    
$fnmed = new DateTime($fecha);
$fenfer = $fnmed->format("d-M-Y");    ?>
          <tr>
            <td><?php echo $fenfer; ?></td> 
            <td>
$<input type="text" class="ed_input w230" value="<?php echo $cantidad; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'abono_tarifa', this.value, 'tarifas', 'id_tarifa');">
            </td>
<?php if ($ppago) { ?>
            <td>
<input type="text" class="ed_input w230" value="<?php echo $ppago; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'persona_tarifa', this.value, 'tarifas', 'id_tarifa');">
            </td> 
<?php } else { ?>
            <td>N/A </td>  
 <?php } ?>
            <td>
<input type="text" class="ed_input w230" value="<?php echo $fpago; ?>" onblur="eco_live_up('<?php echo $idpa; ?>', 'fpago_tarifa', this.value, 'tarifas', 'id_tarifa');">
            </td>  
            <td> 


<?php if ($cantidad) { ?><a class='send' title='Enviar' onclick="mdlsendmonth('<?php echo $idpa; ?>', '<?php echo $rid; ?>')"></a>
<?php  } else { ?>  <a class='empty'></a> <?php } ?> 
          </td> 


          </tr>
          <?php } ?>
        </table>
      </div>
<?php } 
else {  echo "Sin captura de pagos";   }  ?>
</div>
<?php     include ("modal_sendmonth.php");     ?>