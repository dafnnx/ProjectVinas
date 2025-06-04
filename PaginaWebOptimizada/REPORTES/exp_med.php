<?php
$idr=$_GET['idr'];
$idn=$_GET['idn'];
require_once 'dompdf/autoload.inc.php';
include("functions.php");
$infores= loadres($idr);
    foreach ($infores as $inforess):
endforeach;
 $idexpe= loadexpe($idn);
        foreach ($idexpe as $idexpee):
        endforeach; 
        
$idmed=$idexpee['id_medic'];
$iduser=$idexpee['id_usuario'];

$nt = $db2->prepare("SELECT area_personal AS areap, nombre_personal AS nomper, cedula_personal AS cedper FROM personal WHERE id_personal=(SELECT id_personal AS idp FROM users WHERE user_id=:iduser)");
$nt->bindParam(':iduser', $iduser);
$nt->execute();  
for($i=0; $row = $nt->fetch(); $i++){ 
    $nomper=$row['nomper'];
    $cedper=$row['cedper'];
    $areap=$row['areap'];                 }

    $amount = $db2->prepare("SELECT * FROM medics WHERE id_medic=:idmed");
    $amount->bindParam(':idmed', $idmed);
    $amount->execute();  
for($i=0; $row = $amount->fetch(); $i++){ 
    $nom=$row['nom_medic'];
    $ced=$row['ced_medic'];                    }

if ($areap!=="Medico") {
    $nomfin= $nom;
    $cedfin= $ced;
}
else{
    $nomfin= $nomper;
    $cedfin= $cedper;
}

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
      <th>Fecha:</th>
      <td>'.$idexpee['fec_notamed'].'</td>
        </tr>
</table>
</div>
</div>
<div class="antes">
<div class="headerss">MOTIVO DE LA CONSULTA</div>
<div class="pet5">'.str_replace("\n", "<br>", $idexpee['motivo_notamed']).'</div>
<div class="headerss">EXPLORACIÓN</div>
<div class="pet3">'.str_replace("\n", "<br>", $idexpee['explo_notamed']).'</div>
<div class="headerss">SIGNOS VITALES</div>
<div class="pet6">
    <table>
     <tr>
      <td>TA:</td><td><input type="text" class="nputs w50" name="ta_notamed" value='.str_replace("\n", "<br>", $idexpee['ta_notamed']).'></td>
      <td>FC:</td><td><input type="text" class="nputs w50" name="fc_notamed" value='.str_replace("\n", "<br>", $idexpee['fc_notamed']).'></td>
      <td>FR:</td><td><input type="text" class="nputs w50" name="fr_notamed" value='.str_replace("\n", "<br>", $idexpee['fr_notamed']).'></td>
      <td>SAT O2:</td><td><input type="text" class="nputs w50" name="sat_notamed" value='.str_replace("\n", "<br>", $idexpee['sat_notamed']).'></td>
      <td>TEMPERATURA:</td><td><input type="text" class="nputs w50" name="temp_notamed" value='.str_replace("\n", "<br>", $idexpee['temp_notamed']).'></td>
      <td>GLICEMIA:</td><td><input type="text" class="nputs w50" name="gli_notamed" value='.str_replace("\n", "<br>", $idexpee['gli_notamed']).'></td>
     </tr>
    </table>
</div>
<div class="headerss">NOTA MEDICA:</div>
<div class="diagnos">   
  '.$idexpee['notmed_notamed'].'
</div>
<div class="headerss">TRATAMIENTO:</div>
<div class="plan">
  '.$idexpee['trata_notamed'].'
</div>
<div class="headerss">COMENTARIOS:</div>
<div class="pet3">'.$idexpee['comenta'].'</div>
<div class="infoo">________________________________________________</div>
<div class="infoo2">Médico: '.$nomfin.'</div>
<div class="infoo2">Cédula: '.$cedfin.'</div>
</div>
</body>
</html>';
$codigoHTML=utf8_decode(utf8_encode($codigoHTML));
use Dompdf\Dompdf;
$dompdf=new DOMPDF(['chroot' => __DIR__]);
$dompdf->load_html($codigoHTML);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Nota medica '.$inforess['nombre_residente'].'.pdf');
?>

<?php
function edad($fecha_nacimiento)  {
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y"); }
 ?>