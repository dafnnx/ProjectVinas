<?php require_once('../cn/connect2.php'); 
function loadres($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM residentes WHERE id_residente=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadexpe($id){
              global $db2;
              $pac = $db2->prepare("SELECT * FROM nota_medica WHERE id_notamed=:id");
              $pac->bindParam(':id', $id);
              $pac->execute();
              return($pac->fetchAll());   }

function loadconcepts($q1, $q2, $idr){
              global $db2;             
              $query= $db2->prepare("SELECT * FROM payconcept WHERE (fecha_pay BETWEEN :fin AND :ffi) AND id_residente=:idr AND status=2");
              $query->bindParam(':fin', $q1);
              $query->bindParam(':ffi', $q2);
              $query->bindParam(':idr', $idr);
              $query->execute();  
              return($query->fetchAll());   }

function loadpay($id){
   global $db2;
   $pac = $db2->prepare("SELECT * FROM payconcept WHERE id_pay=:id");
   $pac->bindParam(':id', $id);
   $pac->execute();
   return($pac->fetchAll());   }

function loadpaymonth($id){
   global $db2;
   $pac = $db2->prepare("SELECT * FROM tarifas WHERE id_tarifa=:id");
   $pac->bindParam(':id', $id);
   $pac->execute();
   return($pac->fetchAll());   }

function loadclient($id){
   global $db2;
   $pac2 = $db2->prepare("SELECT * FROM clientes WHERE id_cliente=:id");
   $pac2->bindParam(':id', $id);
   $pac2->execute();
   return($pac2->fetchAll());   }

function check_ticket(){ 
   global $db2;
   $check_t = $db2->prepare("SELECT * FROM ticket WHERE id_ticket=1");
   $check_t->execute();
   return($check_t->fetchAll()); }
?>