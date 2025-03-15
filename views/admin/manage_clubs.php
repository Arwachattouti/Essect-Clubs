<?php
session_start();
require_once __DIR__ . '/../../controllers/ClubController.php';
$controller = new ClubController();
$clubs = $controller->manageClubs(); // Récupération des clubs
include '../includes/header1.php';
?>
<style>
    body {
        height: 100vh;
    }
</style>
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="statistics.php" class="nav-link">📊 Statistiques Globales </a>
    <a href="manage_clubs.php" class="nav-link">🏛️ Gérer les clubs</a>
    <a href="manage_users.php" class="nav-link">👥 Gérer les utilisateurs</a>
    <a href="manage_chef.php" class="nav-link">📩 Gérer les responsables de clubs </a>
    <a href="logout.php" class="nav-link">Deconnexion </a>
</div>
<div class="content">
    <div id="content-area">
        <h2 class="text-center mb-4">Gestion des Clubs</h2>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<p style='color: green; font-weight: bold; text-align: center;'>{$_SESSION['success_message']}</p>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo "<p style='color: red; font-weight: bold; text-align: center;'>{$_SESSION['error_message']}</p>";
            unset($_SESSION['error_message']);
        }
        ?>

        <?php if (empty($clubs)): ?>
            <p class="text-center text-warning">Aucun club trouvé. </p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($clubs as $club): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['logo']); ?>" class="card-img-top" alt="Logo de <?php echo htmlspecialchars($club['nom']); ?>" style="height: 200px; object-fit: contain;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($club['nom']); ?></h5>
                                <p class="card-text text-muted"><strong>Date de création :</strong> <?php echo date('d M Y', strtotime($club['date_creation'])); ?></p>
                                <p class="card-text"><?php echo htmlspecialchars($club['description_courte'] ?? ''); ?></p>
                                <div class="d-flex justify-content-between">
                                    <a href="detail_club.php?id=<?php echo $club['id']; ?>" class="btn btn-info btn-sm">Détails</a>
                                    <a href="edit_club.php?id=<?php echo $club['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                    <a href="delete_club.php?id=<?php echo $club['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce club ?');">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="create_club.php" class="btn btn-success">Ajouter un Club</a>
        </div>
    </div>
</div>

<?php include '../includes/footer1.php'; ?>


