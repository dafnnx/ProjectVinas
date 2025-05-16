<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/medico.js"></script>
</head>
<body>
<div class="cntrls">
  <div class="upctrl" >    
      <div class="icnsub pointer padd10 pers" id="medico_sbtn" onclick="showmedi('<?php echo $uid; ?>')" title="Buscar"></div>
  </div>
  <div class="downctrl">
    <div class="lbl new left" >Buscar</div>    
  </div>
</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
include ("modal_help.php");
if ($uid=="1") {  }
else  { require_once ("../quotes7.php");  }
?>