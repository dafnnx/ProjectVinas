<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/enfermeria.js"></script>
  <script type="text/javascript" src="js/reps.js"></script>
</head>
<body>
<div class="cntrls">
  <div class="upctrl" >    
      <div class="icnsub pointer padd10 pers" id="enfer_sbtn" onclick="showenfer('<?php echo $uid; ?>')" title="Buscar"></div>
      <div class="icnsub pointer padd10 export" id="export_sbtn" onclick="xportenfer('<?php echo $uid; ?>')" title="Exportar"></div>
      <div class="icnsub pointer padd10 qrscan" id="export_sbtn" onclick="plusqr('<?php echo $uid; ?>')" title="Registrar"></div>
  </div>
  <div class="downctrl">
    <div class="lbl new left" >Buscar</div>  
    <div class="lbl new left" >Reporte</div> 
    <div class="lbl new left" >Registrar</div> 
  </div>
</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes8.php");  }
?>