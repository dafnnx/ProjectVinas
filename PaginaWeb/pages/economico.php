<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/economico.js"></script>
  <script type="text/javascript" src="js/cons.js"></script>
  <script type="text/javascript" src="js/months.js"></script>
  <script type="text/javascript" src="js/reps.js"></script>
  <script type="text/javascript" src="js/presales.js"></script>
</head>
<body>
<div class="cntrls">
  <div class="upctrl" >    
      <div class="icnsub pointer padd10 sea" id="econo_sbtn" onclick="showecono('<?php echo $uid; ?>', '<?php echo $perid; ?>')" title="Residentes"></div>
      <div class="icnsub pointer padd10 sales" id="sales_vbtn" onclick="showpres('<?php echo $uid; ?>')" title="Ventas"></div>
      <div class="icnsub pointer padd10 export" id="export_ebtn" onclick="xport('<?php echo $uid; ?>')" title="Exportar"></div>
  </div>
  <div class="downctrl">
    <div class="lbl new left" >Buscar</div>
    <div class="lbl new left" >Ventas</div> 
    <div class="lbl new left" >Exportar</div>    
  </div>
</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes6.php");  }
?>