<?php
include('../cn/connect2.php'); 
$r_id=$_POST['pre_id'];
$userpic=$_POST['files2'];
    $stmt = $db2->prepare('UPDATE ropa_residente SET img_ropa=:upic WHERE id_rresidente=:rid');
    $stmt->bindParam(':rid',$r_id);
    $stmt->bindParam(':upic',$userpic);
    $stmt->execute();