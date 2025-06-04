<?php
require_once('../cn/connect2.php');
$idr=$_GET['idr'];

require_once 'dompdf/autoload.inc.php';
include("functions.php");
$infores= loadres($idr);
    foreach ($infores as $inforess):
endforeach;

$mihtml = '<!DOCTYPE HTML>';
$mihtml .= '<head>';
$mihtml .= '<link rel="stylesheet" href="style.css" type="text/css" />';
$mihtml .= '</head>';
$mihtml .= '<body>';
$mihtml .= '<br>';

$mihtml .= '<div class="bannerhub">';
$mihtml .= '                    <div class="imgblock">';
$mihtml .= '                       <img src="img/bgvinas.png"  width="170" height="90">';
$mihtml .= '                    </div>';
$mihtml .= '</div>';

$mihtml .= '<div class="headerss">TRATAMIENTO MÉDICO</div>';
$mihtml .= '<div class="separ"></div>';
$mihtml .= '<div class="sides">';
$mihtml .= '<div class="sidea">';
$mihtml .= '<table class="sesiontable2" id="sesiontable">';
$mihtml .= '<tr>';
$mihtml .= '<th>Nombre:</th>';
$mihtml .= '<td class="spacee">'.$inforess['nombre_residente'].'</td>';  
$mihtml .= '</tr>';
$mihtml .= '<tr>';
$mihtml .= '<th>Alergia:</th>';
$mihtml .= '<td class="spacee">'.$inforess['alergia_residente'].'</td>'; 
$mihtml .= '</tr>';
$mihtml .= '<tr>';
$mihtml .= '<th>RCP:</th>';
$mihtml .= '<td class="spacee">'.$inforess['rcp_residente'].'</td>'; 
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';
$mihtml .= '<div class="sideb">';
$mihtml .= '<table class="sesiontable2" id="sesiontable">';
$mihtml .= '<tr>';
$mihtml .= '<th>Fecha:</th>';
$mihtml .= '<td>'.date("d-M-Y").'</td>';
$mihtml .= '</tr>';
$mihtml .= '<tr>';
$mihtml .= '<th>Patologia:</th>';
$mihtml .= '<td class="spacee">'.$inforess['patologia_residente'].'</td>'; 
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';
$mihtml .= '</div>';

$mihtml .= '<table class="table w100per tablec" data-responsive="table" id="resultTable">';
$mihtml .= '<thead>';
$mihtml .= '<tr>';
$mihtml .= '<th class="w15per bsolid fsgral">DURACION</th>';
$mihtml .= '<th class="w30per"></th>';
$mihtml .= '<th class="w20per bsolid fsgral">APLICACION</th>';
$mihtml .= '<th class="w30per bsolid fsgral">DOSIS/POSOLOGIA</th>';
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '</table>';
$mihtml .= '<table class="table w100per tablec" data-responsive="table" id="resultTable">';
$mihtml .= '<thead>';
$mihtml .= '<tr>';
$mihtml .= '<th class="w75per bsolid fsgral">DESDE</th>';
$mihtml .= '<th class="w75per bsolid fsgral">HASTA</th>';
$mihtml .= '<th class="w30per bsolid fsgral">MEDICAMENTO</th>';
$mihtml .= '<th class="w20per bsolid">
<div class="w90per">
<div class="w114 fsgral mrr he26 mbm5">
        <div class="cntrd">L</div>
</div>
<div class="w114 fsgral mrr he26 mbm5">
        <div class="cntrd">M</div>
</div>
<div class="w114 fsgral mrr he26 mbm5">
        <div class="cntrd">M</div>
</div>
<div class="w114 fsgral mrr he26 mbm5">
        <div class="cntrd">J</div>
</div>
<div class="w114 fsgral mrr he26 mbm5">
        <div class="cntrd">V</div>
</div>
<div class="w114 fsgral mrr he26 mbm5">
        <div class="cntrd">S</div>
</div>
<div class="w114 fsgral mrr he26 mbm5">
        <div class="cntrd">D</div>
</div>
<div class="w12p fsgral">PRN</div>
</div>
</th>';
$mihtml .= '<th class="w30per bsolid">
<div class="w125 fsgral mrr">
        <div class="cntrd4">Al dia</div>
</div>
<div class="w125 fsgral mrr">
        <div class="cntrd4">7h</div>
</div>
<div class="w125 fsgral mrr">
        <div class="cntrd4">8h</div>
</div>
<div class="w125 fsgral mrr">
        <div class="cntrd4">13h</div>
</div>
<div class="w125 fsgral mrr">
        <div class="cntrd4">18h</div>
</div>
<div class="w125 fsgral">
        <div class="cntrd4">21h</div>
</div>
</th>';
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '</table>';

