<?php include_once __DIR__ . '/../includes/header1.php'; 
require_once __DIR__ . '/../../controllers/DepartementController.php';
// Créer une instance du contrôleur
$controller = new DepartementController();
$club_id = intval($_GET['id']);
// Appeler la méthode pour traiter la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create();
    header("Location: detail_club.php?id=".$club_id);
    exit();
} 
?>
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="statistics.php" class="nav-link">📊 Statistiques</a>
    <a href="manage_clubs.php" class="nav-link">🏛️ Gérer les clubs</a>
    <a href="manage_users.php" class="nav-link">👥 Gérer les utilisateurs</a>
    <a href="manage_adhesions.php" class="nav-link">📩 Gérer les adhésions</a>
</div>
<div class="container mt-4">
    <h2 class="text-center">Créer un Département</h2>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nom">Nom du Département :</label>
            <input type="text" class="form-control" name="nom" required>
        </div>
        <div class="form-group">
        <label for="description">Description :</label>
        <textarea class="form-control" name="description" required></textarea>
        </div>
        <input type="hidden" name="club_id" value="<?php echo $club_id; ?>">
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>

<?php include_once __DIR__ . '/../includes/footer1.php'; ?>