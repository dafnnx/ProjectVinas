<?php
$id=$_GET['id'];
require_once 'dompdf/autoload.inc.php';
include("functions.php");
$sespac= loadpac($id);
    foreach ($sespac as $sespacc):
endforeach;
$codigoHTML.='
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="style/style.css" type="text/css">
<title>CARTA DE CONSENTIMIENTO INFORMADO</title>  
</head>
<body>
<div class="banner"></div>
<div class="separ"></div>
<div class="headerss">CARTA DE CONSENTIMIENTO INFORMADO</div>
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
<p class="tfull"> 
Con fundamento en el reglamento de la ley general de salud en materia de prestaci&oacute;n de servicios de atenci&oacute;n medica art&iacute;culos 79,80,81,82,83 y a la Norma Oficial Mexicana: <strong>NOM 004-SSA3-2012</strong> del expediente cl&iacute;nico y en su ap&eacute;ndice fracci&oacute;n D18 y teniendo en cuenta que: Cuando el egresado sea voluntario, aun y en contra de la recomendaci&oacute;n m&eacute;dica, el paciente tiene derecho a suspender el tratamiento en el momento en el momento que el asi lo decida y para ello debe firmar la presente carta, en materia de prestaci&oacute;n de servicios de atenci&oacute;n medica con la que revelara de cualquier responsabilidad al establecimiento y al m&eacute;dico tratante. Aun y cuando el paciente quiera continuar el tratamiento m&eacute;dico en otro establecimiento para la atenci&oacute;n m&eacute;dica, As&iacute; como tambi&eacute;n si el paciente de acudir a sus citas y por lo tanto abandona el tratamiento, lo informe o no.
<br><br><br><br>
Direcci&oacute;n del establecimiento:_________________________________________________________________________<br><br>
Nombre del paciente:_________________________________________________ Edad:______ Expediente:__________<br><br>
Medidas recomendadas para el alta:<br><br>
______________________________________________________________________________________________________<br><br>
______________________________________________________________________________________________________<br><br>
______________________________________________________________________________________________________<br><br>
______________________________________________________________________________________________________<br><br>
______________________________________________________________________________________________________
</p>

<br><br>
____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________________________<br>
Nombre completo del paciente, familiar o tutor o persona legalmente responsable.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Nombre completo y firma del testigo.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
_____________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________________________<br>Nombre completo y firma del M&eacute;dico Tratante.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre completo y firma del testigo.


<div class="comenta">'.$idexpee['comenta'].'</div>
<div class="firma"></div>
</div>

</body>
</html>';
$codigoHTML=utf8_decode(utf8_encode($codigoHTML));
use Dompdf\Dompdf;
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("egreso_px_$id.pdf");
?>