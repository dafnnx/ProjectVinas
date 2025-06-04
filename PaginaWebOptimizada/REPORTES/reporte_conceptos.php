<?php
require_once('../cn/connect2.php');
$q1=$_GET['q1'];
$q2=$_GET['q2'];
$idr=$_GET['idr'];

    $sql3 = "SELECT MAX(id_repo) AS idrp FROM repos WHERE id_residente=$idr";
    $sa3 = $db2->prepare($sql3);
    $sa3->execute();
    for($i=0; $row = $sa3->fetch(); $i++)
        {       $idrp = $row['idrp'];       }

    $at = $db2->prepare("SELECT reposi_repo AS rpo,  res_repo AS resrpo FROM repos WHERE id_residente=$idr AND id_repo=$idrp");
    $at->execute();  
    for($i=0; $row = $at->fetch(); $i++){ 
    $rpo=$row['rpo'];
    $resrpo=$row['resrpo'];                    }

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

/*
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
*/

$mihtml .= '</div>';

$mihtml .= '<div class="headerss">ESTADO DE CUENTA</div>';
$mihtml .= '<div class="separ"></div>';
$mihtml .= '<div class="sides">';
$mihtml .= '<div class="sidea">';
$mihtml .= '<table class="sesiontable2" id="sesiontable">';
$mihtml .= '<tr>';
$mihtml .= '<th>Nombre:</th>';
$mihtml .= '<td class="spacee">'.$inforess['nombre_residente'].'</td>';
$mihtml .= '</tr>';
$mihtml .= '<tr>';
/*
$mihtml .= '<th>Edad:</th>';
$mihtml .= '<td>'.$inforess['edad_residente'].'</td>';
*/
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
/*
$mihtml .= '<th>Curp:</th>';
$mihtml .= '<td>'.$inforess['curp_residente'].'</td>';
*/
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';
$mihtml .= '</div>';
$mihtml .= '<div class="headerss">GASTOS</div>';
$mihtml .= '<div class="separ"></div>';
$mihtml .= '<table class="resultTable">';
$mihtml .= '<thead>';
$mihtml .= '<tr>';
$mihtml .= '<th>Fecha</th>';
$mihtml .= '<th>Cant.</th>';
$mihtml .= '<th>F. pago</th>';
$mihtml .= '<th>Concepto</th>';
$mihtml .= '<th>Persona</th>';
$mihtml .= '<th>Debe</th>';
$mihtml .= '<th>Aporta</th>';
$mihtml .= '<th>Saldo</th>';
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '<tbody>';
    $amount = $db2->prepare("SELECT SUM(debe_pay) AS am /*, SUM(iva_pay) AS iv*/ FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND status=2 ORDER BY fecha_pay ASC");
    $amount->bindParam(':fin', $q1);
    $amount->bindParam(':ffi', $q2);
    $amount->bindParam(':idr', $idr);
    $amount->execute();  
for($i=0; $row = $amount->fetch(); $i++){ 
    $subtot=$row['am'];
/*    $iva=$row['iv'];  */                  }
/*    if ($iva) {  $tot= $subtot+$iva;} */
/*   else  { */ $tot=$subtot; /* } */
    $query= $db2->prepare("SELECT * FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND status=2 ORDER BY fecha_pay ASC");
    $query->bindParam(':fin', $q1);
    $query->bindParam(':ffi', $q2);
    $query->bindParam(':idr', $idr);
    $query->execute();  
for($i=0; $row = $query->fetch(); $i++){    
    $idpaa= $row['id_pay'];  
    $fecha=$row['fecha_pay'];
    $concepto=$row['concept_pay'];
    $persona=$row['persona_pay'];
    $qty=$row['cantidad_pay'];  
    $fpago= $row['fpago_pay'];
    $debe=$row['debe_pay'];
    $aporta=$row['aporta_pay'];
    $iva=$row['iva_pay'];   
  /*  if ($iva) { $debeiva=$debe+$iva;    }
    else {  $debeiva=$debe; } 
  */  
    $debeiva=$debe;
    $separar = (explode("T",$fecha));       
    $fec = $separar[0];    
$str="$ ";
    if ($debeiva) { $debefin=$str.number_format( $debeiva, 2);  } else { $debefin="";  } 
    if ($aporta) { $aportafin=$str.number_format($aporta, 2);  } else { $aportafin="";  } 

 $_qery= $db2->prepare("SELECT SUM(debe_pay) AS deb/*,  SUM(iva_pay) AS iv */FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND fecha_pay<=:fecha AND status=2 ORDER BY fecha_pay ASC");
    $_qery->bindParam(':idr', $idr);    
    $_qery->bindParam(':fin', $q1);
    $_qery->bindParam(':ffi', $q2);
    $_qery->bindParam(':fecha', $fecha);
    $_qery->execute();
    for($i=0; $row = $_qery->fetch(); $i++){ 
    /*  $iv = $row['iv']; */
      $deb = $row['deb']; 
   /*   if ($iv) {  $debiv= $deb+$iv;  }
      else {  $debiv=$deb; } */
      }

      $debiv=$deb; 

    $_query= $db2->prepare("SELECT SUM(aporta_pay) AS apo FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND fecha_pay<=:fecha AND status=2 ORDER BY fecha_pay ASC");
    $_query->bindParam(':idr', $idr);
    $_query->bindParam(':fin', $q1);
    $_query->bindParam(':ffi', $q2);
    $_query->bindParam(':fecha', $fecha);
    $_query->execute();
    for($i=0; $row = $_query->fetch(); $i++){  $apo = $row['apo'];  }
      $sal=$apo-$debiv; 
      $gas=$apo-$debiv;
      $totl=$apo+$gas;

$mihtml .= '<tr>';
$mihtml .= '<td>'.$fec.'</td>';
$mihtml .= '<td>'.$qty.'</td>';
$mihtml .= '<td>'.$fpago.'</td>';
$mihtml .= '<td>'.$concepto.'</td>';
$mihtml .= '<td>'.$persona.'</td>';
$mihtml .= '<td>'.$debefin.'</td>';
$mihtml .= '<td>'.$aportafin.'</td>';
$mihtml .= '<td>$'.number_format($sal, 2).'</td>';
$mihtml .= '</tr>';          };
$mihtml .= '</tbody>';
$mihtml .= '</table>';

$mihtml .= '<div class="sidebtots">';
$mihtml .= '<table>';
$mihtml .= '<tr>';
$mihtml .= '<th>Saldo:</th>';
$mihtml .= '<td>'.number_format($gas, 2).'</td>';
$mihtml .= '</tr>';
$mihtml .= '<tr>';
$mihtml .= '<th>Reposición de depósito:</th>';
$mihtml .= '<td>'.number_format($rpo, 2).'</td>';
$mihtml .= '</tr>';
$mihtml .= '<tr>';
$mihtml .= '<th>Total a pagar:</th>';
$mihtml .= '<td>'.number_format($resrpo, 2).'</td>';
$mihtml .= '</tr>';
$mihtml .= '</table>';
$mihtml .= '</div>';


$mihtml .= '</div>';
$mihtml .= '</body>';
$mihtml .= '</html>';
$codigoHTML=utf8_decode(utf8_encode($mihtml));
use Dompdf\Dompdf;
$dompdf=new DOMPDF(['chroot' => __DIR__]);
$dompdf->load_html($codigoHTML);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Edo de cuenta '.$inforess['nombre_residente'].' del '.$q1.' al '.$q2.'.pdf');
?>