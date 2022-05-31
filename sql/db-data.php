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

function getVotesScore($id_partner, $vote, $bdd){
    // Récupération des votes sur les articles à l'aide du client MySQL
    $votesStatement = $bdd->prepare('SELECT * FROM votes WHERE id_partner = :id_partner AND vote = :vote');
    $votesStatement->setFetchMode(PDO::FETCH_ASSOC);
    $votesStatement->execute(['id_partner' => $id_partner, 'vote' => $vote]);
    $votes = $votesStatement->fetchAll();

    if(count($votes) > 0){
        return count($votes);
    }
    else{
        return '0';
    }
}


function getVoteUser($id_partner, $userId, $bdd){
    // Récupération des votes sur les articles à l'aide du client MySQL
    $votesStatement = $bdd->prepare('SELECT * FROM votes WHERE id_partner = :id_partner AND id_user = :id_user');
    $votesStatement->setFetchMode(PDO::FETCH_ASSOC);
    $votesStatement->execute(['id_partner' => $id_partner, 'id_user' => $userId]);
    $vote = $votesStatement->fetchAll();
    
    if(count($vote) > 0){
        return $vote[0]['vote'];
    }
    else{
        return null;
    }
}

