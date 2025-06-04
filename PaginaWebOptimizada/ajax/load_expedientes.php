<div class="info gral">
<?php
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM nota_medica WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM nota_medica WHERE id_residente=:id ORDER BY fec_notamed DESC");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){  ?>
      <div class="edge">
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Lista</th>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>Motivo</th>
          <th class='text-center'>Médico</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        $j=1;
        for($i=0; $row = $query->fetch(); $i++){
          $idnota= $row['id_notamed'];
          $usrnota= $row['id_usuario'];
          $fecha= $row['feccap_notamed'];  
          $motivo= $row['motivo_notamed'];   
$fnmed = new DateTime($fecha);
$fmed = $fnmed->format("d-M-Y H:i A") ?>
          <tr>
            <td><?php echo $j++; ?></td> 
            <td><?php echo $fmed; ?></td> 
            <td><?php echo $motivo; ?></td> 
<?php
    $query8=$db2->prepare("SELECT nombre_personal AS np FROM personal WHERE id_personal=(SELECT id_personal FROM users WHERE user_id=:usn)");
    $query8->bindParam(':usn', $usrnota);
    $query8->execute();  
        for($i=0; $row = $query8->fetch(); $i++){          ?>
            <td><?php echo $row['np']; ?></td>
      <?php } ?>
              <td>
            <div class="psearch" id="mdbed" onclick="mdlnote(modnota, 'notaclose', <?php echo $idnota; ?>)"></div>
            <a href="reportes/exp_med.php?idr=<?php echo $rid;?>&idn=<?php echo $idnota;?>"><div class="print"></div></a>
              </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
<?php } 
else {  echo "Sin captura de notas";   }  ?>
</div>

<?php include ("modal_nota.php"); ?>