<?php
include_once __DIR__ . '/../includes/header1.php'; 
require_once __DIR__ . '/../../controllers/DepartementController.php';

$controller = new DepartementController();
if (!isset($_GET['dept_id']) || !isset($_GET['club_id'])) {
    die("ID du departement ou du club manquant.");
}
$departement_id = $_GET['dept_id'];
$club_id = $_GET['club_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['nom'], $_POST['description'], $_POST['club_id'])) {
        die("Tous les champs doivent être remplis.");
    }    
    $controller->edit($departement_id);
    header("Location: detail_club.php?id=$club_id");
    exit();
} else {
    $departement = $controller->getDepartementById($departement_id);
    if (!$departement) {
        die("Département non trouvé.");
    }
}
?>

<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="statistics.php" class="nav-link">📊 Statistiques</a>
    <a href="manage_clubs.php" class="nav-link">🏛️ Gérer les clubs</a>
    <a href="manage_users.php" class="nav-link">👥 Gérer les utilisateurs</a>
    <a href="manage_adhesions.php" class="nav-link">📩 Gérer les adhésions</a>
</div>

<div class="content">
    <div class="container mt-5">
        <h2 class="text-center">Éditer</h2>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nom">Nom du département :</label>
                <input type="text" class="form-control" name="nom" value="<?php echo htmlspecialchars($departement['nom']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" name="description" required><?php echo htmlspecialchars($departement['description']); ?></textarea>
            </div>
            <input type="hidden" name="departement_id" value="<?php echo $departement_id; ?>">
            <input type="hidden" name="club_id" value="<?php echo $club_id; ?>">
            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer1.php'; ?>
