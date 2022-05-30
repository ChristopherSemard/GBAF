
<?php
// Connexion à la base de données
require_once './sql/db-connection.php';
include_once('./sql/db-data.php');

// Démarrage de session
session_start();

?>
        
    <!-- Intégration du header -->
    <?php include_once('header.php');?>


        <!-- Formulaire de connexion -->
        <h2>MOT DE PASSE OUBLIE</h2>
        <form  method="POST" action="./submit-recovery.php">
            <!-- Pseudo -->
            <div>
                <label for="inputPseudo">Pseudo</label>
                <input type="text" id="inputPseudo" name="pseudo" placeholder="Pseudo" required>
            </div>
            <!-- Selection de la question secrète -->
            <div>
                <label for="selectQuestion">Question secrète</label>
                <select name="question" id="selectQuestion">
                    <option value="">--Choisir une question secrète--</option>
                    <?php
                        // Affichage de toute la liste de questions serètes
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
            <button type="submit">Valider</button>
        </form>

        
    <!-- Intégration du footer -->
    <?php include_once('footer.php'); ?>
