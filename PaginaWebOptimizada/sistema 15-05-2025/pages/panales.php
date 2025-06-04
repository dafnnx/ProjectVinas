<?php $uid= $_POST['uid'];
$perid= $_POST['perid'];
require_once ("../cn/connect2.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="js/panales.js"></script>
</head>
<body>
<div class="cntrls">
 
  <div class="upctrl" >  
  <?php
        $cy= $db2->prepare("SELECT DISTINCT id_edificio AS edifs, nombre_edificio AS nomedifs FROM edificios");
        $cy->execute();
        for($i=0; $row = $cy->fetch(); $i++){ 
          $edifs = $row['edifs'];
          $nomedifs = $row['nomedifs'];  ?>
    <div class="icnsub pointer padd10 edif" onclick="showbuilds('<?php echo $edifs; ?>', '<?php echo $nomedifs; ?>')" title="Edificio"></div>     
  <?php } ?>
  </div>
  
  <div class="downctrl">
  <?php
        $cy= $db2->prepare("SELECT DISTINCT nombre_edificio AS nedifs FROM edificios");
        $cy->execute();
        for($i=0; $row = $cy->fetch(); $i++){ $nedifs = $row['nedifs'];  ?>
    <div class="lbl new left" ><?php echo $nedifs; ?></div>  
  <?php } ?>
  </div>

</div>
  <div class="contmargin" id="contmargin"></div>
</body>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes4.php");  }
?>