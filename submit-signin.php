<?php
session_start();
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');

// Intégration du header
include_once('header.php');

// Définition des données récupérées
$nom = strip_tags($_POST['nom']);
$prenom = strip_tags($_POST['prenom']);
$username = strip_tags($_POST['pseudo']);
$password = strip_tags($_POST['password']);
$passwordConfirm = strip_tags($_POST['password-confirm']);
$secretQuestion = strip_tags($_POST['question']);
$secretResponse = strip_tags($_POST['response']);

// Check si les informations sont valides
$validForm = checkForm($nom, $prenom, $username, $password, $passwordConfirm, $secretQuestion, $secretResponse, $users);
// Si le formulaire est valide on crée l'utilisateur en base de données
if($validForm){
    addUserDb($bdd, $nom, $prenom, $username, $password, $passwordConfirm, $secretQuestion, $secretResponse);
    createConnection($username);
}


// Check de la validité des infos
function checkForm($nom, $prenom, $username, $password, $passwordConfirm, $secretQuestion, $secretResponse, $users) {
    
    // Regex pour valider les données
    $regexBase = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,100}$/u";
    $regexPassword = "/^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/";
    $regexResponse = "/^{2,}$/";


    // Validité du prénom
    if ( !preg_match($regexBase, $prenom)){
        echo("<h3 class='alert-danger' role='alert'>Votre prénom n'est pas valide.</h3>");
        return false;
    }	
    // Validité du nom
    elseif ( !preg_match($regexBase, $nom)){
        echo("<h3 class='alert-danger' role='alert'>Votre nom n'est pas valide.</h3>");
        return false;
    }	
    // Validité du pseudo
    elseif (!preg_match($regexBase, $username)){
        echo("<h3 class='alert-danger' role='alert'>Votre pseudo n'est pas valide.</h3>");
        return false;
    }	
    // Validité du mot de passe
    elseif ( !preg_match($regexPassword, $password)){
        echo("<h3 class='alert-danger' role='alert'>Votre mot de passe n'est pas valide.</h3>");
        return false;
    }	
    // Correspondance du mot de passe
    elseif ($password != $passwordConfirm){
        echo("<h3 class='alert-danger' role='alert'>Vos mots de passe ne correspondent pas.</h3>");
        return false;
    }
    // Existance de l'utilisateur
    elseif(checkUserAlreadyExist($username, $users)){
        echo("<h3 class='alert-danger' role='alert'>Ce pseudo est déjà utilisé</h3>");
        return false;
    }
    // Choix de question secrète
    elseif($secretQuestion == ''){
        echo("<h3 class='alert-danger' role='alert'>Vous n'avez pas choisi de question secrète</h3>");
        return false;
    }
    // Réponse secrète renseignée
    elseif($secretQuestion == ''){
        echo("<h3 class='alert-danger' role='alert'>Vous n'avez pas choisi de question secrète</h3>");
        return false;
    }

    // Si aucun problème n'a été trouvé on valide l'inscription
    echo("  <h3 class='alert-success' role='alert'>Félicitations, votre inscription est terminée</h3>");
            
    return true;
};

// Requête pour créer l'utilisateur en BDD
function addUserDb($bdd, $nom, $prenom, $username, $password, $passwordConfirm, $secretQuestion, $secretResponse){
    $hashPassword = hashPassword($password);
    $addUser = $bdd->prepare('INSERT INTO users (nom, prenom, username, password, question, reponse) VALUES (:nom, :prenom, :username, :password, :question, :reponse)');
    $addUser->execute(['nom' => $nom, 'prenom' => $prenom, 'username' => $username, 'password' => $hashPassword, 'question' => $secretQuestion, "reponse" => $secretResponse]);
}

// Hash du password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Check si le pseudo est déjà utilisé dans la BDD
function checkUserAlreadyExist($username, $users){
    foreach ($users as $key => $value) {
        if ($username == $value['username']){
            return true;
        }
    }
    return false;
}

// Création de la connexion
function createConnection($username){
    $_SESSION['LOGGED_USER'] = $username;
    $_SESSION['LOGGED_USER_ID'] = $userId;
}


// Intégration du footer
include_once('footer.php');


?>