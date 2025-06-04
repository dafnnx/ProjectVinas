<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/farmacia.js"></script>
</head>
<body>
<div class="cntrls">
  <div class="upctrl" >    
      <div class="icnsub pointer padd10 pac" id="mdmedica" onclick="newmedica('<?php echo $uid; ?>')" title="Nuevo medicamento"></div> 
      <div class="icnsub pointer padd10 sea" id="medico_sbtn" onclick="showfcons('<?php echo $uid; ?>')" title="Buscar"></div>
      <div class="icnsub pointer padd10 cendix" id="far_cbtn" onclick="show('caja', '<?php echo $uid; ?>')" title="Ventas farmacia"></div>       
      <div class="icnsub2">
        <div class="icnsub pointer medi" id="far_sbtn" onclick="showx('medicamentos', '<?php echo $uid; ?>')" title="Buscar medicamentos"></div>  
      </div>  
  </div>
  <div class="downctrl">
    <div class="lbl new left">nuevo</div> 
     <div class="lbl new left">Buscar</div>  
    <div class="lbl new left">Caja</div>
    <div class="lbl new2 left">Medicamentos</div> 
  </div>
</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
/*include ("modal_help.php");*/
if ($uid=="1") {  }
else  { require_once ("../quotes3.php");  }
?>