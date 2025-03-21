<?php 
require_once __DIR__ . '/../../controllers/ClubController.php';
require_once __DIR__ . '/../../controllers/AdhesionController.php';
include '../includes/header2.php'; // Si supprimé, le code fonctionne 

$id = isset($_GET['id']) ? $_GET['id'] : null;
$controller1 = new ClubController();
$clubs = $controller1->afficherClubs(); 
$controller2 = new AdhesionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller2->request($id); 
}
?>
<br><br>
<center>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= BASE_URL; ?>/public/css/stylejoin.css"> 
    </head>
    <body>
    <div class="login-container">
    <h2>Postuler à un club</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-section">
            <div class="input-group">
                <label for="full_name">Nom et Prénom :</label><br>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="input-group">
                <label for="email">Adresse Email :</label><br>
                <input type="email" id="email" name="email" required>
            </div>
        </div>
        <div class="form-section">
            <div class="input-group">
                <label for="birthdate">Date de Naissance :</label><br>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>
            <div class="input-group">
                <label for="phone">Numéro de Téléphone :</label><br>
                <input type="tel" id="phone" name="phone" required>
            </div>
        </div>
        <div class="form-section">
            <div class="input-group">
                <label for="gender">Genre :</label><br>
                <select id="gender" name="gender" required>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
            </div>
            <div class="input-group">
                <label for="club_id">Choisissez un Club :</label><br>
                <select id="club_id" name="club_id" required>
                    <?php
                    if (!empty($clubs)) {
                        foreach ($clubs as $club) {
                            echo '<option value="' . $club['id'] . '">' . $club['nom'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Aucun club disponible</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-section">
            <div class="input-group">
                <label for="skills">Compétences :</label><br>
                <textarea id="skills" name="skills" required></textarea>
            </div>
            <div class="input-group">
                <label for="hobbies">Loisirs :</label><br>
                <textarea id="hobbies" name="hobbies" required></textarea>
            </div>
        </div>
        <div class="form-section">
            <div class="input-group">
                <label for="cv">Télécharger le CV (PDF, DOC, DOCX) :</label><br>
                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
            </div>
            <div class="input-group">
                <label for="reason">Motivation pour rejoindre :</label><br>
                <textarea id="reason" name="reason" required></textarea>
            </div>
        </div>

        <button type="submit">Envoyer la Candidature</button>
    </form>
</div>

</center>

<br><br>
<?php require '../includes/footer2.php'; ?>
