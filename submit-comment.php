
<?php

session_start();
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');



// Récupération des informations nécessaires à la requête
$comment = strip_tags($_POST['message']);
$userId = $_SESSION['LOGGED_USER_ID'];
$partnerId = $_SESSION['PARTNER_ID'];

// Requête pour créer l'utilisateur en BDD
addMessageBdd($bdd, $comment, $userId, $partnerId);

// Redirection vers la page du partenaire
header('Location: ./partner.php/'.$_SESSION['PARTNER_SLUG']);


// Requête pour créer l'utilisateur en BDD
function addMessageBdd($bdd, $comment, $userId, $partnerId){
    $addMessage = $bdd->prepare('INSERT INTO comments (id_user, id_partner, date_add, comment) VALUES (:id_user, :id_partner, NOW(), :comment)');
    $addMessage->execute(['comment' => $comment,'id_user' => $userId,'id_partner' => $partnerId]);
}
