


<?php
// Connexion à la base de données
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');

// Démarrage de session
session_start();

// Récupération du slug pour identifier le partenaire à afficher
$slug = str_replace('/partner.php/', '', $_SERVER['REQUEST_URI']);

// Affichage du partenaire
function displayPartner($slug, $partners){
    foreach ($partners as $key => $partner) {
        if($partner['slug'] == $slug){
            echo    
            '<article class="partner">
                <img class="partner_image" src="' . $partner['logo'] . '" alt="Logo ' . $partner['partner'] . '" />
                <section class="partner_about">
                    <h3 class="partner_title">' . $partner['partner'] . '</h3>
                    <p class="partner_excerpt">' . $partner['description'] . '...</p>
                </section>
            </article>';
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

    }
}

// Récupération des commentaires du partenaire
function getComments($bdd, $slug){
    // Récupération des commentaires
    $commentsStatement = $bdd->prepare('SELECT * FROM comments c INNER JOIN partners p ON c.id_partner = p.id_partner WHERE p.id_partner = :slug');
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
<?php displayPartner($slug, $partners); ?>

<!-- Section commentaires -->
<section class="comments">
    <div class="comments_header">
        <h3 class="comments_title">Commentaires</h3>
    </div>
    <div class="comments_list">

        <!-- Affichage de la liste des commentaires -->
        <?php displayComments($bdd, $slug); ?>

    </div>
</section>

<!-- Intégration du header -->
<?php include_once('footer.php');?>