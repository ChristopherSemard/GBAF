<?php
session_start();
include_once('./sql/db-connection.php');
include_once('./sql/db-data.php');

// Intégration du header
include_once('header.php');

// Définition des données récupérées
$password = strip_tags($_POST['oldPassword']);
$newPassword = strip_tags($_POST['password']);
$newPasswordConfirm = strip_tags($_POST['password-confirm']);
$username = $_SESSION['LOGGED_USER'];


// Check si les informations sont valides
$validForm = checkForm($password, $newPassword, $newPasswordConfirm, $username, $users);
// Si le formulaire est valide on crée l'utilisateur en base de données
if($validForm){
    updateUserDb($bdd, $newPassword, $username);
}



// Check de la validité des infos
function checkForm($password, $newPassword, $newPasswordConfirm, $username, $users) {
    
    // Regex pour valider les données
    $regexPassword = "/^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/";

    // Check si l'user existe
    if (!checkUser($username, $password, $users)){
        echo("<h3 class='alert-danger' role='alert'>Votre mot de passe actuel n'est pas valide.</h3>");
        return false;
    }
    // Mot de passes identiques
    elseif ($password == $newPassword){
        echo("<h3 class='alert-danger' role='alert'>Votre nouveau mot de passe est identique à l'ancien.</h3>");
        return false;
    }	
    // Validité du mot de passe
    elseif (!preg_match($regexPassword, $newPassword)){
        echo("<h3 class='alert-danger' role='alert'>Votre nouveau mot de passe n'est pas valide.</h3>");
        return false;
    }	
    // Correspondance du mot de passe
    elseif ($newPassword != $newPasswordConfirm){
        echo("<h3 class='alert-danger' role='alert'>Vos nouveaux mots de passe ne correspondent pas.</h3>");
        return false;
    }

    // Si aucun problème n'a été trouvé on valide l'inscription
    echo("  <h3 class='alert-success' role='alert'>Félicitations, votre mot de passe a été modifié.</h3>");
            
    return true;
};



// Check si l'user existe
function checkUser($username, $password, $users){
    // Parcourir la liste des utilisateur
    foreach ($users as $key => $user) {
        // Si les informations correspondent
        if ($username == $user['username'] && password_verify($password, $user['password'])){
            return true;
        }
    }
    // Si les informations ne correspondent pas on affiche l'erreur
    echo("<h3 class='text-center alert alert-danger' role='alert'>Vos informations ne sont pas valides.</h3>");
    return false;
}




// Requête pour update l'utilisateur en BDD
function updateUserDb($bdd, $newPassword, $username){
    $hashPassword = hashPassword($newPassword);
    $addUser = $bdd->prepare('UPDATE users SET password = :password WHERE username = :username');
    $addUser->execute(['username' => $username, 'password' => $hashPassword]);
}

// Hash du password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}


// Intégration du header
include_once('footer.php');?>

