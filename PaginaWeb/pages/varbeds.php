<div class="varmodulex bordergray padd5">
  <div class="ribbonmed">LISTA DE CAMAS</div>
  <div class="varcntrlx">
<?php
  require_once ("../cn/connect2.php");  
    $count_query= $db2->prepare("SELECT id_residente AS idresi, nombre_residente AS nomresi, cama_residente AS camresi FROM residentes");
    $count_query->execute(); ?>
      <div class="edgex">
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>        
          <th class='text-center'>Residente</th>   
          <th class='text-center'>Cama</th>
          <th class='text-center'>Crear</th>
          <th class='text-center'>Qr</th>             
        </tr>
        </thead>
        <?php
        for($i=0; $row = $count_query->fetch(); $i++){
            $idresi=$row['idresi'];
            $nomresi=$row['nomresi'];
            $camresi=$row['camresi']; ?>  
          <tr>
            <td><?php echo $nomresi; ?></td>
            <td><?php echo $camresi; ?></td>
            <td>
              <button onclick="testqr('<?php echo $idresi; ?>')" >Crear</button>
               <a id="download<?php echo $idresi; ?>" href="" download="<?php echo $nomresi; ?>.png" onclick="qrdown('<?php echo $idresi; ?>')"><button>Bajar</button></a>
            </td>
            <td>
              <div class="squareqr" id="qrcode<?php echo $idresi; ?>"></div>              
            </td>
          </tr>
          <?php  }  ?>
        </table>
      </div>
      </div>
  </div>
</div>