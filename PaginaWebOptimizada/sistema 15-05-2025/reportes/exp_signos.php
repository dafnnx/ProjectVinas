<?php
require_once('../cn/connect2.php');
$q1=$_GET['q1'];
$q2=$_GET['q2'];
$idr=$_GET['idr'];
         $ta =$_GET['ta']; 
         $fc =$_GET['fc']; 
         $fr =$_GET['fr']; 
         $sat =$_GET['sat']; 
         $temp =$_GET['temp']; 
         $gli =$_GET['gli']; 
         $per =$_GET['per']; 
         $can =$_GET['can']; 
         $nom =$_GET['nom']; 
         $noe =$_GET['noe']; 
         $nop =$_GET['nop']; 
         $vis =$_GET['vis']; 
         $cai =$_GET['cai']; 
         $dea =$_GET['dea']; 
         $ban =$_GET['ban']; 
         $buc =$_GET['buc']; 
         $ter =$_GET['ter']; 
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


$mihtml .= '<div class="bannerhub">';
$mihtml .= '                    <div class="imgblock">';
$mihtml .= '                       <img src="img/bgvinas.png"  width="170" height="90">';
$mihtml .= '                    </div>';
$mihtml .= '       <div class="bannerinfo">';
$mihtml .= '               <div class="bannermosa">';
$mihtml .= '                    (844)431-03-85<br>';
$mihtml .= '                    (844)415-23-20 '; 
$mihtml .= '               </div>';
$mihtml .= '                <div class="bannermosa">';
$mihtml .= '                    Del Faro #331 Col. La Hibernia CP.25297<br>';
$mihtml .= '                    Saltillo, Coahuila, México  ';
$mihtml .= '                </div>';
$mihtml .= '                <div class="bannermosa">';                    
$mihtml .= '                    lasvinas.mx <br>';
$mihtml .= '                   info@lasvinas.mx  ';  
$mihtml .= '                </div>';
$mihtml .= '        </div>';
$mihtml .= '</div>';


$mihtml .= '<div class="headerss">TABLA DE SIGNOS VITALES</div>';
$mihtml .= '<div class="separ"></div>';
$mihtml .= '<div class="sides">';
$mihtml .= '<div class="sidea">';
$mihtml .= '<table class="sesiontable2" id="sesiontable">';
$mihtml .= '<tr>';
$mihtml .= '<th>Fecha:</th>';
$mihtml .= '<td>'.date('Y-m-d').'</td>';
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';
$mihtml .= '<div class="sideb">';
$mihtml .= '<table class="sesiontable2" id="sesiontable">';
$mihtml .= '<tr>';
$mihtml .= '<th>Nombre:</th>';
$mihtml .= '<td class="spacee">'.$inforess['nombre_residente'].'</td>';
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';
$mihtml .= '</div>';
$mihtml .= '<table class="resultTable">';
$mihtml .= '<thead>';
$mihtml .= '<tr>';
    if ($ta)  { 
$mihtml .= '<th class="text-center">Ta</th>';
}  if ($fc) {
$mihtml .= '<th class="text-center">Fc</th>';   
}   if ($fr) {
$mihtml .= '<th class="text-center">Fr</th>';
}   if ($sat) {
$mihtml .= '<th class="text-center">O2</th>';
}   if ($temp) {
$mihtml .= '<th class="text-center">Temp</th>';      
}   if ($gli) {         
$mihtml .= '<th class="text-center">Glicemia</th>';
}   if ($per) {
$mihtml .= '<th class="text-center">% Comida</th>';
}   if ($can) {
$mihtml .= '<th class="text-center">Cant. Liq.</th>';
}   if ($nom) {
$mihtml .= '<th class="text-center">#Micciones</th>';
}   if ($noe) {
$mihtml .= '<th class="text-center">#Evacua</th>';
}   if ($nop) {
$mihtml .= '<th class="text-center">#Pañales</th>';    
}   if ($vis) {               
$mihtml .= '<th class="text-center">Visita</th>';
}   if ($cai) {
$mihtml .= '<th class="text-center">Caida</th>';  
}   if ($dea) {
$mihtml .= '<th class="text-center">Deambulo</th>';
}   if ($ban) {
$mihtml .= '<th class="text-center">Baño</th>';   
}   if ($buc) {
$mihtml .= '<th class="text-center">A. Bucal</th>';
}   if ($ter) {
$mihtml .= '<th class="text-center">T. Fisica</th>';  
}  
$mihtml .= '<th class="text-center">Fecha</th>';  
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '<tbody>';
    $query= $db2->prepare("SELECT * FROM nota_enfermeria WHERE id_residente=:idr AND(fec_notaenfer BETWEEN :fin AND :ffi) ORDER BY fec_notaenfer ASC");
    $query->bindParam(':idr', $idr);
    $query->bindParam(':fin', $q1);
    $query->bindParam(':ffi', $q2);
    $query->execute();  
