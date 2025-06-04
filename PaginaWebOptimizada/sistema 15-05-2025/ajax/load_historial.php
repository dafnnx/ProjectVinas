<div class="hist top5">
<?php   require_once ("../cn/connect2.php");
		$idres =$_POST['idres']; 
		$mont= date('m');	
        $year= date('Y');   
    $count_query= $db2->prepare("SELECT count(*) AS nrhist FROM dayresult WHERE id_residente=:id AND MONTH(fecha_result)=:mont AND YEAR(fecha_result)=:year");
    $count_query->bindParam(':id', $idres);
    $count_query->bindParam(':mont', $mont);
    $count_query->bindParam(':year', $year);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $nrhist = $row['nrhist'];   }
    $quer= $db2->prepare("SELECT * FROM dayresult WHERE id_residente=:id AND MONTH(fecha_result)=:mont AND YEAR(fecha_result)=:year");
    $quer->bindParam(':id', $idres);
    $quer->bindParam(':mont', $mont);
    $quer->bindParam(':year', $year);
    $quer->execute();
    if ($nrhist>0){   ?>
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center w16per'>Fecha</th>
          <th class='text-center w16per'>P. tiras</th>
          <th class='text-center w16per'>P. calzon</th>
          <th class='text-center w16per'>Toalla sanitaria</th>
          <th class='text-center w16per'>Aposito</th>
          <th class='text-center w16per'>Pre</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $quer->fetch(); $i++){
            $fecresult = $row['fecha_result'];
                $fpnmed = new DateTime($fecresult);
                $fpmed = $fpnmed->format("d-M-Y");
            $ptcresult = $row['ptiras_result'];
            $pccresult = $row['pcalz_result'];
            $tsresult =  $row['toallsan_result'];
            $apresult =  $row['aposito_result'];
            $preresult = $row['pre_result']; ?>
          <tr>
            <th><?php echo $fpmed; ?></th>
            <th><?php echo $ptcresult; ?></th>
            <th><?php echo $pccresult; ?></th>
            <th><?php echo $tsresult; ?></th>
            <th><?php echo $apresult; ?></th>
            <th><?php echo $preresult; ?></th>
          </tr>
          <?php } ?>
        </table>      
<?php   }  else {   echo "<span class='disponible'>Sin capturas.</span>"; }?>
</div>
<div class="histres">
<table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center w16per'>Totales</th>
<?php
    $ery=$db2->prepare("SELECT 
      SUM(ptiras_result) AS ptcresul, 
      SUM(pcalz_result) AS pccresul, 
      SUM(toallsan_result) AS tsresul,
      SUM(aposito_result) AS apresul,
      SUM(pre_result) AS preresul FROM dayresult WHERE id_residente=$idres AND MONTH(fecha_result)=$mont AND YEAR(fecha_result)=$year");
    $ery->execute();
    for($i=0; $row = $ery->fetch(); $i++){ 
    $ptcresul = $row['ptcresul'];
    $pccresul = $row['pccresul'];
    $tsresul = $row['tsresul'];
    $apresul = $row['apresul'];
    $preresul = $row['preresul'];
     }    ?>
          <th class='text-center w16per'><?php echo $ptcresul; ?></th>
          <th class='text-center w16per'><?php echo $pccresul; ?></th>
          <th class='text-center w16per'><?php echo $tsresul; ?></th>
          <th class='text-center w16per'><?php echo $apresul; ?></th>
          <th class='text-center w16per'><?php echo $preresul; ?></th>
        </tr>
        </thead>
</table>
   </div> 
      <div class="panahistres">
<div class="ribbonlite">HISTORIAL<div class="colap rig" onclick="toggle('psubhist')">&#x2630</div></div>
      </div>
<div class="panasubhist top5" id="psubhist">
  <?php
    $ery=$db2->prepare("SELECT DISTINCT MONTH(fecha_result) AS mnt FROM dayresult WHERE id_residente=:id AND YEAR(fecha_result)=:year");
    $ery->bindParam(':id', $idres);
    $ery->bindParam(':year', $year);
    $ery->execute();
    for($i=0; $row = $ery->fetch(); $i++){  $mnt =$row['mnt'];  ?>
<div class="histres">
<table class="table resultTablepana" data-responsive="table" >
          <thead>
        <tr>
             <th class='text-center w16per'>
            <?php 
         $dateObject = DateTime::createFromFormat('!m', $mnt);
         $monthName = $dateObject->format('M');
         echo $monthName;
             ?>
            </th>
<?php
    $ery2=$db2->prepare("SELECT 
      SUM(ptiras_result) AS ptcresul, 
      SUM(pcalz_result) AS pccresul, 
      SUM(toallsan_result) AS tsresul,
      SUM(aposito_result) AS apresul,
      SUM(pre_result) AS preresul FROM dayresult WHERE id_residente=:id AND MONTH(fecha_result)=:mnt AND YEAR(fecha_result)=:year");
    $ery2->bindParam(':id', $idres);
    $ery2->bindParam(':mnt', $mnt);
    $ery2->bindParam(':year', $year);
    $ery2->execute();
    for($i=0; $row = $ery2->fetch(); $i++){ 
    $ptcresul = $row['ptcresul'];
    $pccresul = $row['pccresul'];
    $tsresul = $row['tsresul'];
    $apresul = $row['apresul'];
    $preresul = $row['preresul'];
     }    ?>
          <th class='text-center w16per'><?php echo $ptcresul; ?></th>
          <th class='text-center w16per'><?php echo $pccresul; ?></th>
          <th class='text-center w16per'><?php echo $tsresul; ?></th>
          <th class='text-center w16per'><?php echo $apresul; ?></th>
          <th class='text-center w16per'><?php echo $preresul; ?></th>
        </tr>
        </thead>
</table>
   </div> 
  <?php     }    ?>
</div> 