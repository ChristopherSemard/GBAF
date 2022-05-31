
<?php 
require_once './sql/db-data.php';


function getUser($username, $users){
    foreach ($users as $key => $user) {
        if ($username == $user['username']) {
            return $user;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBAF</title>
    <link rel="icon" href="../assets/images/logo-gbaf.png" >
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/c52cbb9b58.js" crossorigin="anonymous"></script>
</head>

<!-- Ouvertu du body -->
<body>
    
    <!-- Header -->
    <header>   
            <a href="../index.php">
                <img src="../assets/images/logo-gbaf.png" alt="Logo du GBAF">
            </a>

            <!-- Ajout du bouton deconnexion si l'utilisateur est connecté -->
            <?php
                if(isset($_SESSION['LOGGED_USER'])){

                    $user = getUser($_SESSION['LOGGED_USER'], $users);
                    echo '
                    <a href="./profile.php">  
                        <div class="user">
                            <p><i class="fa-solid fa-circle-user"></i> '.$user['prenom'].' '. $user['nom'].'</p>
                        </div>
                    </a>
                    <form action="../submit-signout.php">
                        <button>Deconnexion</button>
                    </form>';
                }
            ?>
    </header>

    <!-- Ouverture du main -->
    <main>

