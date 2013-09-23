
<?php

try
{
	$db = new PDO('mysql:host=localhost;dbname=loic56_bcf', 'loic56', 'yfv306');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage().' or : '.$e->getMessage());
}

?>