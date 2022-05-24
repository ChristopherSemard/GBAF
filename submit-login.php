<?php
session_start();
include_once('./sql/db-data.php');

// Intégration du header
include_once('header.php');

// Définition des données récupérées
$username = strip_tags($_POST['pseudo']);
$password = strip_tags($_POST['password']);



// Check si l'user existe
checkUser($username, $password, $users);
    


function checkUser($username, $password, $users){
    // Parcourir la liste des utilisateur
    foreach ($users as $key => $user) {
        // Si les informations correspondent
        if ($username == $user['username'] && password_verify($password, $user['password'])){
            // Création de la connexion
            createConnection($username, $user['id_user']);
            // Redirection vers l'index
            header('Location: ./index.php');
        }
    }
    // Si les informations ne correspondent pas on affiche l'erreur
    echo("<h3 class='text-center alert alert-danger' role='alert'>Vos informations ne sont pas valides.</h3>");
}


function createConnection($username, $userId){
    $_SESSION['LOGGED_USER'] = $username;
    $_SESSION['LOGGED_USER_ID'] = $userId;
}



// Intégration du footer
include_once('footer.php');


?>