


<?php
// Connexion à la base de données
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');

// Démarrage de session
session_start();
// Récupération du slug pour identifier le partenaire à afficher
$url = $_SERVER['REQUEST_URI'];
$slug = str_replace('/partner.php/', '', $url);




// Affichage du partenaire
function displayPartner($slug, $partners, $bdd){
    foreach ($partners as $key => $partner) {
        if($partner['slug'] == $slug){
            // Récupérer le score du vote like/dislike du partenaire
            $votesScore = getVotesScore($partner['id_partner'], $bdd);

            // Intégration de l'article du partenaire
            echo    
            '<article class="partner_content">
                <div class="partner_content_vote">
                    <p class="partner_content_vote_number">'.$votesScore.'</p>
                    <form method="post" action="../submit-vote.php">
                        <input type="text" value="1" name="vote" hidden>
                        <button class="icon-button"><i class="fa-solid fa-thumbs-up"></i></button>
                    </form>
                    <form method="post" action="../submit-vote.php">
                        <input type="text" value="-1" name="vote" hidden>
                        <button class="icon-button"><i class="fa-solid fa-thumbs-down"></i></button>
                    </form>
                </div>
                <img class="partner_content_image" src="' . $partner['logo'] . '" alt="Logo ' . $partner['partner'] . '" />
                <section class="partner_content_about">
                    <h3 class="partner_content_title">' . $partner['partner'] . '</h3>
                    <p class="partner_content_excerpt">' . $partner['description'] . '</p>
                </section>
            </article>';
            
            // Stockage de l'ID et du slug du partenaire pour les réutiliser ailleurs
            $_SESSION['PARTNER_ID'] = $partner['id_partner'];
            $_SESSION['PARTNER_SLUG'] = $partner['slug'];

        }
    }
}

// Affichage des commentaires
function displayComments($bdd, $slug){
    $comments = getComments($bdd, $slug);

    // Affichage en cas d'absence de commentaires
    if (sizeof($comments) == 0){
        echo '<p class="comment_none">Aucun commentaire</p>';
    }
    // Affichage des commentaires
    else{
        foreach ($comments as $key => $comment) {
            echo 
            '<div class="comment">
                <div class="comment_header">
                    <p class="comment_header_firstname">' . $comment['prenom'] . '</p>
                    <p class="comment_header_date">' . $comment['date_format'] . '</p>
                </div>
                <p class="comment_text">' . $comment['comment'] . '</p>
            </div>';

        }
    }
}

// Récupération des commentaires du partenaire
function getComments($bdd, $slug){
    // Récupération des commentaires
    $commentsStatement = $bdd->prepare('SELECT u.prenom, c.comment, DATE_FORMAT(c.date_add, "%e/%c/%Y %k:%i") as date_format FROM comments c INNER JOIN partners p ON c.id_partner = p.id_partner INNER JOIN users u ON u.id_user = c.id_user WHERE p.slug = :slug ORDER BY date_add DESC');
    $commentsStatement->setFetchMode(PDO::FETCH_ASSOC);
    $commentsStatement->execute(['slug' => $slug]);
    $comments = $commentsStatement->fetchAll();
    return $comments;
}
?>


<!-- CONTENU HTML -->

<!-- Intégration du header -->
<?php include_once('header.php'); ?>

<!-- Intégration du contenu du partenaire -->
<?php displayPartner($slug, $partners, $bdd); ?>

<!-- Section commentaires -->
<section class="comments">
    <div class="comments_header">
        <h3 class="comments_title">Commentaires</h3>
    </div>

    <!-- Formulaire d'envoie de commentaire -->
    <form class="comments_form" method="POST" action="../submit-comment.php">
        <label for="inputMessage">Poster un commentaire</label>
        <textarea  id="inputMessage" name="message" placeholder="Ecrire votre commentaire ici ..." rows="5"></textarea>
        <button type="submit">Envoyer</button>
    </form>
    <?php
        if (isset($_SESSION['alreadyCommented']) && $_SESSION['alreadyCommented'] == true){
            echo'<p id="alert" class="alert-comment">Vous avez déjà envoyé un commentaire sur ce partenaire</p>';
            $_SESSION['alreadyCommented'] = false;
        }
    ?>

    <div class="comments_list">
        <!-- Affichage de la liste des commentaires -->
        <?php displayComments($bdd, $slug); ?>
    </div>

</section>


<!-- Intégration du header -->
<?php 
    include_once('footer.php');
?>