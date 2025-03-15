<?php
include_once __DIR__ . '/../includes/header1.php';
require_once __DIR__ . '/../../controllers/BureauController.php';

$id = intval($_GET['id']);
$controller = new BureauController();
$bureau = $controller->getBureauMember($id);

if (!$bureau) {
    echo "<p>Membre du bureau non trouvé.</p>";
    exit;
}

// Mise à jour des données si formulaire soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = intval($_POST['user_id']);
    $responsabilite = htmlspecialchars($_POST['responsabilite']);

    $success = $controller->updateBureauMember($id, $user_id, $responsabilite);
    if ($success) {
        $_SESSION['success_message'] = "Membre mis à jour avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour.";
    }
    header("Location: detail_club.php?id=$id");
    exit;
}

// Liste des utilisateurs pour le formulaire
$users = $controller->getUsers();
?>

<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="statistics.php" class="nav-link">📊 Statistiques Globales </a>
    <a href="manage_clubs.php" class="nav-link">🏛️ Gérer les clubs</a>
    <a href="manage_users.php" class="nav-link">👥 Gérer les utilisateurs</a>
    <a href="manage_chef.php" class="nav-link">📩 Gérer les responsables de clubs </a>
    <a href="logout.php" class="nav-link">Deconnexion </a>
</div>
<div class="container mt-5">
    <h2 class="text-center">Éditer un membre du bureau</h2>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="user_id">Utilisateur :</label>
            <select class="form-control" name="user_id" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id'] ?>" <?= $bureau['user_id'] == $user['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['username']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="responsabilite">Responsabilité :</label>
            <input type="text" class="form-control" name="responsabilite" value="<?= htmlspecialchars($bureau['responsabilite']) ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>

<?php include_once __DIR__ . '/../includes/footer1.php'; ?>
