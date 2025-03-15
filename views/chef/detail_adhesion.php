<?php
include '../includes/header1.php';
require_once __DIR__ . '/../../controllers/AdhesionController.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$idadhesion=isset($_GET['idA']) ? intval($_GET['idA']) : null;
$controller = new AdhesionController();
$adhesion = $controller->getAdhesionById($idadhesion);

if (!$adhesion) {
    echo "<p class='text-center text-danger'>Aucune information trouvée pour cette adhésion.</p>";
    exit;
}
?>
<div class="sidebar">
    <h4> Chef Panel</h4>
    <a href="manage_club.php?id=<?php echo $id; ?>" class="nav-link"> 🏫 Gérer le profil du club </a>
    <a href="manage_members.php?id=<?php echo $id; ?>" class="nav-link"> 📜 Consulter la liste des Membres</a>
    <a href="manage_adhesion.php?id=<?php echo $id; ?>" class="nav-link"> ✅ Gérer les demandes d'adhésion</a>
    <a href="manage_events.php?id=<?php echo $id; ?>" class="nav-link"> 🎉 Gérer les événements et actualités liés au club </a>
    <a href="manage_statistics.php?id=<?php echo $id; ?>" class="nav-link"> 📊 Consulter les statistiques du club </a>
    <a href="logout.php?id=<?php echo $id; ?>" class="nav-link"> 🚪 Déconnexion </a>
</div>
<div class="container mt-5">
    <h2>Détails de l'Adhésion</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations du candidat</h5>
            <p><strong>Nom complet:</strong> <?= htmlspecialchars($adhesion['full_name']); ?></p>
            <p><strong>Date de naissance:</strong> <?= htmlspecialchars($adhesion['birthdate']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($adhesion['email']); ?></p>
            <p><strong>Téléphone:</strong> <?= htmlspecialchars($adhesion['phone']); ?></p>
            <p><strong>Genre:</strong> <?= htmlspecialchars($adhesion['gender']); ?></p>
            <p><strong>Compétences:</strong> <?= nl2br(htmlspecialchars($adhesion['skills'])); ?></p>
            <p><strong>Loisirs:</strong> <?= nl2br(htmlspecialchars($adhesion['hobbies'])); ?></p>
            <p><strong>Motivation:</strong> <?= nl2br(htmlspecialchars($adhesion['reason'])); ?></p>

            <h5 class="mt-4">CV du candidat</h5>
                <?php
                    $cv_file = basename($adhesion['cv_pdf_path']);
                    $cv_path = '/clubs/public/uploads/' . $cv_file;
                    $full_cv_path = __DIR__ . '/../../public/uploads/' . $cv_file;

                    echo "<!-- DEBUG: CV enregistré dans la BDD : " . $adhesion['cv_pdf_path'] . " -->";
                    echo "<!-- DEBUG: Chemin complet attendu : " . $full_cv_path . " -->";

                    if (!empty($adhesion['cv_pdf_path']) && file_exists($full_cv_path)) :
                ?>
                    <p>
                        📄 <a href="<?= $cv_path; ?>" target="_blank" class="btn btn-primary">Ouvrir le CV</a>
                        <a href="<?= $cv_path; ?>" download class="btn btn-success">Télécharger le CV</a>
                    </p>
                <?php else : ?>
                    <p class="text-danger">⚠️ Aucun CV disponible.</p>
                <?php endif; ?>
            <h5 class="mt-4">Statut de l'adhésion</h5>
            <p>
                <span class="badge bg-<?= $adhesion['statut'] == 'accepté' ? 'success' : ($adhesion['statut'] == 'refusé' ? 'danger' : 'warning'); ?>">
                    <?= htmlspecialchars($adhesion['statut']); ?>
                </span>
            </p>
            <a href="manage_adhesion.php?id=<?= $id; ?>" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>

<?php include '../includes/footer1.php'; ?>
