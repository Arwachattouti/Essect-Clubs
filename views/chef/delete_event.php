<?php
session_start();
require_once __DIR__ . '/../../controllers/EventController.php';

$controller = new EventController();

if (isset($_GET['event_id'], $_GET['club_id'])) {
    $event_id = (int) $_GET['event_id'];  
    $club_id = (int) $_GET['club_id'];   
    if ($controller->deleteEvent($event_id, $club_id)) {
        $_SESSION['success'] = "Événement supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Échec de la suppression de l'événement.";
    }
} else {
    $_SESSION['error'] = "Paramètres invalides.";
}

header('Location: ../chef/manage_events.php?id=' . $club_id);
exit();
?>

