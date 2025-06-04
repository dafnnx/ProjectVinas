<?php
$idr=$_GET['idr'];
$idt=$_GET['idt'];
require_once 'dompdf/autoload.inc.php';
include("functions.php");
$infores= loadres($idr);
    foreach ($infores as $inforess):
endforeach;
 $idtrat= loadtrt($idt);
        foreach ($idtrat as $idtratt):
        endforeach; 

$desc=$idtratt['med_tratamiento'];
$via=$idtratt['via_medicamento'];
$unidad=$idtratt['unidad_medicamento'];
$semana=$idtratt['semana_tratamiento'];
$total=$idtratt['total_tratamiento'];
$diat=$idtratt['dia_tratamiento'];
$siet=$idtratt['siet_tratamiento'];
$och=$idtratt['och_tratamiento'];
$trce=$idtratt['trce_tratamiento'];
$dieco=$idtratt['dieco_tratamiento'];
$vtuno=$idtratt['vtuno_tratamiento'];
$observa=$idtratt['observa_tratamiento'];
if(isset($semana))       {      
 $dias=explode(",",$semana);  }

$d1=$dias[0]; $d2=$dias[1]; $d3=$dias[2]; $d4=$dias[3]; $d5=$dias[4]; $d6=$dias[5]; $d7=$dias[6];  
if ($d1) { $d1c="<input type='checkbox' checked>"; } else {$d1c="<input type='checkbox'>";}
if ($d2) { $d2c="<input type='checkbox' checked>"; } else {$d2c="<input type='checkbox'>";}
if ($d3) { $d3c="<input type='checkbox' checked>"; } else {$d3c="<input type='checkbox'>";}
if ($d4) { $d4c="<input type='checkbox' checked>"; } else {$d4c="<input type='checkbox'>";}
if ($d5) { $d5c="<input type='checkbox' checked>"; } else {$d5c="<input type='checkbox'>";}
if ($d6) { $d6c="<input type='checkbox' checked>"; } else {$d6c="<input type='checkbox'>";}
if ($d7) { $d7c="<input type='checkbox' checked>"; } else {$d7c="<input type='checkbox'>";}
$nmedi= loadmedi($desc);
        foreach ($nmedi as $nmedii):
        endforeach; 

$vmedi= loadvia($via);
        foreach ($vmedi as $vmedii):
        endforeach; 

$umedi= loadunidad($unidad);
        foreach ($umedi as $umedii):
        endforeach; 

$codigoHTML.='
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div class="bannerhub">
<div class="imgblock">
<img src="img/bgvinas.png"  width="170" height="90">
</div>
<div class="bannerinfo">
<div class="bannermosa">
(844)431-03-85<br>
(844)415-23-20 
</div>
<div class="bannermosa">
Del Faro #331 Col. La Hibernia CP.25297<br>
Saltillo, Coahuila, México
</div>
<div class="bannermosa">                    
lasvinas.mx <br>
info@lasvinas.mx  
</div>
</div>
</div>
<div class="headerss">RESUMEN CLINICO</div>
<div class="mar5"></div>
<div class="osides">
<div class="sidea">
<table class="sesiontable2" id="sesiontable">
        <tr>
      <th>Nombre:</th>
      <td class="spacee">'.$inforess['nombre_residente'].'</td>
        </tr>
        <tr>
      <th>Edad:</th>
      <td>'.edad($inforess['fnac_residente']).'</td>
        </tr>
</table>
</div>
<div class="sideb">
<table class="sesiontable2" id="sesiontable">
        <tr>
      <th>Fecha inicio:</th>
      <td>'.$idtratt['fecha_ini'].'</td>
        </tr>
        <tr>
      <th>Fecha fin:</th>
      <td>'.$idtratt['fecha_fin'].'</td>
        </tr>
</table>
</div>
</div>
<div class="antes">
<div class="headerss">DESCRIPCIÓN</div>
<div class="pet2">
'.$nmedii['nombre_medica'].'<br><br>
Vía de administración: '.str_replace("\n", "<br>", $vmedii['nombre_via']).'<br>
Unidad: '.str_replace("\n", "<br>", $umedii['nombre_unidad']).'
</div>
<div class="tblspecialdat">
<div class="weekblk"><div class="chkreport">Lunes</div></div>
<div class="weekblk"><div class="chkreport">Martes</div></div>
<div class="weekblk"><div class="chkreport">Miercoles</div></div>
<div class="weekblk"><div class="chkreport">Jueves</div></div>
<div class="weekblk"><div class="chkreport">Viernes</div></div>
<div class="weekblk"><div class="chkreport">Sabado</div></div>
<div class="weekblk"><div class="chkreport">Domingo</div></div>
</div>
<br><br>
<div class="tblspecialdat">
<div class="weekblk"><div class="chkreport mleft">'.$d1c.'</div></div>
<div class="weekblk"><div class="chkreport mleft">'.$d2c.'</div></div>
<div class="weekblk"><div class="chkreport mleft">'.$d3c.'</div></div>
<div class="weekblk"><div class="chkreport mleft">'.$d4c.'</div></div>
<div class="weekblk"><div class="chkreport mleft">'.$d5c.'</div></div>
<div class="weekblk"><div class="chkreport mleft">'.$d6c.'</div></div>
<div class="weekblk"><div class="chkreport mleft">'.$d7c.'</div></div>
</div>
<br><br><br><br>
<div class="tblspecialdat">
<div class="weekblk"><div class="chkreport">Total sem.</div></div>
<div class="weekblk"><div class="chkreport">Al dia</div></div>
<div class="weekblk"><div class="chkreport">7h</div></div>
<div class="weekblk"><div class="chkreport">8h</div></div>
<div class="weekblk"><div class="chkreport">13h</div></div>
<div class="weekblk"><div class="chkreport">18h</div></div>
<div class="weekblk"><div class="chkreport">21h</div></div>
</div>
<br><br>
<div class="tblspecialdat">
<div class="weekblk"><div class="chkreport ">'.$total.'</div></div>
<div class="weekblk"><div class="chkreport ">'.$diat.'</div></div>
<div class="weekblk"><div class="chkreport ">'.$siet.'</div></div>
<div class="weekblk"><div class="chkreport ">'.$och.'</div></div>
<div class="weekblk"><div class="chkreport ">'.$trce.'</div></div>
<div class="weekblk"><div class="chkreport ">'.$dieco.'</div></div>
<div class="weekblk"><div class="chkreport">'.$vtuno.'</div></div>
</div>
<br><br><br>
<div class="headerss">OBSERVACIONES:</div>
<div class="plan">'.$observa.'</div>
</div>
</body>
</html>';
$codigoHTML=utf8_decode(utf8_encode($codigoHTML));
use Dompdf\Dompdf;
$dompdf=new DOMPDF(['chroot' => __DIR__]);
$dompdf->load_html($codigoHTML);
$dompdf->setPaper(array(0,0,595.28,470), 'portrait');
$dompdf->render();
$dompdf->stream('Tratamiento '.$inforess['nombre_residente'].'.pdf');
?>

<?php
function edad($fecha_nacimiento)  {
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y"); }
 ?>