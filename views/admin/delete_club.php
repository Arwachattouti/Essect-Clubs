<?php
session_start();
require_once __DIR__ . '/../../controllers/ClubController.php';

$controller = new ClubController();

// Vérifier si l'ID est bien passé en paramètre
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $clubId = intval($_GET['id']);
    // Supprimer le club
    if ($controller->delete($clubId)) {
        $_SESSION['success_message'] = "Le club a été supprimé avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la suppression du club.";
    }
} else {
    $_SESSION['error_message'] = "Aucun club sélectionné.";
}

// Redirection vers la page de gestion des clubs
header("Location: ../admin/manage_clubs.php");
exit();
?>
