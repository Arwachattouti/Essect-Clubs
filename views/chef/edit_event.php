<?php
require_once __DIR__ . '/../../controllers/EventController.php';
if (!isset($_GET['event_id']) || !isset($_GET['club_id'])) {
    die("ID de l'événement ou du club manquant.");
}
$event_id = intval($_GET['event_id']);
$club_id = intval($_GET['club_id']);
$controller = new EventController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['titre'], $_POST['description'], $_POST['date'], $_POST['lieu'], $_POST['status'], $_POST['participants'], $_POST['capacity'])) {
        die("Tous les champs doivent être remplis.");
    }
    $controller->update($event_id, $_POST['titre'], $_POST['description'], $_POST['date'], $_POST['lieu'], $_POST['status'], $_POST['participants'], $_POST['capacity']);
 
    header("Location: chef/manage_events.php?id=1");
    exit();
} else {
    $event = $controller->getEventById($event_id);
    if (!$event) {
        die("Événement non trouvé.");
    }
}

include_once __DIR__ . '/../includes/header1.php'; 
?>
<div class="sidebar">
    <h4> Chef Panel</h4>
    <a href="manage_club.php?id=<?php echo $club_id; ?>" class="nav-link"> 🏫 Gérer le profil du club </a>
    <a href="manage_members.php?id=<?php echo $club_id; ?>" class="nav-link"> 📜 Consulter la liste des Membres</a>
    <a href="manage_adhesion.php?id=<?php echo $club_id; ?>" class="nav-link"> ✅ Gérer les demandes d'adhésion</a>
    <a href="manage_events.php?id=<?php echo $club_id; ?>" class="nav-link"> 🎉 Gérer les événements et actualités liés au club </a>
    <a href="manage_statistics.php?id=<?php echo $club_id; ?>" class="nav-link"> 📊 Consulter les statistiques du club </a>
    <a href="logout.php?id=<?php echo $club_id; ?>" class="nav-link"> 🚪 Déconnexion </a>
</div>


<div class="content">
    <div class="container mt-5">
        <h2 class="text-center">Éditer l'Événement</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" class="form-control" name="titre" value="<?php echo htmlspecialchars($event['titre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" name="description" required><?php echo htmlspecialchars($event['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" class="form-control" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="lieu">Lieu :</label>
                <input type="text" class="form-control" name="lieu" value="<?php echo htmlspecialchars($event['lieu']); ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Statut :</label>
                <select name="status" class="form-control" required>
                    <option value="à venir" <?php echo ($event['status'] == 'à venir') ? 'selected' : ''; ?>>À venir</option>
                    <option value="en cours" <?php echo ($event['status'] == 'en cours') ? 'selected' : ''; ?>>En cours</option>
                    <option value="terminé" <?php echo ($event['status'] == 'terminé') ? 'selected' : ''; ?>>Terminé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="participants">Participants :</label>
                <input type="number" class="form-control" name="participants" value="<?php echo htmlspecialchars($event['participants']); ?>" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacité :</label>
                <input type="number" class="form-control" name="capacity" value="<?php echo htmlspecialchars($event['capacity']); ?>" required>
            </div>
            
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <input type="hidden" name="club_id" value="<?php echo $club_id; ?>">
            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer1.php'; ?>


