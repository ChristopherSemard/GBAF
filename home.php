<?php include_once('./sql/db-data.php'); ?>

<!-- Présentation du site -->
<section class="presentation">
    <h1 class="presentation_title">Bienvenue sur le site de la GBAF !</h1>
    <article class="presentation_text">
        <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :</p>
        <ul>
            <li>BNP Paribas</li>
            <li>BPCE</li>
            <li>Crédit Agricole</li>
            <li>Crédit Mutuel-CIC</li>
            <li>Société Générale</li>
            <li>La Banque Postale</li>
        </ul>
        <p>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.<br>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
    </article>
</section>


<!-- Section partenaires -->
<section class="partners">
    <h2 class="partners_title">Liste des partenaires</h2>
    
    <!-- Intégration dynamique du contenu -->
    <?php

        foreach ($partners as $key => $partner) {
            echo    '<article class="partner">
                        <img class="partner_image" src="' . $partner['logo'] . '" alt="Logo ' . $partner['partner'] . '" />
                        <section class="partner_about">
                            <h3 class="partner_title">' . $partner['partner'] . '</h3>
                            <p class="partner_excerpt">' . $partner['excerpt'] . '...</p>
                            <a class="partner_read_more link-button" href="./partner.php/' . $partner['slug'] . '">Lire la suite</a>
                        </section>
                    </article>';
        }

    ?>

</section>