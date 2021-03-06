
<?php
// Connexion à la base de données
require_once './sql/db-connection.php';
require_once './sql/db-data.php';

// Démarrage de session
session_start();

if(isset($_SESSION['LOGGED_USER']) && !isset($_SESSION['LOGGED_USER_ID'])){
    foreach ($users as $key => $user) {
        if ($_SESSION['LOGGED_USER'] == $user['username']) {
            $_SESSION['LOGGED_USER_ID'] = $user['id_user'];
        }
    }
} 


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