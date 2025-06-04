<!DOCTYPE html>
<html>
<?php 
$uid= $_POST['uid'];
$perid= $_POST['perid']; ?>
<script type="text/javascript" src="js/residentes.js"></script>
<script type="text/javascript" src="js/modal.js"></script>
<script type="text/javascript" src="js/age.js"></script>
  <?php include ("nfo1.php"); ?>
    <div class="plusnfo" id="plusnfo">
<div class="info gral">
  <?php include ("nfo2.php");
        include ("nfo3.php");
        include ("nfo4.php"); 
        include ("nfo5.php");   ?>
</div>
    </div>
</html>
<?php
if ($uid=="1") {  }
else  { require_once ("../quotes2.php");  }
?>