<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM presentaciones ORDER BY nombre_presentacion LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_presentacion = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM presentaciones WHERE nombre_unidad like :nombre ORDER BY nombre_presentacion LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_presentacion = $stmt->fetchAll();
}

$response = array();

// Leer los datos de MySQL
foreach($lista_presentacion as $pro){
   $response[] = array(
      "id" => $pro['id_presentacion'],
      "text" => $pro['nombre_presentacion']
   );
}

echo json_encode($response);
exit();
?>