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

    $sql3 = "SELECT DISTINCT(rr.id_rresidente) AS idrr FROM ropa_residente rr LEFT JOIN armario a ON rr.id_armario = a.id_armario WHERE a.id_residente=$idr";
    $sa3 = $db2->prepare($sql3);
    $sa3->execute();
    for($i=0; $row = $sa3->fetch(); $i++) {      
     $idrr = $row['idrr'];  

    $sql = "SELECT * FROM ropa_residente WHERE id_rresidente=$idrr";
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

$mihtml .= '<tr>';
    $sqlnr = "SELECT nombre_ropa AS nropa FROM ropa WHERE id_ropa=$nombre";
    $sanr = $db2->prepare($sqlnr);
    $sanr->execute();
    for($i=0; $row = $sanr->fetch(); $i++) { 
        $nropa=$row['nropa'];
$mihtml .= '<td>'.$nropa.'</td>';
                            }
    $sqlnt = "SELECT nombre_talla AS ntalla FROM tallas WHERE id_talla=$talla";
    $sant = $db2->prepare($sqlnt);
    $sant->execute();
    for($i=0; $row = $sant->fetch(); $i++) { 
        $ntalla=$row['ntalla'];
$mihtml .= '<td>'.$ntalla.'</td>';
                            }
    $sqlnm = "SELECT nombre_mmarca AS nmarca FROM mmarcas WHERE id_mmarca=$marca";
    $sanm = $db2->prepare($sqlnm);
    $sanm->execute();
    for($i=0; $row = $sanm->fetch(); $i++) { 
        $nmarca=$row['nmarca'];
$mihtml .= '<td>'.$nmarca.'</td>';
                            }
$mihtml .= '<td><div class="muestra_color" style="background-color: '.$color.';"></div></td>';
$mihtml .= '<td>'.$observa.'</td>';
$mihtml .= '<td>'.$ingreso.'</td>';
$mihtml .= '<td>'.$estado.'</td>';

    $sqlrst = "SELECT status_ropastatus AS rsta FROM hist_ropastatus WHERE id_rresidente=$idrr ORDER BY id_ropastatus DESC LIMIT 1";
    $sasta = $db2->prepare($sqlrst);
    $sasta->execute();
    for($i=0; $row = $sasta->fetch(); $i++) { 
        $rsta=$row['rsta'];
$mihtml .= '<td>'.$rsta.'</td>';
                        }

$mihtml .= '</tr>';     }     };
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