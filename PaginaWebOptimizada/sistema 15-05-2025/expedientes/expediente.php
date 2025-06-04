<?php
$id=$_GET['id'];
require_once 'dompdf/autoload.inc.php';
include("functions.php");
$sespac= loadpac($id);
    foreach ($sespac as $sespacc):
endforeach;
 $idexpe= loadexpe($id);
        foreach ($idexpe as $idexpee):
        endforeach;
$codigoHTML.='
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="style/style.css" type="text/css">
<title>Expediente</title>  
</head>
<body>
<div class="banner"></div>
<div class="separ"></div>
<div class="headerss">RESUMEN CLINICO</div>
<div class="sides">
<div class="sidea">
<table class="sesiontable2" id="sesiontable">
        <tr>
      <th>Nombre:</th>
      <td><input type="text" class="pacta" name="nombre">'.$sespacc['nombre_paciente'].'</td>
        </tr>
        <tr>
      <th>Edad:</th>
      <td><input type="text" class="pacta" name="edad">'.$sespacc['edad_paciente'].'</td>
        </tr>
        <tr>
      <th>Registro:</th>
      <td><input type="text" class="pacta" name="registro">'.$sespacc['ingreso_paciente'].'</td>
        </tr>
        <tr>
      <th>Genero:</th>
      <td><input type="text" class="pacta" name="genero">'.$sespacc['sexo_paciente'].'</td>
        </tr>
         <tr>
      <th>fecha:</th>
      <td><input type="text" class="pacta" name="fecha">'.date("d/m/Y g:i:sa").'</td>
        </tr>
</table>
</div>
<div class="sideb">
<table class="sesiontable2" id="sesiontable">
        <tr>
      <th>R.F.C.:</th>
      <td><input type="text" class="pacta" name="rfc">'.$sespacc['rfc_paciente'].'</td>
        </tr>
        <tr>
      <th>Direccion:</th>
      <td><input type="text" class="pacta" name="direccion">'.$sespacc['calle_paciente'].'</td>
        </tr>
        <tr>
      <th>C.P.:</th>
      <td><input type="text" class="pacta" name="cp">'.$sespacc['cp_paciente'].'</td>
        </tr>
        <tr>
      <th>E-mail:</th>
      <td><input type="text" class="pacta" name="mail">'.$sespacc['email_paciente'].'</td>
        </tr>
         <tr>
      <th>Telefono:</th>
      <td><input type="text" class="pacta" name="telefono">'.$sespacc['tel_paciente'].'</td>
        </tr>
</table>
</div>
</div>
<div class="belt">
<div class="beltl">
<div class="belta">ANTECEDENTES<br>HEREDO FAMILIARES</div>
<div class="beltb">ANTECEDENTES<br>NO PATOLOGICOS</div>
</div>
<div class="beltr">
<div class="beltc">ANTECEDENTES<br>PATOLOGICOS</div>
<div class="beltd">ANTECEDENTES<br>GINECO OBSTETRICOS</div>
</div>
</div>
<div class="antes">
<div class="antecede">
<div class="sidec">
<table class="sesiontable3" id="sesiontable">
        <tr>
      <th>DM:</th>
      <td><input type="text" class="pacta" name="dm">'.$sespacc['dm_paciente'].'</td>
        </tr>
        <tr>
      <th>HTA:</th>
      <td><input type="text" class="pacta" name="hta">'.$sespacc['hta_paciente'].'</td>
        </tr>
        <tr>
      <th>Oncologicos:</th>
      <td><input type="text" class="pacta" name="onco">'.$sespacc['cancer_paciente'].'</td>
        </tr>
        <tr>
      <th>Corazon:</th>
      <td><input type="text" class="pacta" name="cora">'.$sespacc['cora_paciente'].'</td>
        </tr>
         <tr>
      <th>Otros:</th>
      <td><input type="text" class="pacta" name="otros">'.$sespacc['otros_paciente'].'</td>
        </tr>
</table>
</div>
<div class="sided">
<table class="sesiontable3" id="sesiontable">
        <tr>
      <th>Tabaquismo:</th>
      <td><input type="text" class="pacta" name="tab">'.$sespacc['tabaco_paciente'].'</td>
        </tr>
        <tr>
      <th>Etilismo:</th>
      <td><input type="text" class="pacta" name="etil">'.$sespacc['etil_paciente'].'</td>
        </tr>
        <tr>
      <th>Quirurgicos:</th>
      <td><input type="text" class="pacta" name="quiru">'.$sespacc['quir_paciente'].'</td>
        </tr>
