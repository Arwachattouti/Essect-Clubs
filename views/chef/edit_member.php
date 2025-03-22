<?php
session_start();
require_once __DIR__ . '/../../controllers/MemberController.php';
require_once __DIR__ . '/../../controllers/DepartementController.php';
$departementController = new DepartementController();
$departements = $departementController->getAllDepartementss();

$controller = new MemberController();

$idclub = isset($_GET['id']) ? $_GET['id'] : null;

$id = isset($_GET['idm']) ? $_GET['idm'] : null;
$member = $controller->getMember($id);
if (!$member) {
    $_SESSION['error_message'] = "Membre introuvable.";
    header("Location: manage_members.php?id=".$idclub);
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $departement = isset($_POST['departement']) ? intval($_POST['departement']) : 0;
    $statut = isset($_POST['statut']) ? $_POST['statut'] : '';

    if (empty($username) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $departement == 0 || !in_array($statut, ['actif', 'inactif'])) {
        $_SESSION['error_message'] = "Veuillez remplir tous les champs correctement.";
    } else {
        $controller->updateMember($id, $username, $email, $departement, $statut);
        $_SESSION['success_message'] = "Membre modifié avec succès.";
        header("Location: manage_members.php?id=".$idclub);
        exit();
    }
}

include '../includes/header1.php';
?>

<div class="sidebar">
    <h4> Chef Panel</h4>
    <a href="manage_club.php?id=<?php echo $idclub; ?>" class="nav-link"> 🏫 Gérer le profil du club </a>
    <a href="manage_members.php?id=<?php echo $idclub; ?>" class="nav-link"> 📜 Consulter la liste des Membres</a>
    <a href="manage_adhesion.php?id=<?php echo $idclub; ?>" class="nav-link"> ✅ Gérer les demandes d'adhésion</a>
    <a href="manage_events.php?id=<?php echo $idclub; ?>" class="nav-link"> 🎉 Gérer les événements et actualités liés au club </a>
    <a href="manage_statistics.php?id=<?php echo $idclub; ?>" class="nav-link"> 📊 Consulter les statistiques du club </a>
    <a href="logout.php?id=<?php echo $idclub; ?>" class="nav-link"> 🚪 Déconnexion </a>
</div>
<div class="content">
    <div class="container mt-5">
        <h2>Modifier un membre</h2>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>Nom d'utilisateur :</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($member['username']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($member['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Département :</label>
                <select name="departement" class="form-control" required>
                    <?php
                    foreach ($departements as $dep) {
                        $selected = ($dep['id'] == $member['departement_id']) ? 'selected' : '';
                        echo "<option value='{$dep['id']}' $selected>{$dep['nom']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Statut :</label>
                <select name="statut" class="form-control" required>
                    <option value="actif" <?php echo ($member['statut_membre'] === 'actif') ? 'selected' : ''; ?>>✔ Actif</option>
                    <option value="inactif" <?php echo ($member['statut_membre'] === 'inactif') ? 'selected' : ''; ?>>❌ Inactif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="manage_members.php?id=<?php echo htmlspecialchars($idclub); ?>" class="btn btn-secondary">Annuler</a>
            </form>
    </div>
</div>

<?php include '../includes/footer1.php'; ?>

