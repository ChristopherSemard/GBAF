<?php

include_once('./sql/db-connection.php');

$secretQuestions = ['Dans quelle ville êtes-vous né ?', 'Quel est votre film favori ?', 'Quelle est la marque de votre première voiture ?','Quelle est votre couleur favorite ?'];

// Récupération des utilisateurs à l'aide du client MySQL
$usersStatement = $bdd->prepare('SELECT * FROM users');
$usersStatement->setFetchMode(PDO::FETCH_ASSOC);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

// Récupération des utilisateurs à l'aide du client MySQL
$commentsStatement = $bdd->prepare('SELECT * FROM comments');
$commentsStatement->setFetchMode(PDO::FETCH_ASSOC);
$commentsStatement->execute();
$comments = $commentsStatement->fetchAll();