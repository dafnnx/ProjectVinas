


<?php 
// upload_files.php - Archivo mejorado para la carga
header('Content-Type: application/json');

if (!isset($_FILES['files']) || !isset($_POST['rid']) || !isset($_POST['doc_type']) || !isset($_POST['resident_name'])) {
    echo json_encode(['error' => 'Datos incompletos']);
    exit;
}

$archivos = $_FILES['files'];
$rid = $_POST['rid'];
$doc_type = $_POST['doc_type'];
$resident_name = $_POST['resident_name'];

// Crear directorio del residente si no existe
$directorio = __DIR__ . DIRECTORY_SEPARATOR . $rid;
if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

$uploaded_files = [];
$errors = [];

foreach($archivos['tmp_name'] as $indice => $tmp_name) {
    if ($archivos['error'][$indice] === UPLOAD_ERR_OK) {
        $extension = pathinfo($archivos['name'][$indice], PATHINFO_EXTENSION);
        $timestamp = date('Y-m-d_H-i-s');
        
        // Generar nombre de archivo con formato: NombreResidente_Doc1_2024-01-15_14-30-25.pdf
        $nombre_archivo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $resident_name) . 
                         "_Doc" . $doc_type . 
                         "_" . $timestamp . 
                         "." . $extension;
        
        $ruta_destino = $directorio . DIRECTORY_SEPARATOR . $nombre_archivo;
        
        if (move_uploaded_file($tmp_name, $ruta_destino)) {
            chmod($ruta_destino, 0777);
            
            // Registrar en base de datos
            try {
                require_once("../cn/connect2.php");
                
                $query = $db2->prepare("INSERT INTO documentos_residentes (id_residente, tipo_documento, nombre_archivo, ruta_archivo, fecha_carga, nombre_residente) VALUES (?, ?, ?, ?, NOW(), ?)");
                $query->execute([$rid, $doc_type, $nombre_archivo, $ruta_destino, $resident_name]);
                
                $uploaded_files[] = [
                    'filename' => $nombre_archivo,
                    'doc_type' => $doc_type,
                    'size' => $archivos['size'][$indice],
                    'date' => date('d/m/Y H:i:s')
                ];
            } catch (Exception $e) {
                $errors[] = "Error en base de datos: " . $e->getMessage();
            }
        } else {
            $errors[] = "Error al mover archivo: " . $archivos['name'][$indice];
        }
    } else {
        $errors[] = "Error en archivo: " . $archivos['name'][$indice];
    }
}

echo json_encode([
    'success' => count($uploaded_files) > 0,
    'uploaded_files' => $uploaded_files,
    'errors' => $errors,
    'total_uploaded' => count($uploaded_files)
]);
?>

<?php
// list_files.php - Listado mejorado de archivos
header('Content-Type: application/json');

if (!isset($_POST['rid'])) {
    echo json_encode(['error' => 'ID de residente requerido']);
    exit;
}

$rid = $_POST['rid'];

try {
    require_once("../cn/connect2.php");
    
    // Obtener información del residente
    $query_residente = $db2->prepare("SELECT nombre_residente FROM residentes WHERE id_residente = ?");
    $query_residente->execute([$rid]);
    $residente = $query_residente->fetch(PDO::FETCH_ASSOC);
    
    // Obtener documentos del residente
    $query_docs = $db2->prepare("SELECT * FROM documentos_residentes WHERE id_residente = ? ORDER BY tipo_documento, fecha_carga DESC");
    $query_docs->execute([$rid]);
    $documentos = $query_docs->fetchAll(PDO::FETCH_ASSOC);
    
    // Tipos de documentos
    $tipos_documentos = [
        1 => 'Identificación',
        2 => 'CURP', 
        3 => 'NSS',
        4 => 'Médico',
        5 => 'Ingreso',
        6 => 'Responsable',
        7 => 'Seguro',
        8 => 'Otros'
    ];
    
    $documentos_formateados = [];
    foreach ($documentos as $doc) {
        $documentos_formateados[] = [
            'id' => $doc['id'],
            'tipo' => $doc['tipo_documento'],
            'tipo_nombre' => $tipos_documentos[$doc['tipo_documento']] ?? 'Desconocido',
            'nombre_archivo' => $doc['nombre_archivo'],
            'fecha_carga' => date('d/m/Y H:i', strtotime($doc['fecha_carga'])),
            'size' => file_
/*
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