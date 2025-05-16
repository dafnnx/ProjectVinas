<!DOCTYPE html>
<html>
<?php 
$uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<script type="text/javascript" src="js/prospectos.js"></script>
<script type="text/javascript" src="js/modal.js"></script>
<script type="text/javascript" src="js/age.js"></script>
  <?php include ("nfo1pros.php"); ?>
    <div class="plusnfopros" id="plusnfopros">
<div class="info gral">
  <?php include ("nfo2pros.php");  ?>
</div>
    </div>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes12.php");  }
?>