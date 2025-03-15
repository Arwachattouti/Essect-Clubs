<?php 
include_once __DIR__ . '/../includes/header1.php'; 
require_once __DIR__ . '/../../controllers/EventController.php';
// Créer une instance du contrôleur
$controller = new EventController();
$id = intval($_GET['id']);
// Appeler la méthode pour traiter la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create();
} 
?>
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
    <div class="container mt-5">

    <h2 class="text-center">Créer un Événement</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre :</label>
        <input type="text" class="form-control" name="titre" required>
    </div>
    <div class="form-group">
        <label for="description">Description :</label>
        <textarea class="form-control" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="date">Date :</label>
        <input type="date" class="form-control" name="date" required>
    </div>
    <div class="form-group">
        <label for="lieu">Lieu :</label>
        <input type="text" class="form-control" name="lieu" required>
    </div>
    <div class="form-group">
        <label for="image">Image Principale  :</label>
        <input type="file" class="form-control" name="image" required>
    </div>
    <div class="form-group">
        <label for="participants">Participants :</label>
        <input type="number" class="form-control" name="participants" value="0" required>
    </div>
    <div class="form-group">
        <label for="capacity">Capacité :</label>
        <input type="number" class="form-control" name="capacity" value="1" required>
    </div>
    <div class="form-group">
        <label for="status">Statut :</label>
        <select name="status" class="form-control" required>
            <option value="à venir">À venir</option>
            <option value="en cours">En cours</option>
            <option value="terminé">Terminé</option>
        </select>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-success">Ajouter</button>
</form>

</div>
</div>
<?php include_once __DIR__ . '/../includes/footer1.php'; ?>
