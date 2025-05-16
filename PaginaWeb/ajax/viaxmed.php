<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM vias ORDER BY nombre_via LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_via = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM vias WHERE nombre_via like :nombre ORDER BY nombre_via LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_via = $stmt->fetchAll();
}

$response = array();

// Leer los datos de MySQL
foreach($lista_via as $pro){
   $response[] = array(
      "id" => $pro['id_via'],
      "text" => $pro['nombre_via']
   );
}

echo json_encode($response);
exit();
?>