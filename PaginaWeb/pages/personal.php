<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; 
require_once ("../cn/connect2.php");
$cy= $db2->prepare("SELECT count(*) AS act FROM personal WHERE status_personal=1");
$cy->execute();
  for($i=0; $row = $cy->fetch(); $i++){ $act = $row['act'];  }
$cb= $db2->prepare("SELECT count(*) AS baj FROM personal WHERE status_personal=2");
$cb->execute();
  for($i=0; $row = $cb->fetch(); $i++){ $baj = $row['baj'];  }?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/personal.js"></script>
  <script type="text/javascript" src="js/age.js"></script>
</head>
<body>
<div class="cntrls">
  <div class="upctrl" >    
      <div class="icnsub pointer padd10 ppers" id="per_nbtn" onclick="newpersonal('<?php echo $uid; ?>')" title="Altas"></div> 
      <div class="icnsub pointer padd10 sea" id="per_sbtn" onclick="showpersonal('<?php echo $uid; ?>')" title="Personal"></div>
      <div class="icnsub2">
        <div class="icnsub lbl textcenter" title="Total">Activos<br><?php echo $act; ?></div>
        <div class="icnsub lbl textcenter pointer" title="Bajas" id="res_bajas" onclick="showperbajas('<?php echo $uid; ?>')">Bajas<br><?php echo $baj; ?></div>
      </div>
  </div>
  <div class="downctrl">
    <div class="lbl new left" >Nuevo</div>  
    <div class="lbl new left" >Buscar</div>   
    <div class="lbl new2 left">Información</div> 
  </div>
</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes4.php");  }
?>