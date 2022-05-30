
<?php

session_start();
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');



// Récupération des informations nécessaires à la requête
$comment = strip_tags($_POST['message']);
$userId = $_SESSION['LOGGED_USER_ID'];
$partnerId = $_SESSION['PARTNER_ID'];
$slug = $_SESSION['PARTNER_SLUG'];

// Récupération des commentaires du partenaire
$comments = getComments($bdd, $slug);

// Chercher si l'utilisateur a déjà posté un commentaire sur ce partenaire
$alreadyCommented = checkAlreadyCommented($comments, $userId);

if ($alreadyCommented){
    // Définition d'une variable de session pour l'affichage du message d'erreur
    $_SESSION['alreadyCommented'] = true;
    // Redirection vers la page du partenaire
    header('Location: ./partner.php/'.$_SESSION['PARTNER_SLUG'].'#alert');
}
else{
    // Requête pour créer l'utilisateur en BDD
    addMessageBdd($bdd, $comment, $userId, $partnerId);
    // Redirection vers la page du partenaire
    header('Location: ./partner.php/'.$_SESSION['PARTNER_SLUG']);
}

// Chercher si l'utilisateur a déjà posté un commentaire sur ce partenaire
function checkAlreadyCommented($comments, $userId){
    // Parcourir la liste des commentaires
    foreach ($comments as $key => $comment) {
        // Si un utilisateur ressort
        if ($userId == $comment['id_user']){
            return true;
        }
    }
    return false;
}


// Requête pour créer l'utilisateur en BDD
function addMessageBdd($bdd, $comment, $userId, $partnerId){
    $addMessage = $bdd->prepare('INSERT INTO comments (id_user, id_partner, date_add, comment) VALUES (:id_user, :id_partner, NOW(), :comment)');
    $addMessage->execute(['comment' => $comment,'id_user' => $userId,'id_partner' => $partnerId]);
}




// Récupération des commentaires du partenaire
function getComments($bdd, $slug){
    // Récupération des commentaires
    $commentsStatement = $bdd->prepare('SELECT u.prenom, c.comment, c.date_add, c.id_user FROM comments c INNER JOIN partners p ON c.id_partner = p.id_partner INNER JOIN users u ON u.id_user = c.id_user WHERE p.slug = :slug');
    $commentsStatement->setFetchMode(PDO::FETCH_ASSOC);
    $commentsStatement->execute(['slug' => $slug]);
    $comments = $commentsStatement->fetchAll();
    return $comments;
}
?>