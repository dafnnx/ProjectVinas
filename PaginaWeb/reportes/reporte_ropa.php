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

$mihtml .= '<div class="headerss">LISTADO DE ENSERES</div>';
$mihtml .= '<div class="separ"></div>';
$mihtml .= '<div class="sides">';
$mihtml .= '<div class="sidea">';
$mihtml .= '<table class="sesiontable2" id="sesiontable">';
$mihtml .= '<tr>';
$mihtml .= '<th>Nombre:</th>';
$mihtml .= '<td class="spacee">'.$inforess['nombre_residente'].'</td>';  
$mihtml .= '</tr>';
$mihtml .= '<tr>';
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';
$mihtml .= '<div class="sideb">';
$mihtml .= '<table class="sesiontable2" id="sesiontable">';
$mihtml .= '<tr>';
$mihtml .= '<th>Fecha:</th>';
$mihtml .= '<td>'.date('Y-m-d').'</td>';
$mihtml .= '</tr>';
$mihtml .= '<tr>';
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';
$mihtml .= '</div>';
$mihtml .= '<table class="resultTable">';
$mihtml .= '<thead>';
$mihtml .= '<tr>';
$mihtml .= '<th>Nombre</th>';
$mihtml .= '<th>Talla</th>';
$mihtml .= '<th>Marca</th>';
$mihtml .= '<th>Color</th>';
$mihtml .= '<th>Observaciones</th>';
$mihtml .= '<th>Ingreso</th>';
$mihtml .= '<th>Condición</th>';
$mihtml .= '<th>Status</th>';
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '<tbody>';

    $sql = "SELECT * FROM ropa_residente WHERE id_residente=$idr";
    $sa4 = $db2->prepare($sql);
    $sa4->execute();
    for($i=0; $row = $sa4->fetch(); $i++) { 

     $nombre = $row['nombre_ropa'];
     $talla = $row['talla_ropa']; 
     $color = $row['color_ropa']; 
     $marca = $row['marca_ropa']; 
     $observa = $row['observa_ropa']; 
     $ingreso = $row['ingreso_ropa']; 
     $estado = $row['estado_ropa']; 
     $status = $row['status_ropa'];  

$mihtml .= '<tr>';
$mihtml .= '<td>'.$nombre.'</td>';
$mihtml .= '<td>'.$talla.'</td>';
$mihtml .= '<td>'.$marca.'</td>';
$mihtml .= '<td><div class="muestra_color" style="background-color: '.$color.';"></div></td>';
$mihtml .= '<td>'.$observa.'</td>';
$mihtml .= '<td>'.$ingreso.'</td>';
$mihtml .= '<td>'.$estado.'</td>';
$mihtml .= '<td>'.$status.'</td>';
$mihtml .= '</tr>';     }     ;
$mihtml .= '</tbody>';
$mihtml .= '</table>';

$mihtml .= '</div>';
$mihtml .= '</body>';
$mihtml .= '</html>';
$codigoHTML=utf8_decode(utf8_encode($codigoHTML));
use Dompdf\Dompdf;
$dompdf=new DOMPDF(['chroot' => __DIR__]);
$dompdf->load_html($mihtml);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Listado de enseres '.$inforess['nombre_residente'].'.pdf');
?>