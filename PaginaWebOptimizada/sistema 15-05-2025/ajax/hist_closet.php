<?php    
    $count_query= $db2->prepare("SELECT count(MONTH(fecha_closet)) AS nrhist FROM closet WHERE id_residente=:id AND MONTH(fecha_closet)=:mont");
    $count_query->bindParam(':id', $idres);
    $count_query->bindParam(':mont', $month);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $nrhist = $row['nrhist'];   }
    $quer= $db2->prepare("SELECT * FROM closet WHERE id_residente=:id AND MONTH(fecha_closet)=:mont");
    $quer->bindParam(':id', $idres);
    $quer->bindParam(':mont', $month);
    $quer->execute();
    if ($nrhist>0){   ?>
      <div class="histupp">Closet</div>
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>P. tiras</th>
          <th class='text-center'>P. calzon</th>
          <th class='text-center'>Toalla sanitaria</th>
          <th class='text-center'>Aposito</th>
          <th class='text-center'>Pre</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $quer->fetch(); $i++){
             $idee = $row['id_closet'];
             $fecha = $row['fecha_closet']; 
             $tiras = $row['ptiras_closet'];  
             $calz = $row['pcalz_closet']; 
             $toall = $row['toallsan_closet'];
             $aposito= $row['aposito_closet'];
             $pre = $row['pre_closet'];            ?>
          <tr>
            <td><?php echo $fecha; ?></td> 
            <td><?php echo $tiras; ?></td>
            <td><?php echo $calz; ?></td>
            <td><?php echo $toall; ?></td>
            <td><?php echo $aposito; ?></td>
            <td><?php echo $pre; ?></td> 
          </tr>
          <?php } ?>
        </table>      
<?php   }  else {   echo "<span class='disponible'>Sin capturas.</span>"; }?>