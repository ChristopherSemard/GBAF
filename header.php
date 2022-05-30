
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
                                    
                    echo '  <form action="../submit-signout.php">
                                <button>Deconnexion</button>
                            </form>';
                }
            ?>
    </header>

    <!-- Ouverture du main -->
    <main>
