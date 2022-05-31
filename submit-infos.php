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
$userId = $_SESSION['LOGGED_USER_ID'];

// Check si les informations sont valides
$validForm = checkForm($nom, $prenom, $username, $userId, $users);
// Si le formulaire est valide on update l'utilisateur en base de données
if($validForm){
    updateUserDb($bdd, $nom, $prenom, $username, $userId);
    // Redéfinition de la variable pseudo stockée en session
    $_SESSION['LOGGED_USER'] = $username;
}


// Check de la validité des infos
function checkForm($nom, $prenom, $username, $userId, $users) {
    
    // Regex pour valider les données
    $regexBase = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,100}$/u";

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
    // Existance de l'utilisateur
    elseif(checkUserAlreadyExist($username, $users, $userId)){
        echo("<h3 class='alert-danger' role='alert'>Ce pseudo est déjà utilisé</h3>");
        return false;
    }

    // Si aucun problème n'a été trouvé on valide l'inscription
    echo("  <h3 class='alert-success' role='alert'>Félicitations, vos informations ont été modifiées</h3>");
            
    return true;
};

// Requête pour créer l'utilisateur en BDD
function updateUserDb($bdd, $nom, $prenom, $username, $userId){
    $addUser = $bdd->prepare('UPDATE users SET nom = :nom , prenom = :prenom , username = :username WHERE id_user = :id_user');
    $addUser->execute(['nom' => $nom, 'prenom' => $prenom, 'username' => $username, 'id_user' => $userId]);
}


// Check si le pseudo est déjà utilisé dans la BDD
function checkUserAlreadyExist($username, $users, $userId){
    foreach ($users as $key => $user) {
        if ($username == $user['username'] && $userId != $user['id_user']){
            return true;
        }
    }
    return false;
}

// Intégration du footer
include_once('footer.php');


?>