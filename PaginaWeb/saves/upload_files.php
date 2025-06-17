<?php 


$archivos = $_FILES['files']; //esto va a llegar en formato de array, si el name fue files[] 
$rid = $_POST['rid'];
$directorio = __DIR__ . DIRECTORY_SEPARATOR . $rid;

if (!file_exists($directorio)) {
    mkdir($directorio);
}
foreach( $archivos['tmp_name'] as $indice => $tmp_name ){
    $nombre_real = $archivos['name'][$indice];
    move_uploaded_file( $tmp_name, "$rid/$nombre_real" );
    chmod("$rid/$nombre_real", 0777);
}

$contenido = glob( "$rid/*" );
echo json_encode( $contenido );