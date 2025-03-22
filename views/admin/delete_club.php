<?php
session_start();
require_once __DIR__ . '/../../controllers/ClubController.php';

$controller = new ClubController();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $clubId = intval($_GET['id']);

    if ($controller->delete($clubId)) {
        $_SESSION['success_message'] = "Le club a été supprimé avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la suppression du club.";
    }
} else {
    $_SESSION['error_message'] = "Aucun club sélectionné.";
}
header("Location: ../admin/manage_clubs.php");
exit();
?>
