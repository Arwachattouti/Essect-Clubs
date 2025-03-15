<?php
session_start();
require_once __DIR__ . '/../../controllers/DepartementController.php';

$controller = new DepartementController();

$departement_id = $_GET['dept_id'];
$club_id = $_GET['club_id'];

if (isset($_GET['dept_id'], $_GET['club_id'])) {
    $departement_id = (int) $_GET['dept_id'];
    $club_id = (int) $_GET['club_id'];

    if ($controller->delete($departement_id, $club_id)) {
        echo "dept supprimé avec succès.";
    } else {
        echo "Échec de la suppression.";
    }
} else {
    echo "Paramètres invalides.";
}

header("Location: detail_club.php?id=$club_id");
exit();
?>