for($i=0; $row = $query->fetch(); $i++){    
                        $ta2=$row['ta_notaenfer'];
                        $fc2=$row['fc_notaenfer'];
                        $fr2=$row['fr_notaenfer'];
                        $sat2=$row['sat_notaenfer']; 
                        $temp2=$row['temp_notaenfer'];
                        $gli2=$row['gli_notaenfer'];     
                        $fec2=$row['fec_notaenfer'];   
                        $xfec2 = new DateTime($fec2);
                        $xfecenfer2 = $xfec2->format("d-M-Y h:i a");
                        $perce2=$row['percen_ing_notaenfer'];        
                        $cant2=$row['cant_liq_notaenfer'];                                               
                        $nomic2=$row['no_mic_notaenfer'];
                        $noevac2=$row['no_evac_notaenfer'];
                        $nopanal2=$row['no_panal_notaenfer'];
                        $visita2=$row['visita_notaenfer'];
                        $caida2=$row['caida_notaenfer'];
                        $deam2=$row['deam_notaenfer'];
                        $bano2=$row['bano_notaenfer'];
                        $bucal2=$row['bucal_notaenfer'];
                        $terap2=$row['terap_notaenfer'];  

$mihtml .= '<tr>';
if     ($ta)  { 
$mihtml .= '<td>'.$ta2.'</td>';
}  if ($fc) {
$mihtml .= '<td>'.$fc2.'</td>';
}  if ($fr) {
$mihtml .= '<td>'.$fr2.'</td>';
}  if ($sat) {
$mihtml .= '<td>'.$sat2.'</td>';
}  if ($temp) {
$mihtml .= '<td>'.$temp2.'</td>';
}  if ($gli) {
$mihtml .= '<td>'.$gli2.'</td>';         
}  if ($per) {     
$mihtml .= '<td>'.$perce2.'</td>';
}  if ($can) {
$mihtml .= '<td>'.$cant2.'</td>';
}  if ($nom) {
$mihtml .= '<td>'.$nomic2.'</td>';
}  if ($noe) {
$mihtml .= '<td>'.$noevac2.'</td>';
}  if ($nop) {
$mihtml .= '<td>'.$nopanal2.'</td>';
}  if ($vis) {
$mihtml .= '<td>'.$visita2.'</td>';
}  if ($cai) {
$mihtml .= '<td>'.$caida2.'</td>';
}  if ($dea) {
$mihtml .= '<td>'.$deam2.'</td>';
}  if ($ban) {
$mihtml .= '<td>'.$bano2.'</td>';
}  if ($buc) {
$mihtml .= '<td>'.$bucal2.'</td>';
}  if ($ter) {
$mihtml .= '<td>'.$terap2.'</td>';
}
$mihtml .= '<td>'.$xfecenfer2.'</td>';
$mihtml .= '</tr>';          };
$mihtml .= '</tbody>';
$mihtml .= '</table>';


$mihtml .= '</div>';
$mihtml .= '</body>';
$mihtml .= '</html>';
$codigoHTML=utf8_decode(utf8_encode($codigoHTML));
use Dompdf\Dompdf;
$dompdf=new DOMPDF(['chroot' => __DIR__]);
$dompdf->load_html($mihtml);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Signos vitales '.$inforess['nombre_residente'].' del '.$q1.' al '.$q2.'.pdf');
?>