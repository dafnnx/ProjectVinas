<div class="info gral">
<?php
 $ide= $_POST['ide'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE id_ejercicio=:id");
    $count_query->bindParam(':id', $ide);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}

    $query=$db2->prepare("SELECT * FROM payconcept WHERE id_ejercicio=:id");
    $query->bindParam(':id', $ide);
    $query->execute(); 

    if ($numrows>0) {      ?>
        <div class="edge">
      <div class="">
         <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>Cant.</th>
          <th class='text-center'>Concepto</th>
          <th class='text-center'>Persona</th>
          <th class='text-center'>Debe</th>
          <th class='text-center'>Aporta</th>
          <th class='text-center'>Saldo</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){
          $idpa= $row['id_pay'];
          $fecha= $row['fecha_pay'];
          $cantidad= $row['cantidad_pay'];
          $concepto= $row['concept_pay'];    
          $debe= $row['debe_pay'];
          $aporta= $row['aporta_pay']; 
          $persona= $row['persona_pay']; 
          $iva= $row['iva_pay'];
          if ($iva) {   $debeiva= $debe+$iva;     }
          else {  $debeiva=$debe;  }
          

$fnmed = new DateTime($fecha);
$fenfer = $fnmed->format("d-M-Y h:i a");
          if (is_numeric($concepto)) {
        $cery= $db2->prepare("SELECT nombre_medica AS nomedic FROM medicamentos WHERE id_medica=:nm");
        $cery->bindParam(':nm', $concepto);
        $cery->execute();
          for($i=0; $row = $cery->fetch(); $i++){      
            $nomedic = $row['nomedic'];
            $concepto2 = $nomedic;         }
    } else  {
          $concepto2= $concepto; }
          ?>
          <tr>
            <td><?php echo $fenfer; ?></td> 
            <td><?php echo $cantidad; ?></td> 
            <td><?php echo $concepto2; ?></td> 
            <td><?php echo $persona; ?></td> 
<?php if ($debeiva) { ?>
  <td >$  <?php echo $debeiva; ?></td>
<?php } else {  ?>
            <td>$ <?php echo $idpa; ?></td> 
<?php } 
 if ($aporta) { ?>
  <td>$ <?php echo $aporta; ?></td>
<?php } else {?>
            <td>$ <?php echo $aporta; ?></td> 
<?php } ?>  
          <td>$ <?php
    $_qery= $db2->prepare("SELECT SUM(debe_pay) AS deb,  SUM(iva_pay) AS iv FROM payconcept WHERE id_ejercicio=:id ORDER BY fecha_pay ASC");
    $_qery->bindParam(':id', $ide);
    $_qery->execute();
    for($i=0; $row = $_qery->fetch(); $i++){ 
      $iv = $row['iv']; 
      $deb = $row['deb']; 
      if ($iv) {  $debiv= $deb+$iv;  }
      else {  $debiv=$deb; }
      }

    $_query= $db2->prepare("SELECT SUM(aporta_pay) AS apo FROM payconcept WHERE id_ejercicio=:id ORDER BY fecha_pay ASC");
    $_query->bindParam(':id', $ide);
    $_query->execute();
    for($i=0; $row = $_query->fetch(); $i++){  $apo = $row['apo'];  }
      echo number_format($apo-$debiv, 2); 
 ?>   
          </td> 
          </tr>
          <?php } ?>
        </table>
      </div>
        </div>
<?php } 
else {  echo "No hay conceptos en el ejercicio";   }  ?>
</div>