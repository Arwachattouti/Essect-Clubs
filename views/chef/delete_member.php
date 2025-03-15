<?php
session_start();
require_once __DIR__ . '/../../controllers/MemberController.php';

$controller = new MemberController();

$id = isset($_GET['id']) ? $_GET['id'] : null;

$userId= isset($_GET['idm']) ? $_GET['idm'] : null;

    if ($controller->deleteMember($userId)) {
        $_SESSION['success_message'] = "Utilisateur supprimé avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la suppression.";
    }

header("Location: manage_members.php?id=".$id);
exit();
?>
