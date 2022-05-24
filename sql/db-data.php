<?php

include_once('./sql/db-connection.php');

// Questions secrètes
$secretQuestions = ['Dans quelle ville êtes-vous né ?', 'Quel est votre film favori ?', 'Quelle est la marque de votre première voiture ?','Quelle est votre couleur favorite ?'];

// Récupération des utilisateurs à l'aide du client MySQL
$usersStatement = $bdd->prepare('SELECT * FROM users');
$usersStatement->setFetchMode(PDO::FETCH_ASSOC);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

// Récupération des utilisateurs à l'aide du client MySQL
$partnersStatement = $bdd->prepare('SELECT *, SUBSTRING(description, 1, 100) as excerpt FROM partners');
$partnersStatement->setFetchMode(PDO::FETCH_ASSOC);
$partnersStatement->execute();
$partners = $partnersStatement->fetchAll();

