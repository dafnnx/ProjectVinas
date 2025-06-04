<div class="infosub gral">
<?php
 $idnote= $_POST['idnote'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM seg_notamedica WHERE id_notamed=:idnote");
    $count_query->bindParam(':idnote', $idnote);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM seg_notamedica WHERE id_notamed=:idnote");
    $query->bindParam(':idnote', $idnote);
    $query->execute(); ?>
    <?php 
    if ($numrows>0){ ?>
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
          $idsegnota= $row['id_segnotamed'];
          $usrnota= $row['id_usuario'];
          $fecha= $row['fec_segnotamed'];  
          $motivo= $row['motivo_segnotamed'];
$fecha = new DateTime($fini);
$ffni = $fecha->format("d-M-Y");  ?>
        <tr>
           <td><?php echo $j++; ?></td>
           <td><?php echo $ffni; ?></td>
           <td><?php echo $motivo; ?></td>
<?php
    $query8=$db2->prepare("SELECT nombre_personal AS np FROM personal WHERE id_personal=(SELECT id_personal FROM users WHERE user_id=:usn)");
    $query8->bindParam(':usn', $usrnota);
    $query8->execute();  
        for($i=0; $row = $query8->fetch(); $i++){          ?>
            <td><?php echo $row['np']; ?></td>
      <?php } ?>
           <td>
               <div class="psearch" onclick="view_seg('<?php echo $idsegnota; ?>');"></div>
           </td>
        </tr>
<?php } ?>
</table>
        </div>
 <?php  }       else {  echo "Sin captura de seguimientos";   } ?>
</div>