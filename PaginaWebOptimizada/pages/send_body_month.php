<?php 
 require_once ("../cn/connect2.php");
$rid= $_POST['rid'];
$idpa= $_POST['idpa'];
    $_qry= $db2->prepare("SELECT nombre_residente AS nom_r FROM residentes WHERE id_residente=:rid");
    $_qry->bindParam(':rid', $rid);
    $_qry->execute();
    for($i=0; $row = $_qry->fetch(); $i++){  $nom_r = $row['nom_r'];  } 

    $count_query= $db2->prepare("SELECT count(DISTINCT mail_contacto) AS numrows FROM contactos WHERE id_residente=:rid");
    $count_query->bindParam(':rid', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $numrows = $row['numrows'];   }      ?>
<div class="info gral">
  <div class="textcenter fw6"><?php echo $nom_r; ?> </div><br>

<?php    if ($numrows>0) {    ?>
<div class="textcenter"> 
Por favor, selecciona el contacto al que deseas enviar el comprobante de pago:
 <div class="edge">
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Nombre</th>
          <th class='text-center'>Correo</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
    $_qr= $db2->prepare("SELECT DISTINCT id_contacto AS idc, nombre_contacto AS nco, mail_contacto AS mail FROM contactos WHERE id_residente=:rid AND mail_contacto!=''");
    $_qr->bindParam(':rid', $rid);
    $_qr->execute();
    for($i=0; $row = $_qr->fetch(); $i++){  
      $idc = $row['idc'];  
      $nco = $row['nco']; 
      $mail = $row['mail'];       ?>
        <tr>
            <td><?php echo $nco; ?></td> 
            <td><?php echo $mail; ?></td> 
            <td><a class='email' title='Enviar' onclick="xsendmonth('<?php echo $rid; ?>', '<?php echo $mail; ?>', '<?php echo $idpa; ?>')"></a></td> 
        </tr>
    <?php    }    ?>
        </table>
      </div>
</div>

 </div>
<?php  } else {  echo "¡El residente no tiene contactos capturados o ningun contacto tiene email capturado!"; }   ?>

  <div class="separator"></div>
 <div class="sendans" id="send_answ_month"></div>
</div>
<script type="text/javascript" src="js/utils.js"></script>