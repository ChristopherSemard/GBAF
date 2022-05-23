
<?php
// Connexion à la base de données
require_once './sql/db-connection.php';
include_once('./sql/db-data.php');

// Démarrage de session
session_start();

?>



    <!-- Intégration du header -->
    <?php include_once('header.php');?>

    
    <h2 >INSCRIPTION</h2>
    <form method="POST" action="./submit-signin.php">
        <!-- Choix de prénom -->
        <div>
            <label for="inputPrenom">Prénom</label>
            <input type="text" id="inputPrenom" name="prenom" placeholder="Prénom" required>
        </div>
        <!-- Choix de nom -->
        <div>
            <label for="inputNom">Nom</label>
            <input type="text" id="inputNom" name="nom" placeholder="Nom" required>
        </div>
        <!-- Choix de pseudo -->
        <div>
            <label for="inputPseudo">Pseudo</label>
            <input type="text" id="inputPseudo" name="pseudo" placeholder="Pseudo" required>
        </div>
        <!-- Choix de mot de passe -->
        <div>
            <label for="inputPassword">Mot de passe (8 caractères minimum)</label>
            <input type="password" id="inputPassword" name="password" placeholder="Mot de passe" required>
        </div>
        <!-- Confirmation mot de passe -->
        <div>
            <label for="inputConfirmPassword">Confirmer le mot de passe</label>
            <input type="password" id="inputConfirmPassword" name="password-confirm" placeholder="Mot de passe" required>
        </div>
        <!-- Selection de la question secrète -->
        <div>
            <label for="selectQuestion">Question secrète</label>
            <select name="question" id="selectQuestion">
                <option value="">--Choisir une question secrète--</option>
                <?php
                    foreach ($secretQuestions as $key => $question) {
                        echo '<option value="'.$key.'">'.$question.'</option>';
                    }
                ?>
            </select>
        </div>
        <!-- Réponse de la question secrète -->
        <div>
            <label for="inputResponse">Réponse secrète</label>
            <input type="text" id="inputResponse" name="response" placeholder="Réponse" required>
        </div>

        <!-- Bouton envoyer -->
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>



    <!-- Intégration du footer -->
    <?php include_once('footer.php'); ?>