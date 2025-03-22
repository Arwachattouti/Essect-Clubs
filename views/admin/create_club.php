<?php include '../includes/header1.php'; 
require_once __DIR__ . '/../../controllers/ClubController.php';
$controller = new ClubController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create();
} 
?>
<style>
    body{
        height: 120vh;
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
    <h2>Ajouter un Club</h2>
    <form action="create_club.php" method="POST" enctype="multipart/form-data">
        
        
        <div class="form-group">
            <label for="nom">Nom du Club</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>

        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        
        <div class="form-group">
            <label for="date_creation">Date de Création</label>
            <input type="date" class="form-control" id="date_creation" name="date_creation" required>
        </div>

        
        <div class="form-group">
            <label for="facebook_link">Lien Facebook</label>
            <input type="url" class="form-control" id="facebook_link" name="facebook_link">
        </div>

       
        <div class="form-group">
            <label for="instagram_link">Lien Instagram</label>
            <input type="url" class="form-control" id="instagram_link" name="instagram_link">
        </div>

       
        <div class="form-group">
            <label for="nb_membre">Nombre des membres</label>
            <input type="number" class="form-control" id="nb_membre" name="nb_membre" value="0">
        </div>
        <div class="form-group">
            <label for="nb_partenaires">Nombre de Partenaires</label>
            <input type="number" class="form-control" id="nb_partenaires" name="nb_partenaires" value="0">
        </div>
        <div class="form-group">
            <label for="logo">Logo de club </label>
            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="img_slide1">Image Slide 1</label>
            <input type="file" class="form-control" id="img_slide1" name="img_slide1" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="img_slide2">Image Slide 2</label>
            <input type="file" class="form-control" id="img_slide2" name="img_slide2" accept="image/*" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Ajouter le Club</button>
    </form>
</div>

</div>
<?php include '../includes/footer1.php'; ?>
