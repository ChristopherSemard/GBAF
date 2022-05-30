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
$partnersStatement = $bdd->prepare('SELECT *, SUBSTRING(description, 1, 150) as excerpt FROM partners');
$partnersStatement->setFetchMode(PDO::FETCH_ASSOC);
$partnersStatement->execute();
$partners = $partnersStatement->fetchAll();

function getVotes($id_partner, $bdd){
    // Récupération des votes sur les articles à l'aide du client MySQL
    $votesStatement = $bdd->prepare('SELECT * FROM votes WHERE id_partner = :id_partner');
    $votesStatement->setFetchMode(PDO::FETCH_ASSOC);
    $votesStatement->execute(['id_partner' => $id_partner]);
    return $votesStatement->fetchAll();
}

function getVotesScore($id_partner, $bdd){
    // Récupération des votes sur les articles à l'aide du client MySQL
    $votesStatement = $bdd->prepare('SELECT *, SUM(vote) as score FROM votes WHERE id_partner = :id_partner');
    $votesStatement->setFetchMode(PDO::FETCH_ASSOC);
    $votesStatement->execute(['id_partner' => $id_partner]);
    $votes = $votesStatement->fetchAll();

    if(count($votes) > 0){
        return $votes[0]['score'];
    }
    else{
        return '0';
    }
}