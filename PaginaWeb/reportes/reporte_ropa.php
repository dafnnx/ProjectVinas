<?php
require_once('../cn/connect2.php');
$idr=$_GET['idr'];

require_once 'dompdf/autoload.inc.php';
include("functions.php");
$infores= loadres($idr);
    foreach ($infores as $inforess):
endforeach;

// Función para generar el encabezado
function generarEncabezado($inforess, $titulo) {
    $header = '<!DOCTYPE HTML>';
    $header .= '<head>';
    $header .= '<link rel="stylesheet" href="style.css" type="text/css" />';
    $header .= '</head>';
    $header .= '<body>';
    $header .= '<br>';
    
    $header .= '<div class="bannerhub">';
    $header .= '                    <div class="imgblock">';
    $header .= '                       <img src="img/bgvinas.png"  width="170" height="90">';
    $header .= '                    </div>';
    $header .= '</div>';
    
    $header .= '<div class="headerss">' . $titulo . '</div>';
    $header .= '<div class="separ"></div>';
    $header .= '<div class="sides">';
    $header .= '<div class="sidea">';
    $header .= '<table class="sesiontable2" id="sesiontable">';
    $header .= '<tr>';
    $header .= '<th>Nombre:</th>';
    $header .= '<td class="spacee">'.$inforess['nombre_residente'].'</td>';  
    $header .= '</tr>';
    $header .= '<tr>';
    $header .= '</tr>';
    $header .= '</table>';
    $header .= '</div>';
    $header .= '<div class="sideb">';
    $header .= '<table class="sesiontable2" id="sesiontable">';
    $header .= '<tr>';
    $header .= '<th>Fecha:</th>';
    $header .= '<td>'.date('Y-m-d').'</td>';
    $header .= '</tr>';
    $header .= '<tr>';
    $header .= '</tr>';
    $header .= '</table>';
    $header .= '</div>';
    $header .= '</div>';
    
    return $header;
}

// Función para generar la tabla
function generarTabla($registros, $tipo) {
    $tabla = '<table class="resultTable">';
    $tabla .= '<thead>';
    $tabla .= '<tr>';
    $tabla .= '<th>Nombre</th>';
    $tabla .= '<th>Talla</th>';
    $tabla .= '<th>Marca</th>';
    $tabla .= '<th>Color</th>';
    $tabla .= '<th>Observaciones</th>';

    // Título dinámico según el tipo
    if (strtolower($tipo) === 'activo') {
        $tabla .= '<th>Fecha de Ingreso</th>';
    } else {
        $tabla .= '<th>Fecha de Baja</th>';
    }

    $tabla .= '<th>Status</th>';
    $tabla .= '</tr>';
    $tabla .= '</thead>';
    $tabla .= '<tbody>';

    foreach($registros as $row) {
        $nombre = $row['nombre_ropa'];
        $talla = $row['talla_ropa']; 
        $color = $row['color_ropa']; 
        $marca = $row['marca_ropa']; 
        $observa = $row['observa_ropa']; 
        $ingreso = $row['ingreso_ropa']; 
        $status = $row['status_ropa'];  

        $tabla .= '<tr>';
        $tabla .= '<td>'.$nombre.'</td>';
        $tabla .= '<td>'.$talla.'</td>';
        $tabla .= '<td>'.$marca.'</td>';
        $tabla .= '<td><div class="muestra_color" style="background-color: '.$color.';"></div></td>';
        $tabla .= '<td>'.$observa.'</td>';
        $tabla .= '<td>'.$ingreso.'</td>';  // mismo campo, sin importar si es ingreso o baja
        $tabla .= '<td>'.$status.'</td>';
        $tabla .= '</tr>';
    }

    $tabla .= '</tbody>';
    $tabla .= '</table>';

    return $tabla;
}


// Obtener todos los registros y separarlos por status
$sql = "SELECT * FROM ropa_residente WHERE id_residente=$idr ORDER BY status_ropa, nombre_ropa";
$sa4 = $db2->prepare($sql);
$sa4->execute();

$activos = array();
$bajas = array();

while($row = $sa4->fetch()) { 
    if(strtoupper($row['status_ropa']) == 'ACTIVO' || strtoupper($row['status_ropa']) == 'ACTIVE') {
        $activos[] = $row;
    } else {
        $bajas[] = $row;
    }
}

// Construir el HTML completo
$mihtml = '';

// Sección de ACTIVOS
if(count($activos) > 0) {
    $mihtml .= generarEncabezado($inforess, 'LISTADO DE ENSERES - ACTIVOS');
    $mihtml .= generarTabla($activos, 'activo');
    $mihtml .= '</div>';
    $mihtml .= '</body>';
}

// Sección de BAJAS
if(count($bajas) > 0) {
    if(count($activos) > 0) {
        $mihtml .= '<div style="page-break-before: always;"></div>';
    }

    $mihtml .= generarEncabezado($inforess, 'LISTADO DE ENSERES - BAJAS');
    $mihtml .= generarTabla($bajas, 'baja');
    $mihtml .= '</div>';
    $mihtml .= '</body>';
}


// Si no hay registros de ningún tipo
if(count($activos) == 0 && count($bajas) == 0) {
    $mihtml .= generarEncabezado($inforess, 'LISTADO DE ENSERES');
    $mihtml .= '<p>No se encontraron registros para este residente.</p>';
    $mihtml .= '</div>';
    $mihtml .= '</body>';
}

$mihtml .= '</html>';

// Generar PDF
use Dompdf\Dompdf;
$dompdf=new DOMPDF(['chroot' => __DIR__]);
$dompdf->load_html($mihtml);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Listado de enseres '.$inforess['nombre_residente'].'.pdf');
?>