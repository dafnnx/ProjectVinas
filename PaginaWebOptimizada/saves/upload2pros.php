<?php
include('../cn/connect2.php'); 
$r_id=$_POST['pro_id'];
$userpic=$_POST['files2'];
                    $stmt = $db2->prepare('UPDATE prospectos SET img_prospecto=:upic WHERE id_prospecto=:rid');
                    $stmt->bindParam(':rid',$r_id);
                    $stmt->bindParam(':upic',$userpic);
                    $stmt->execute();