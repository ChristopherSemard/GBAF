<?php
// Test de connexion
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', ''); 
}
// Gestion des erreurs
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>