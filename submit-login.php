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
    foreach ($users as $key => $value) {
        // Si les informations correspondent
        if ($username == $value['username'] && password_verify($password, $value['password'])){
            // Création de la connexion
            createConnection($username);
            // Redirection vers l'index
            header('Location: ./index.php');
        }
    }
    // Si les informations ne correspondent pas on affiche l'erreur
    echo("<h3 class='text-center alert alert-danger' role='alert'>Vos informations ne sont pas valides.</h3>");
}
    

function createConnection($username){
    $_SESSION['LOGGED_USER'] = $username;
}



// Intégration du footer
include_once('footer.php');


?>