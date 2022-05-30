


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
            '<article class="partner">
                <div id="partner_vote">
                    <p class="partner_vote_number">'.$votesScore.'</p>
                    <form method="post" action="../submit-vote.php">
                        <input type="text" value="1" name="vote" hidden>
                        <button>BOUTON LIKE</button>
                    </form>
                    <form method="post" action="../submit-vote.php">
                        <input type="text" value="-1" name="vote" hidden>
                        <button>BOUTON DISLIKE</button>
                    </form>
                </div>
                <img class="partner_image" src="' . $partner['logo'] . '" alt="Logo ' . $partner['partner'] . '" />
                <section class="partner_about">
                    <h3 class="partner_title">' . $partner['partner'] . '</h3>
                    <p class="partner_excerpt">' . $partner['description'] . '</p>
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
        echo '<p>Aucun commentaire</p>';
    }
    // Affichage des commentaires
    else{
        foreach ($comments as $key => $comment) {
            echo 
            '<div class="comment">
                <div class="comment_header">
                    <p class="comment_header_firstname">' . $comment['prenom'] . '</p>
                    <p class="comment_header_date">' . $comment['date_add'] . '</p>
                </div>
                <p class="comment_header_text">' . $comment['comment'] . '</p>
            </div>';

        }
    }
}

// Récupération des commentaires du partenaire
function getComments($bdd, $slug){
    // Récupération des commentaires
    $commentsStatement = $bdd->prepare('SELECT u.prenom, c.comment, c.date_add FROM comments c INNER JOIN partners p ON c.id_partner = p.id_partner INNER JOIN users u ON u.id_user = c.id_user WHERE p.slug = :slug');
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
        <input type="text" id="inputMessage" name="message" placeholder="Poster un commentaire">
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