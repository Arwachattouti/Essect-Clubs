<?php 
session_start();
require_once __DIR__ . '/../../controllers/ClubController.php';
include '../includes/header1.php';

$controller = new ClubController();

// Vérifier si l'ID du club est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = "Aucun club sélectionné pour modification.";
    header("Location: ../admin/manage_clubs.php");
    exit();
}
$clubId = intval($_GET['id']);
$club = $controller->getClubById($clubId);
if (!$club) {
    $_SESSION['error_message'] = "Club introuvable.";
    header("Location: ../admin/manage_clubs.php");
    exit();
}
// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $date_creation = $_POST['date_creation'];
    $facebook_link = $_POST['facebook_link'];
    $instagram_link = $_POST['instagram_link'];
    $nb_membre= $_POST['nb_membre'];
    $nb_partenaires = $_POST['nb_partenaires'];
    $logo = $club['logo']; // Conserver l'ancien logo
    $img_slide1 = $club['img_slide1']; // Conserver l'ancienne image slide1
    $img_slide2 = $club['img_slide2']; // Conserver l'ancienne image slide2

    // Mise à jour des données du club via le ClubController
    if ($controller->updateClub($clubId, $nom, $description, $date_creation, $facebook_link, $instagram_link, $nb_membre, $nb_partenaires, $logo, $img_slide1, $img_slide2)) {
        $_SESSION['success_message'] = "Le club a été mis à jour avec succès.";
        header("Location: ../admin/manage_clubs.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour du club.";
    }
}
?>
<style>
    body{
        height: 200vh;
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
    <div class="container mt-5">
        <h2 class="text-center mb-4">Modifier le Club</h2>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Club :</label>
                <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($club['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <textarea name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($club['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="date_creation" class="form-label">Date de Création :</label>
                <input type="date" name="date_creation" class="form-control" value="<?php echo $club['date_creation']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="facebook_link" class="form-label">Lien Facebook :</label>
                <input type="url" name="facebook_link" class="form-control" value="<?php echo htmlspecialchars($club['facebook_link']); ?>">
            </div>
            <div class="mb-3">
                <label for="instagram_link" class="form-label">Lien Instagram :</label>
                <input type="url" name="instagram_link" class="form-control" value="<?php echo htmlspecialchars($club['instagram_link']); ?>">
            </div>
            <div class="mb-3">
                <label for="nb_membre" class="form-label">Nombre de membres :</label>
                <input type="number" name="nb_membre" class="form-control" value="<?php echo htmlspecialchars($club['nb_membre']); ?>">
            </div>
            <div class="mb-3">
                <label for="nb_partenaires" class="form-label">Nombre de Partenaires :</label>
                <input type="number" name="nb_partenaires" class="form-control" value="<?php echo htmlspecialchars($club['nb_partenaires']); ?>">
            </div>
            
            <div class="mb-3">
                <label for="logo" class="form-label">Logo du Club :</label><br>
                <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['logo']); ?>" alt="Logo du club" style="width: 150px; height: auto; margin-bottom: 10px;">
                <input type="file" name="logo" class="form-control" value="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['logo']); ?>">
            </div>
            <div class="mb-3">
                <label for="img_slide1" class="form-label">Image Slide 1 :</label><br>
                <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['img_slide1']); ?>" alt="Image Slide 1" style="width: 150px; height: auto; margin-bottom: 10px;">
                <input type="file" name="img_slide1" class="form-control" value="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['img_slide1']); ?>">
            </div>
            <div class="mb-3">
                <label for="img_slide2" class="form-label">Image Slide 2 :</label><br>
                <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['img_slide2']); ?>" alt="Image Slide 2" style="width: 150px; height: auto; margin-bottom: 10px;">
                <input type="file" name="img_slide2" class="form-control" value="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['img_slide2']); ?>">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
                <a href="../admin/manage_clubs.php" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer1.php'; ?>
