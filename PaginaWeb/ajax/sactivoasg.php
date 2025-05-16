<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM activos ORDER BY nombre_activo LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_activo = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM activos WHERE nombre_activo like :nombre ORDER BY nombre_activo LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_activo = $stmt->fetchAll();
}

$response = array();

// Leer los datos de MySQL
foreach($lista_activo as $pro){
   $response[] = array(
      "id" => $pro['id_activo'],
      "text" => $pro['nombre_activo']
   );
}

echo json_encode($response);
exit();
?>