</table>
</div>
</div>
<div class="antecede2">
<div class="sidee">
<table class="sesiontable3" id="sesiontable">
        <tr>
      <th>DM:</th>
      <td><input type="text" class="pacta" name="dm2">'.$sespacc['dmp_paciente'].'</td>
        </tr>
        <tr>
      <th>HTA:</th>
      <td><input type="text" class="pacta" name="hta2">'.$sespacc['htap_paciente'].'</td>
        </tr>
        <tr>
      <th>IRC:</th>
      <td><input type="text" class="pacta" name="irc">'.$sespacc['ircp_paciente'].'</td>
        </tr>
         <tr>
      <th>Corazon:</th>
      <td><input type="text" class="pacta" name="cora2">'.$sespacc['corap_paciente'].'</td>
        </tr>
        <tr>
      <th>Alergias:</th>
      <td><input type="text" class="pacta" name="aler">'.$sespacc['alergias_paciente'].'</td>
        </tr>
</table>
</div>
<div class="sidef">
<table class="sesiontable3" id="sesiontable">
        <tr>
      <th>Menarquia:</th>
      <td><input type="text" class="pacta" name="menar">'.$sespacc['mena_paciente'].'</td>
        </tr>
        <tr>
      <th>IVSA:</th>
      <td><input type="text" class="pacta" name="ivsa">'.$sespacc['ivsa_paciente'].'</td>
        </tr>
        <tr>
      <th>Partos:</th>
      <td><input type="text" class="pacta" name="parto">'.$sespacc['parto_paciente'].'</td>
        </tr>
        <tr>
      <th>Abortos:</th>
      <td><input type="text" class="pacta" name="aborto">'.$sespacc['aborto_paciente'].'</td>
        </tr>
        <tr>
        <th>Cesarea:</th>
      <td><input type="text" class="pacta" name="cesa">'.$sespacc['cesa_paciente'].'</td>
        </tr>
        <tr>
        <th>Gestas:</th>
      <td><input type="text" class="pacta" name="gestas">'.$sespacc['gestas_paciente'].'</td>
        </tr>
</table>
</div>
</div>
<div class="headerss">P.E.T. Y E.A.</div>
<div class="pet">'.str_replace("\n", "<br>", $idexpee['pet']).'</div>
<div class="headerss">EXPLORACI&Oacute;N F&Iacute;SICA</div>
<div class="pet2">'.str_replace("\n", "<br>", $idexpee['explo']).'</div>
<div class="headerss">DIAGNOSTICO:</div>
<div class="diagnos">
<table class="diags" id="sesiontable">
        <tr>
      <th>1:</th>
      <td><input type="text" class="pacta" name="tab">'.$idexpee['d1'].'</td>
        </tr>
        <tr>
      <th>2:</th>
      <td><input type="text" class="pacta" name="etil">'.$idexpee['d2'].'</td>
        </tr>
        <tr>
      <th>3:</th>
      <td><input type="text" class="pacta" name="quiru">'.$idexpee['d3'].'</td>
        </tr>
        <tr>
      <th>4:</th>
      <td><input type="text" class="pacta" name="quiru">'.$idexpee['d4'].'</td>
        </tr>
</table>
</div>
<div class="headerss">PLAN:</div>
<div class="diagnos">
<table class="diags" id="sesiontable">
         <tr>
      <th>1:</th>
      <td><input type="text" class="pacta" name="tab">'.$idexpee['p1'].'</td>
        </tr>
        <tr>
      <th>2:</th>
      <td><input type="text" class="pacta" name="etil">'.$idexpee['p2'].'</td>
        </tr>
        <tr>
      <th>3:</th>
      <td><input type="text" class="pacta" name="quiru">'.$idexpee['p3'].'</td>
        </tr>
        <tr>
      <th>4:</th>
      <td><input type="text" class="pacta" name="quiru">'.$idexpee['p4'].'</td>
        </tr>
</table>
</div>
<div class="headerss">COMENTARIOS:</div>
<div class="comenta">'.$idexpee['comenta'].'</div>
<div class="infoo">________________________________________________</div>
<div class="infoo2">'.$idexpee['dr'].'</div>
<div class="infoo2">'.$idexpee['dr2'].'</div>
<div class="infoo2">'.$idexpee['dr3'].'</div>
</div>

</body>
</html>';
$codigoHTML=utf8_decode(utf8_encode($codigoHTML));
use Dompdf\Dompdf;
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("expediente_pac.pdf");
?>