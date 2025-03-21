<?php 
include_once __DIR__ . '/../includes/header1.php'; 
require_once __DIR__ . '/../../controllers/BureauController.php';
$club_id = intval($_GET['id']); 
$controller = new BureauController();
$controller->createBureauMember();
?>
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="statistics.php" class="nav-link">📊 Statistiques Globales </a>
    <a href="manage_clubs.php" class="nav-link">🏛️ Gérer les clubs</a>
    <a href="manage_users.php" class="nav-link">👥 Gérer les utilisateurs</a>
    <a href="manage_chef.php" class="nav-link">📩 Gérer les responsables de clubs </a>
    <a href="logout.php" class="nav-link">Deconnexion </a>
</div>

<div class="content">
    <div class="container mt-5">
        <h2 class="text-center">Créer un membre bureau</h2>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success_message']; ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error_message']; ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_id">Utilisateur :</label>
                <select class="form-control" name="user_id" required>
                    <?php
                     $users = $controller->getUsers();
                    foreach ($users as $user) {
                        echo '<option value="' . $user['id'] . '">' . $user['username'] . '</option>';
                    }
                    ?>
                </select>
            </div>

           <div class="form-group">
                <label for="responsabilite">Responsabilité :</label>
                <input type="text" class="form-control" name="responsabilite" required>
            </div>

            <input type="hidden" name="club_id" value="<?php echo $club_id; ?>">
            <button type="submit" class="btn btn-success">Ajouter</button>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer1.php'; ?>
