<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/supervision.js"></script>
  <link href="css/multiselect.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>
<div class="cntrls">
  <div class="upctrl" >    
      <div class="icnsub pointer padd10 pac" id="super_sbtn" onclick="showsuper('<?php echo $uid; ?>')" title="Buscar"></div>
      <div class="icnsub pointer padd10 sea" id="super_hbtn" title="Historial" onclick="showshist('<?php echo $uid; ?>')"></div>
      <div class="icnsub pointer padd10 not" id="super_nbtn" title="Nota" onclick="newnote('<?php echo $uid; ?>', (loadnote()))"></div>
  </div>
  <div class="downctrl">
    <div class="lbl new left">Capturar</div>  
    <div class="lbl new left">Historial</div>
    <div class="lbl new left">Nota</div>
  </div>
</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes9.php");  }
?>