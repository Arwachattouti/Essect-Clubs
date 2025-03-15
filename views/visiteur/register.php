<?php
require_once __DIR__ . '/../../controllers/ClubController.php';
$controller = new ClubController();
$clubs = $controller->afficherClubs();

include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/css/styleregister.css">
</head>

   
    <center>
        <?php
        require_once __DIR__ . '/../../controllers/UserController.php';
        $controller = new UserController();
        $error = $controller->register();
        ?>

        <div class="container">
            <div class="login-container">
                <h2>Créer un compte</h2>
                <form action="register.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <label for="username">Nom complet</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" id="phone" name="phone">
                    </div>
                    <div class="input-group">
                        <label for="profile_image">Photo de profil</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*">
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" id="consent" name="consent" required>
                        <label for="consent">J'accepte les conditions d'utilisation et la politique de confidentialité</label>
                    </div><br>
                    <button type="submit">S'inscrire</button>
                    <?php if (!empty($error)): ?>
                        <div style="color: red;">
                            <p><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php endif; ?>
                </form>
                <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
            </div>
        </div>
    </center>

<?php include '../includes/footer.php'; ?>