$mihtml .= '<table class="table w100per tablec" data-responsive="table" id="resultTable">';
$mihtml .= '<thead>';
$mihtml .= '<tr>';
$mihtml .= '<th class="w27pern bsolid fsgral">OBSERVACIONES</th>';
/*$mihtml .= '<th class="w10per bsolid fsgral">P. ESPECIAL</th>';*/
$mihtml .= '<th class="w10per bsolid fsgral">T. MEDICA</th>';
$mihtml .= '<th class="w10per bsolid fsgral">VIA</th>';
$mihtml .= '<th class="w10per bsolid fsgral">UNIDAD</th>';
/*$mihtml .= '<th class="w10per bsolid fsgral">PATOLOGIA</th>';*/
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '</table>';
$mihtml .= '<div class="separator5"></div>'; 
    $sql = "SELECT * FROM tratamientos WHERE id_residente=$idr ORDER BY id_tratamiento DESC";
    $sa4 = $db2->prepare($sql);
    $sa4->execute();
    for($i=0; $row = $sa4->fetch(); $i++) { 
$fini=$row['fecha_ini'];
$ffin=$row['fecha_fin'];

if ($fini) {    $inni= new DateTime($fini);    $innni = $inni->format("d-M-Y"); }
if ($ffin) {    $finni= new DateTime($ffin);    $finnni = $finni->format("d-M-Y"); }
 

$desc=$row['med_tratamiento'];
$via=$row['via_medicamento'];
$unidad=$row['unidad_medicamento'];
$semana=$row['semana_tratamiento'];
$total=$row['total_tratamiento'];
$diat=$row['dia_tratamiento'];
$siet=$row['siet_tratamiento'];
$och=$row['och_tratamiento'];
$trce=$row['trce_tratamiento'];
$dieco=$row['dieco_tratamiento'];
$vtuno=$row['vtuno_tratamiento'];
$observa=$row['observa_tratamiento'];
$pauta=$row['pauta_tratamiento'];
$tipom=$row['tipom_tratamiento'];
$semana2=str_replace(',','',$semana); 

$ss1= strpos($semana2, '1');
$ss2= strpos($semana2, '2');
$ss3= strpos($semana2, '3');
$ss4= strpos($semana2, '4');
$ss5= strpos($semana2, '5');
$ss6= strpos($semana2, '6');
$ss7= strpos($semana2, '7');

if ($ss1 !== false) { $d1c="X"; } else {$d1c="";}
if ($ss2 !== false) { $d2c="X"; } else {$d2c="";}
if ($ss3 !== false) { $d3c="X"; } else {$d3c="";}
if ($ss4 !== false) { $d4c="X"; } else {$d4c="";}
if ($ss5 !== false) { $d5c="X"; } else {$d5c="";}
if ($ss6 !== false) { $d6c="X"; } else {$d6c="";}
if ($ss7 !== false) { $d7c="X"; } else {$d7c="";}

if ($pauta) { $pauta1="X"; } else {$pauta1="";}
$nmedi= loadmedi($desc);
        foreach ($nmedi as $nmedii):
        endforeach; 

$vmedi= loadvia($via);
        foreach ($vmedi as $vmedii):
        endforeach; 

$umedi= loadunidad($unidad);
        foreach ($umedi as $umedii):
        endforeach; 
$mihtml .= '<div class="separator5"></div>'; 
$mihtml .= '<div class="w100  he20 ">
<div class="w475per fsgral ">
<div class="w16per bsolid dpiblock" style="text-align:center;">'.$innni.'</div>
<div class="w16per bsolid dpiblock ml3" >'.$finnni.'</div>
<div class="w67pern bsolid dpiblock ml3" style="text-align:center;">'.$nmedii['nombre_medica'].'</div>
<div class="w44p09pern bsolid dpiblock ml3 bcolorwhite">

<div class="w9pern dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$d1c.'</div>
</div>
<div class="w9pern dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$d2c.'</div>
</div>
<div class="w9pern dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$d3c.'</div>
</div>
<div class="w9pern dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$d4c.'</div>
</div>
<div class="w9pern dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$d5c.'</div>
</div>
<div class="w9pern dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$d6c.'</div>
</div>
<div class="w9pern dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$d7c.'</div>
</div>
<div class="w12pern dpiblock  mlp5 top2p" style="text-align:center;">
        <div class="cntrd4">'.$pauta1.'</div>
</div>
</div>

<div class="w655pern bsolid dpiblock ">

<div class="w145min dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$diat.'</div>
</div>
<div class="w145min dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$siet.'</div>
</div>
<div class="w145min dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$och.'</div>
</div>
<div class="w145min dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$trce.'</div>
</div>
<div class="w145min dpiblock  mlp5 top2p mrr" style="text-align:center;">
        <div class="cntrd4">'.$dieco.'</div>
</div>
<div class="w145min dpiblock  mlp5 top2p " style="text-align:center;">
        <div class="cntrd4">'.$vtuno.'</div>
</div>

</div>

</div>
</div>';

$mihtml .= '<div class="separator2"></div>';

$mihtml .= '<div class="w100  he20">
<div class="w47p1per bsolid dpiblock " style="text-align:center;">'.$observa.'</div>
<div class="w17pern bsolid dpiblock mlm4" style="text-align:center;">'.$tipom.'</div>
<div class="w17pern bsolid dpiblock mlm4" style="text-align:center;">'.$vmedii['nombre_via'].'</div>
<div class="w17pern bsolid dpiblock tcenter ml3" style="text-align:center;">'.$umedii['nombre_unidad'].'</div>
</div> ';

$mihtml .= '<div class="separator5"></div>';
$mihtml .= '<div class="separator5"></div>';  };

$mihtml .= '</div>';
$mihtml .= '</body>';
$mihtml .= '</html>';
$codigoHTML=utf8_decode(utf8_encode($codigoHTML));
use Dompdf\Dompdf;
$dompdf=new DOMPDF(['chroot' => __DIR__]);
$dompdf->load_html($mihtml);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Tratamientos '.$inforess['nombre_residente'].'.pdf');
?>