<?php
session_start();
require_once __DIR__ . '/../../controllers/UserController.php';

$controller = new UserController();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = intval($_GET['id']);

    if ($controller->deleteUser($userId)) {
        $_SESSION['success_message'] = "Utilisateur supprimé avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la suppression.";
    }
} else {
    $_SESSION['error_message'] = "Utilisateur introuvable.";
}

header("Location: manage_users.php");
exit();
?>
