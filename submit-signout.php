<?php

// Import de la session
session_start();

// Suppression de la session
session_destroy();

// Redirection vers l'index
header('Location: ./index.php');