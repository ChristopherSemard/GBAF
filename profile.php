
<?php
// Connexion à la base de données
require_once './sql/db-connection.php';
require_once('./sql/db-data.php');

// Démarrage de session
session_start();

?>
        
    <!-- Intégration du header -->
    <?php include_once('header.php');?>



    <?php
    echo '  <h2 >MODIFIER VOS INFORMATIONS</h2>
            <form method="POST" action="./submit-infos.php">
                <!-- Choix de prénom -->
                <div>
                    <label for="inputPrenom">Prénom</label>
                    <input type="text" id="inputPrenom" name="prenom" placeholder="Prénom" value="'.$user['prenom'].'" required>
                </div>
                <!-- Choix de nom -->
                <div>
                    <label for="inputNom">Nom</label>
                    <input type="text" id="inputNom" name="nom" placeholder="Nom" value="'.$user['nom'].'" required>
                </div>
                <!-- Choix de pseudo -->
                <div>
                    <label for="inputPseudo">Pseudo</label>
                    <input type="text" id="inputPseudo" name="pseudo" placeholder="Pseudo" value="'.$user['username'].'" required>
                </div>
                <!-- Bouton envoyer -->
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>';

        ?>


    
    <h2 >MODIFIER VOTRE MOT DE PASSE</h2>
    <form method="POST" action="./submit-new-password.php">

        <!-- Choix de mot de passe -->
        <div>
            <label for="inputOldPassword">Mot de passe actuel</label>
            <input type="password" id="inputOldPassword" name="oldPassword" placeholder="Mot de passe actuel" required>
        </div>
        <!-- Choix de mot de passe -->
        <div>
            <label for="inputPassword">Nouveau mot de passe</label>
            <input type="password" id="inputPassword" name="password" placeholder="Nouveau mot de passe" required>
        </div>
        <!-- Confirmation mot de passe -->
        <div>
            <label for="inputConfirmPassword">Confirmer le nouveau mot de passe</label>
            <input type="password" id="inputConfirmPassword" name="password-confirm" placeholder="Nouveau mot de passe" required>
        </div>
        <!-- Bouton envoyer -->
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>



    <!-- Intégration du footer -->
    <?php include_once('footer.php'); ?>