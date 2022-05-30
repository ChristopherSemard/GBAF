<?php
session_start();
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');

// Intégration du header
include_once('header.php');

// Définition des données récupérées
$password = strip_tags($_POST['password']);
$passwordConfirm = strip_tags($_POST['password-confirm']);
$username = $_SESSION['username'];


// Check si les informations sont valides
$validForm = checkForm($password, $passwordConfirm);
// Si le formulaire est valide on crée l'utilisateur en base de données
if($validForm){
    addUserDb($bdd, $password, $passwordConfirm, $username);
    $_SESSION['username'] = '';
}
else{
    $_SESSION['username'] = '';
}


// Check de la validité des infos
function checkForm($password, $passwordConfirm) {
    
    // Regex pour valider les données
    $regexPassword = "/^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/";

    // Validité du mot de passe
    if (!preg_match($regexPassword, $password)){
        echo("<h3 class='alert-danger' role='alert'>Votre mot de passe n'est pas valide.</h3>");
        return false;
    }	
    // Correspondance du mot de passe
    elseif ($password != $passwordConfirm){
        echo("<h3 class='alert-danger' role='alert'>Vos mots de passe ne correspondent pas.</h3>");
        return false;
    }

    
    // Si aucun problème n'a été trouvé on valide l'inscription
    echo("  <h3 class='alert-success' role='alert'>Félicitations, votre mot de passe a été modifié.</h3>");
            
    return true;
};


// Requête pour créer l'utilisateur en BDD
function addUserDb($bdd, $password, $passwordConfirm, $username){
    $hashPassword = hashPassword($password);
    $addUser = $bdd->prepare('UPDATE users SET password = :password WHERE username = :username');
    $addUser->execute(['username' => $username, 'password' => $hashPassword]);
}

// Hash du password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}