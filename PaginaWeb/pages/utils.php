<?php $uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<div class="info gral">
  <div class="ribbon">EDIFICIOS ALTAS<div class="colap rig" onclick="toggle('edifsw')">&#x2630</div></div>
    <div class="gralmid" id="edifsw">
        <div class="ediclass" id="utilsup">
		<?php include ("edificios.php"); ?>
        </div>
  	</div>
</div>
<div class="info gral">
  <div class="ribbon">GENERALES<div class="colap rig" onclick="toggle('varssw')">&#x2630</div></div>
    <div class="gralmid" id="varssw">
      <div class="ediclass padd10">
    <?php include ("vargen.php"); ?>
    </div>
  </div>
</div>
<div class="info gral">
  <div class="ribbon">MEDICAMENTOS<div class="colap rig" onclick="toggle('varsmed')">&#x2630</div></div>
    <div class="gralmid" id="varsmed">
      <div class="ediclass padd10">
    <?php include ("varmeds.php"); ?>
    </div>
  </div>
</div>
<div class="info gral">
  <div class="ribbon">PERSONAL<div class="colap rig" onclick="toggle('varspers')">&#x2630</div></div>
    <div class="gralmid" id="varspers">
      <div class="ediclass padd10">
    <?php include ("varpers.php"); ?>
    </div>
  </div>
</div>
<div class="info gral">
  <div class="ribbon">ENSERES<div class="colap rig" onclick="toggle('varsens')">&#x2630</div></div>
    <div class="gralmid" id="varsens">
      <div class="ediclass padd10">
    <?php include ("varens.php"); ?>
    </div>
  </div>
</div>
<div class="info gral">
  <div class="ribbon">RESIDENTES<div class="colap rig" onclick="toggle('varresi')">&#x2630</div></div>
    <div class="gralmid" id="varresi">
      <div class="ediclass padd10">
    <?php include ("varres.php"); ?>
    </div>
  </div>
</div>
<div class="info gral">
  <div class="ribbon">ECONOMICO<div class="colap rig" onclick="toggle('varecon')">&#x2630</div></div>
    <div class="gralmid" id="varecon">
      <div class="ediclass padd10">
    <?php include ("varecon.php"); ?>
    </div>
  </div>
</div>
<div class="info gral">
  <div class="ribbon">MEDICOS<div class="colap rig" onclick="toggle('varmedics')">&#x2630</div></div>
    <div class="gralmid" id="varmedics">
      <div class="ediclass padd10">
    <?php include ("varmedics.php"); ?>
    </div>
  </div>
</div>
<div class="info gral">
  <div class="ribbon">CAMAS<div class="colap rig" onclick="toggle('varbeds')">&#x2630</div></div>
    <div class="gralmid" id="varbeds">
      <div class="ediclasx padd10">
    <?php include ("varbeds.php"); ?>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/generatecode.js"></script>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes5.php");  }
?>