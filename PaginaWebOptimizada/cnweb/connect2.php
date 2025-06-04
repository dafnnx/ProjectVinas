<?php
$db_host		= 'localhost';
$db_user		= 'u487852873_reposo';
$db_pass		= 'Master123.';
$db_database	= 'u487852873_reposo';
try 
{
$db2 = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,  PDO::FETCH_ASSOC);
$db2->query('SET NAMES utf8');
}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}

?>