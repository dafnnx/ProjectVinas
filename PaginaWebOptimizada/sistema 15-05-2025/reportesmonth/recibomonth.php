<?php /*  $tickk['logo_ticket'] */
$id=$_POST['rid'];
$idpa=$_POST['idpa'];
require_once 'dompdf/autoload.inc.php';
include("functions.php");

$infores= loadres($id);
    foreach ($infores as $inforess):
endforeach;

$infopay= loadpaymonth($idpa);
    foreach ($infopay as $infopayy):
endforeach;
$fecha= $infopayy['fcap_tarifa'];
$sfecha = (explode("T",$fecha));
$dia = $sfecha[0];

$fnmed = new DateTime($dia);
$fenfer = $fnmed->format("d-M-Y");

$nombreImagen = "bgvinas.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));


$mihtml='<!DOCTYPE HTML>';
$mihtml .= '<head>';
$mihtml .= '</head>';
$mihtml .= '<head>';
$mihtml .= '</head>';
$mihtml .= '<body style="font-family: sans-serif;    margin: 0.5cm 0;    text-align: justify;  background: #FFF;   font-size: 13px;">';
$mihtml .= '<div style="width: 95%;  height: 320px;  margin: 0 auto;">';
$mihtml .= '<div style="width: 100%;  height: 100px;  display: flex;">';
$mihtml .= '<div style=" width: 10%;  height: 100%;">';
$mihtml .= '<img src="'.$imagenBase64.'"  width="170" height="90">';
$mihtml .= '</div>';

$mihtml .= '<div style="width: 300px; height: 80px;  margin: 0 auto;">';
$mihtml .= '<div style=" width: 100%;  height: 20px; text-align: center;    color: black;"><strong>CAAM LAS VIÑAS S.A. DE C.V.</strong></div>';
$mihtml .= '<div style=" width: 100%;  height: 20px; text-align: center;    color: black;">Calle Asuncion 331 La Hibernia</div>';
$mihtml .= '<div style=" width: 100%;  height: 20px; text-align: center;    color: black;">Saltillo. Coah. 25297.</div>';
$mihtml .= '<div style=" width: 100%;  height: 20px; text-align: center;    color: black;">Tel: (844)431-0385  Tel: (844)415-2320</div>';
$mihtml .= '</div>';

$mihtml .= '<div style="width: 100px;  float: right;">';
$mihtml .= '<div style="width: 100%;  height: 20px;  text-align: center;  padding: 2px 0px; background-color: gray;  color: white;"><strong>Folio:</strong></div>'; 
$mihtml .= '<div style="width: 100%;  height: 20px;  text-align: center;  padding: 2px 0px;">'.$infopayy['id_tarifa'].'</div>'; 
$mihtml .= '<div style="width: 100%;  height: 20px;  text-align: center;  padding: 2px 0px; background-color: gray;  color: white;"><strong>Fecha de pago:</strong></div>';
$mihtml .= '<div style="width: 100%;  height: 20px;  text-align: center;  padding: 2px 0px;">'.$fenfer.'</div>';
$mihtml .= '</div>';
$mihtml .= '</div>';
$mihtml .= '<div style="b">';
$mihtml .= '<div style="width: 100%;  height: 200px;">';
$mihtml .= '<div style="width: 95%;   height: 20px;  padding-top: 10px;  padding-bottom: 10px;  margin: 0 auto;">';
$mihtml .= '<div style="width: 17%;  height: 20px;  display: inline-block;">  Residente:</div> <div style="width: 82%;  height: 20px;  display: inline-block;  border-bottom: 1px solid gray;">'.$inforess['nombre_residente'].'</div>';
$mihtml .= '</div>';
$mihtml .= '<div style="width: 95%;   height: 20px;  padding-top: 10px;  padding-bottom: 10px;  margin: 0 auto;">';
$mihtml .= '<div style="width: 17%;  height: 20px;  display: inline-block;">  Entrega:</div> <div style="width: 82%;  height: 20px;  display: inline-block;  border-bottom: 1px solid gray;">'.$infopayy['persona_tarifa'].'</div>';
$mihtml .= '</div>';
$mihtml .= '<div style="width: 95%;   height: 20px;  padding-top: 10px;  padding-bottom: 10px;  margin: 0 auto;">';
$mihtml .= '<div style="width: 17%;  height: 20px;  display: inline-block;">  Concepto:</div> <div style="width: 82%;  height: 20px;  display: inline-block; border-bottom: 1px solid gray;">Abono a mensualidad</div>';
$mihtml .= '</div>';
$mihtml .= '<div style="width: 95%;   height: 20px;  padding-top: 10px;  padding-bottom: 10px;  margin: 0 auto;">';
$mihtml .= '<div style="width: 17%;  height: 20px;  display: inline-block;">  Cantidad:</div> <div style="width: 82%;  height: 20px;  display: inline-block; border-bottom: 1px solid gray;">$ '.$infopayy['abono_tarifa'].' Pesos M.N.</div>';
$mihtml .= '</div>';
$mihtml .= '<div style="width: 95%;   height: 20px;  padding-top: 10px;  padding-bottom: 10px;  margin: 0 auto;">';
$mihtml .= '<div style="width: 17%;  height: 20px;  display: inline-block;">  Forma de pago:</div> <div style="width: 82%;  height: 20px;  display: inline-block;  border-bottom: 1px solid gray;">'.$infopayy['fpago_tarifa'].'</div>';
$mihtml .= '</div>';

$mihtml .= '</div>';
$mihtml .= '</div>';
$mihtml .= '</div>';
$mihtml .= '</body>';
$mihtml .= '</html>';
$codigoHTML=utf8_decode(utf8_encode($mihtml));
use Dompdf\Dompdf;
$dompdf=new DOMPDF();
$dompdf->loadHtml($codigoHTML);
$dompdf->setPaper(array(0,0,595.28,341.89), 'portrait');
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents(''.$infopayy['id_tarifa'].'.pdf', $pdf);  
if ($pdf) {  echo "1"; }
?>