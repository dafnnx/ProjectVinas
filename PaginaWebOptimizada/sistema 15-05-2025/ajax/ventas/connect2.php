<?php

$db_host		= 'localhost';

$db_user		= 'connectm_lasvinas';

$db_pass		= 'MSistemax23.';

$db_database	= 'connectm_lasvinas';

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