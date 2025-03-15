<?php
require_once __DIR__ . '/../../controllers/ClubController.php';
require_once __DIR__ . '/../../controllers/UserController.php';

include '../includes/header.php'; 
// Initialisation des contrôleurs
$clubController = new ClubController();
$clubs = $clubController->afficherClubs();
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->login(); // Appeler la méthode de connexion
}
?>

<br><br><br>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/css/stylelogin.css"> 
</head>
<body>
    <!-- Début du formulaire de connexion -->
    <center>
        <div class="login-container">
            <h2>Connexion</h2>
            <form action="" method="POST">
                <!-- Champ pour le nom d'utilisateur -->
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" value="<?= htmlspecialchars($username ?? '') ?>" required>
                </div>

                <!-- Champ pour l'email -->
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>" required>
                </div>

                <!-- Champ pour le mot de passe -->
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                </div>

                <!-- Case à cocher "Se souvenir de moi" -->
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div><br>

                <button type="submit">Se connecter</button>

                <!-- Afficher le message d'erreur si défini -->
                <?php if (!empty($_SESSION['error'])): ?>
                    <div style="color: red; margin-bottom: 10px;">
                        <?php 
                            echo $_SESSION['error']; 
                            unset($_SESSION['error']); // Effacer l'erreur après l'affichage
                        ?>
                    </div>
                <?php endif; ?>
            </form>

            <p>Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
        </div>
    </center><br><br><br><br>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
