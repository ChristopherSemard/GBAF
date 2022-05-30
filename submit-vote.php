<?php
session_start();
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');

// Variable nécessaires
$partnerId = $_SESSION['PARTNER_ID'];
$userId = $_SESSION['LOGGED_USER_ID'];
$vote = $_POST['vote'];

// Récupérer la liste des votes de l'article
$votes = getVotes($partnerId, $bdd);

// Vérification si la personne a déjà voté, et si oui récupérer le vote
$alreadyVoted = checkAlreadyVoted($votes, $userId);

// Si la personne n'a pas voté
if (!$alreadyVoted){
    // Ajouter le vote en BDD
    addVoteDb($userId, $vote, $partnerId, $bdd);
}
// Si la personne a déjà voté
else{
    if($alreadyVoted['vote'] == $vote){
        // Ne rien faire si la personne a voté la même chose que déjà enregistré
    }
    else{
        // Actualiser le vote avec la nouvelle valeur si le vote est différent
        updateVoteDb($userId, $vote, $partnerId, $bdd);
    }
}

// Redirection vers la page du partenaire
header('Location: ./partner.php/'.$_SESSION['PARTNER_SLUG']);


// Vérification si la personne a déjà voté, et si oui récupérer le vote
function checkAlreadyVoted($votes, $userId){
    // Parcourir les votes
    foreach ($votes as $key => $vote) {
        // Si un vote correspond à notre utilisateur
        if ($vote['id_user'] == $userId) {
            // On retourne le vote
            return $vote;
        }
    }
    // On retourne faux si aucun vote ne correspond à la personne
    return false;
}


// Requête pour créer et stocker le vote en BDD
function addVoteDb($userId, $vote, $partnerId, $bdd){
    $addUser = $bdd->prepare('INSERT INTO votes (id_user, id_partner, vote) VALUES (:id_user, :id_partner, :vote)');
    $addUser->execute(['id_user' => $userId, 'id_partner' => $partnerId, 'vote' => $vote]);
}
// Requête pour update le vote en BDD
function updateVoteDb($userId, $vote, $partnerId, $bdd){
    $addUser = $bdd->prepare('UPDATE votes SET vote = :vote WHERE id_user = :id_user AND id_partner = :id_partner');
    $addUser->execute(['id_user' => $userId, 'id_partner' => $partnerId, 'vote' => $vote]);
}


