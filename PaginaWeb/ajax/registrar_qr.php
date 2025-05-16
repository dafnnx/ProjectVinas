<?php $uid= $_POST['uid']; ?>
<script type="text/javascript" src="js/html5-qrcode.min.js"></script>
<input type="hidden" id="pid" value="<?php echo $uid; ?>">
	<div class="info gral">
			<div class="gralmain">
<div class="ribbon">Registro de visita</div>
  <div class="camsize">
    <div id="qr-reader" style="width:400px"></div>  
  </div>
<div id="qr-reader-results"></div>
<script type="text/javascript" src="js/asistencias.js"></script>