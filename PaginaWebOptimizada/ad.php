<head>
	<title>ADMIN</title>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />     
</head>
<body>
<div class="contenedor">
	<div class="sideboard" id="sideboard">
		<div class="icns blockk" onclick="show('residentes', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">RESIDENTES</div>	
		<div class="icns blockk" onclick="show('farmacia', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">FARMACIA</div>	
		<div class="icns blockk" onclick="show('personal', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">PERSONAL</div>	
		<div class="icns blockk" onclick="show('medico', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">MEDICO</div>
		<div class="icns blockk" onclick="show('enfermeria', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">ENFERMERIA</div>	
		<div class="icns blockk" onclick="show('supervision', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">SUPERVISIÓN</div>	
		<div class="icns blockk" onclick="show('inventario', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">INVENTARIO</div>	
		<div class="icns blockk" onclick="show('economico', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">ECONÓMICO</div>
		<div class="icns blockk" onclick="show('panales', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">PAÑALES</div>			
		<div class="icns blockk" onclick="show('utils', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">UTILERÍAS</div>
		<div class="icns blockk" onclick="show('prospectos', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $_SESSION['id_personal']; ?>')">PROSPECTOS</div>
		<a href="login.php?logout"><div class="icns exit blockk">SALIR</div></a>	
	</div>
	<div class="main" id="main"></div>
</div>
</body>
</html>