<?php
session_start();  // Démarrer la session pour accéder aux variables de session

// Supprimer toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page dashboard.php
header("Location: ../visiteur/listeclubs.php");
exit();  // S'assurer que le script s'arrête après la redirection
?>