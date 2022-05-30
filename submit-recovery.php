<?php
session_start();
include_once('./sql/db-data.php');

// Intégration du header
include_once('header.php');

// Définition des données récupérées
$username = strip_tags($_POST['pseudo']);
$question = strip_tags($_POST['question']);
$response = strip_tags($_POST['response']);


// Check si les informations sont bonnes
checkInfos($username, $question, $response, $users);

// Check si les informations sont bonnes
function checkInfos($username, $question, $response, $users){
    // Parcourir la liste des utilisateur
    foreach ($users as $key => $user) {
        // Si les informations correspondent
        if ($username == $user['username'] && $question == $user['question'] && $response == $user['reponse']){
            // Affichage du formulaire de soumission du nouveau mot de passe
            echo    '<h2 >NOUVEAU MOT DE PASSE</h2>
                    <form method="POST" action="./submit-password.php">
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
                        <!-- Bouton envoyer -->
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>';
            // Stockage du nom d'utilisateur dans la session
            $_SESSION['username'] = $username;
        }
        else {
            // Si les informations ne correspondent pas on affiche l'erreur
            echo("<h3 class='text-center alert alert-danger' role='alert'>Vos informations ne sont pas valides.</h3>");
        }
    }
}
