<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/inventario.js"></script>
  <link href="css/multiselect.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>
<div class="cntrls">
  <div class="upctrl" >    
      <div class="icnsub pointer padd10 sea" title="Historial" id="inve_sbtn" onclick="showsinve('<?php echo $uid; ?>')"></div>
  </div>
  <div class="downctrl"> 
    <div class="lbl new left">Historial</div>
  </div>
</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes10.php");  }
?>