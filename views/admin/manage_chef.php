<?php
include_once __DIR__ . '/../includes/header1.php';
require_once __DIR__ . '/../../controllers/ChefController.php';

$controller = new ChefController();
$chefs = $controller->listChefs();

$edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : null;

// Si un ID de chef est passé en GET, récupérez les informations de ce chef
if ($edit_id) {
    $chef = $controller->getChefById($edit_id); // Récupérer les informations du chef par son ID
    if ($chef === null) {
        echo "Chef introuvable.";
        exit;
    }
}


?>

<style>
    body {
        height: 150vh;
    }
</style>

<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="statistics.php" class="nav-link">📊 Statistiques Globales</a>
    <a href="manage_clubs.php" class="nav-link">🏛️ Gérer les clubs</a>
    <a href="manage_users.php" class="nav-link">👥 Gérer les utilisateurs</a>
    <a href="manage_chef.php" class="nav-link">📩 Gérer les responsables de clubs</a>
    <a href="logout.php" class="nav-link">Déconnexion</a>
</div>

<div class="container mt-5">
    <h2 class="text-center">Gérer les chefs de clubs</h2>
    <!-- Affichage des messages de succès ou d'erreur après le titre -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <p class="alert alert-success">
            <?php echo $_SESSION['success_message']; ?>
        </p>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <p class="alert alert-danger">
            <?php echo $_SESSION['error_message']; ?>
        </p>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?><br>
    <!-- Bouton pour ajouter un chef -->
    <div class="mb-4 text-center">
        <a href="manage_chef.php?add_new=true" class="btn btn-success">Ajouter un chef</a>
    </div>

    <!-- Formulaire pour ajouter un chef -->
    <?php if (isset($_GET['add_new'])) : ?>
        <form action="manage_chef.php" method="POST">
        <input type="hidden" name="action" value="add">
        
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="phone">Numéro de téléphone :</label>
            <input type="text" class="form-control" name="phone" required>
        </div>

        <div class="form-group">
            <label for="club_id">ID du club :</label>
            <input type="number" class="form-control" name="club_id" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <?php endif; ?>

    <!-- Formulaire pour modifier un chef -->
    <?php if ($edit_id && isset($chef)) : ?>
        <form action="manage_chef.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $chef['id']; ?>"> <!-- ID caché -->

            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" class="form-control" name="username" value="<?php echo $chef['username']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" name="email" value="<?php echo $chef['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Numéro de téléphone :</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $chef['phone']; ?>" required>
            </div>

            <div class="form-group">
                <label for="club_id">ID du club :</label>
                <input type="number" class="form-control" name="club_id" value="<?php echo $chef['club_id']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    <?php endif; ?>

    <!-- Liste des chefs -->
    <table class="table mt-4">
        <thead>
            <tr>
                
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Club</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chefs as $chef) : ?>
                <tr>
                    <td><?php echo $chef['username']; ?></td>
                    <td><?php echo $chef['email']; ?></td>
                    <td><?php echo $chef['phone']; ?></td>
                    <td><?php echo $chef['club_id']; ?></td>
                    <td>
                        <a href="manage_chef.php?edit_id=<?php echo $chef['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="manage_chef.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $chef['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function editChef(id, username, email, phone, club_id) {
    document.getElementById('id').value = id;
    document.getElementById('username').value = username;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('club_id').value = club_id;
    document.getElementById('action').value = 'edit';
}
</script>

<?php include_once __DIR__ . '/../includes/footer1.php'; ?>
