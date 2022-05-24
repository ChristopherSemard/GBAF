
<?php
// Connexion à la base de données
require_once './sql/db-connection.php';

// Démarrage de session
session_start();

?>



    <!-- Intégration du header -->
    <?php include_once('header.php'); 


    if(!isset($_SESSION['LOGGED_USER'])){
        // Integration du formulaire de connexion
        include_once('login.php'); 
    }
    else {
        // Integration du contenu
        include_once('home.php'); 
    }


    // Intégration du footer
    include_once('footer.php'); ?>