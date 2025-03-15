<?php
session_start();
require_once __DIR__ . '/../../controllers/UserController.php';
$controller = new UserController();

// Vérifier si un ID est présent dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = "ID utilisateur manquant.";
    header("Location: manage_users.php");
    exit();
}

$userId = intval($_GET['id']);
$user = $controller->getUserById($userId);
if (!$user) {
    $_SESSION['error_message'] = "Utilisateur introuvable.";
    header("Location: manage_users.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $image_path = isset($user['profile_image']) ? $user['profile_image'] : 'default.png';

    // Vérifier si une nouvelle image est téléchargée
    if (!empty($_FILES['profile_image']['name'])) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/clubs/public/img/clubsessect/";
        $fileName = basename($_FILES['profile_image']['name']);
        $filePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            // Supprimer l'ancienne image si elle existe
            if (!empty($user['image_path']) && file_exists($uploadDir . $user['image_path'])) {
                unlink($uploadDir . $user['image_path']);
            }
            // Déplacer le fichier uploadé
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $filePath)) {
                $image_path = $fileName;
            } else {
                $_SESSION['error_message'] = "Erreur lors du téléchargement de l'image.";
            }
        } else {
            $_SESSION['error_message'] = "Type de fichier non autorisé.";
        }
    }

    // Mise à jour de l'utilisateur avec la nouvelle image si nécessaire
    if ($controller->updateUser($userId, $username, $email, $role, $image_path)) {
        $_SESSION['success_message'] = "Utilisateur mis à jour avec succès.";
        header("Location: manage_users.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour.";
    }
}

include '../includes/header1.php'; 
?>
<style>
    body{
        height: 100%;
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

<!-- Contenu principal -->
<div class="content">
    <div class="container mt-5">
        <h2>Modifier l'utilisateur</h2>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nom d'utilisateur :</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Rôle :</label>
                <select name="role" class="form-control">
                    <option value="administrateur" <?php echo ($user['role'] === 'administrateur') ? 'selected' : ''; ?>>Administrateur</option>
                    <option value="etudiant" <?php echo ($user['role'] === 'étudiant') ? 'selected' : ''; ?>>Étudiant</option>
                    <option value="chef" <?php echo ($user['role'] === 'chef') ? 'selected' : ''; ?>>Chef de club</option>
                </select>
            </div>
            <div class="form-group">
                <label>Image de profil :</label>
                <input type="file" name="profile_image" class="form-control">
                <?php if (!empty($user['image_path'])): ?>
                    <p>Image actuelle :</p>
                    <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($user['image_path']); ?>" alt="Image de profil" width="100">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="manage_users.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {
    $(".nav-link").first().addClass("active");
    $(".nav-link").click(function (e) {
        e.preventDefault();
        let page = $(this).data("page");
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        $("#content-area").load(page + ".php");
    });
});
</script>

<?php include '../includes/footer1.php'; ?>
