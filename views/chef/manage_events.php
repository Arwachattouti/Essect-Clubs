<?php
include '../includes/header1.php';
require_once __DIR__ . '/../../controllers/EventController.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$Controller = new EventController();
$evenements = $Controller->getEventsByClubId($id);
?>
<style>
    body{
        height: 100%;
    }
    .row {
    row-gap: 5px; 
    column-gap: 5px; 
}

.card {
    margin: 80px; 
}

</style>
<div class="sidebar">
    <h4> Chef Panel</h4>
    <a href="manage_club.php?id=<?php echo $id; ?>" class="nav-link"> 🏫 Gérer le profil du club </a>
    <a href="manage_members.php?id=<?php echo $id; ?>" class="nav-link"> 📜 Consulter la liste des Membres</a>
    <a href="manage_adhesion.php?id=<?php echo $id; ?>" class="nav-link"> ✅ Gérer les demandes d'adhésion</a>
    <a href="manage_events.php?id=<?php echo $id; ?>" class="nav-link"> 🎉 Gérer les événements et actualités liés au club </a>
    <a href="manage_statistics.php?id=<?php echo $id; ?>" class="nav-link"> 📊 Consulter les statistiques du club </a>
    <a href="logout.php?id=<?php echo $id; ?>" class="nav-link"> 🚪 Déconnexion </a>
</div>

<div class="content">
    <h2 class="text-center">Gérer les événements</h2>

    <?php
    if (!empty($_SESSION['success_message'])) {
        echo "<p class='success'>{$_SESSION['success_message']}</p>";
        unset($_SESSION['success_message']);
    }
    if (!empty($_SESSION['error_message'])) {
        echo "<p class='error'>{$_SESSION['error_message']}</p>";
        unset($_SESSION['error_message']);
    }
    ?>
<br>
    <a href="create_event.php?id=<?php echo $id; ?>" class="btn btn-primary">+ Ajouter un événement</a>
    <br>
    <div class="row">
    <?php if (!empty($evenements)) : ?>
        <?php foreach ($evenements as $evenement) : ?>
            <div class="col-md-3 col-sm-6 mb-3"> 
                <div class="card" style="width: 200px; height: 250px; font-size: 14px;"> 
                    <?php 
                    $formattedDate = isset($evenement['date']) ? date('d M Y', strtotime($evenement['date'])) : 'Date non précisée'; 
                    $imageUrl = !empty($evenement['image_principale']) ? htmlspecialchars($evenement['image_principale']) : 'path_to_default_image/default.jpg'; 
                    ?>
                    
                    <img src="<?php echo $imageUrl; ?>" class="card-img-top" alt="Image de l'événement" style="height: 100px; object-fit: cover;"> 
                    <div class="card-body p-2"> 
                        <h6 class="card-title text-truncate"><?php echo htmlspecialchars($evenement['nom'] ?? $evenement['titre'] ?? 'Sans titre'); ?></h6>
                        <p class="card-text text-truncate"><?php echo htmlspecialchars($evenement['description'] ?? 'Aucune description'); ?></p>
                        <small><strong>Lieu:</strong> <?php echo htmlspecialchars($evenement['lieu'] ?? 'Non spécifié'); ?></small><br>
                        <small><strong>Date:</strong> <time><?php echo $formattedDate; ?></time></small><br>
                        <a href="edit_event.php?event_id=<?php echo $evenement['id']; ?>&club_id=<?php echo $id; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete_event.php?event_id=<?php echo $evenement['id']; ?>&club_id=<?php echo $id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


</div>

<?php include '../includes/footer1.php'; ?>

