<div class="info gral">
<?php
 $rid= $_POST['rid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM nota_enfermeria WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM nota_enfermeria WHERE id_residente=:id ORDER BY fec_notaenfer DESC LIMIT 250");
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
          <th class='text-center'>Médico</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        $j=1;
        for($i=0; $row = $query->fetch(); $i++){
          $idnota= $row['id_notaenfer'];
          $usrnota= $row['id_usuario'];
          $fecha= $row['fec_notaenfer'];
$fnmed = new DateTime($fecha);
$fenfer = $fnmed->format("d-M-Y H:i A");
        ?>
          <tr>
            <td><?php echo $j++; ?></td> 
            <td><?php echo $fenfer; ?></td> 
    <?php
    $query8=$db2->prepare("SELECT nombre_personal AS np FROM personal WHERE id_personal=(SELECT id_personal FROM users WHERE user_id=:usn)");
    $query8->bindParam(':usn', $usrnota);
    $query8->execute();  
        for($i=0; $row = $query8->fetch(); $i++){          ?>
            <td><?php echo $row['np']; ?></td>
      <?php } ?>
            <td><div class="psearch" onclick="mdlnoteenfer('<?php echo $idnota; ?>')"></div></td>
          </tr>
          <?php } ?>
        </table>
      </div>
        </div>
<?php } 
else {  echo "Sin captura de notas";   }  ?>
</div>

<?php include ("modal_notaenfer.php"); ?>