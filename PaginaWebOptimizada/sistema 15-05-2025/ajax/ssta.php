<?php
require_once ("../cn/connect2.php");
$numberofrecords = 10;

if(!isset($_POST['searchTerm'])){
   $stmt = $db2->prepare("SELECT * FROM status ORDER BY nombre_statu LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_ropa = $stmt->fetchAll();

}else{

   $search = $_POST['searchTerm'];// Search text

   // Mostrar resultados
   $stmt = $db2->prepare("SELECT * FROM status WHERE nombre_statu like :nombre ORDER BY nombre_statu LIMIT :limit");
   $stmt->bindValue(':nombre', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_ropa = $stmt->fetchAll();

}

$response = array();

// Leer los datos de MySQL
foreach($lista_ropa as $pro){
   $response[] = array(
      "id" => $pro['id_statu'],
      "text" => $pro['nombre_statu']
   );
}

echo json_encode($response);
exit();
?>