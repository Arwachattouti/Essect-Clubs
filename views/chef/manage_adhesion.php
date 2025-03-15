<?php
session_start();
include '../includes/header1.php';
require_once __DIR__ . '/../../controllers/AdhesionController.php';

$club_id = isset($_GET['id']) ? $_GET['id'] : null;
$controller = new AdhesionController();
$adhesions = $controller->afficheradhesionbyid($club_id);
$departements = $controller->getDepartementsByClub($club_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['adhesion_id'])) {
    $adhesion_id = $_POST['adhesion_id'];

    if ($_POST['action'] === 'accept' && isset($_POST['departement_id'])) {
        $departement_id = $_POST['departement_id'];
        $controller->accept($club_id, $adhesion_id, $departement_id);
    } elseif ($_POST['action'] === 'reject') {
        $controller->reject($adhesion_id, $club_id);
    }
}
?>

<div class="sidebar">
    <h4>Chef Panel</h4>
    <a href="manage_club.php?id=<?= $club_id; ?>" class="nav-link">🏫 Gérer le profil du club</a>
    <a href="manage_members.php?id=<?= $club_id; ?>" class="nav-link">📜 Consulter la liste des Membres</a>
    <a href="manage_adhesion.php?id=<?= $club_id; ?>" class="nav-link">✅ Gérer les demandes d'adhésion</a>
    <a href="manage_events.php?id=<?= $club_id; ?>" class="nav-link">🎉 Gérer les événements et actualités</a>
    <a href="manage_statistics.php?id=<?= $club_id; ?>" class="nav-link">📊 Consulter les statistiques</a>
    <a href="logout.php?id=<?= $club_id; ?>" class="nav-link">🚪 Déconnexion</a>
</div>

<div class="content">
    <div id="content-area">
        <div class="container mt-4">
            <h2 class="text-center">Liste des demandes d'adhésion</h2>
            <?php if (empty($adhesions)): ?>
                <p class="text-center text-muted">Aucune demande d'adhésion pour le moment.</p>
            <?php else: ?>
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom Complet</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($adhesions as $adhesion): ?>
                            <tr>
                                <td><?= htmlspecialchars($adhesion['id']); ?></td>
                                <td><?= htmlspecialchars($adhesion['full_name']); ?></td>
                                <td><?= htmlspecialchars($adhesion['email']); ?></td>
                                <td><?= htmlspecialchars($adhesion['phone']); ?></td>
                                <td>
                                    <span class="badge bg-<?= $adhesion['statut'] == 'accepté' ? 'success' : ($adhesion['statut'] == 'refusé' ? 'danger' : 'warning'); ?>">
                                        <?= htmlspecialchars($adhesion['statut']); ?>
                                    </span>
                                </td>
                                <td>
                                    <form action="manage_adhesion.php?id=<?= $club_id; ?>" method="POST" class="d-inline">
                                        <input type="hidden" name="adhesion_id" value="<?= $adhesion['id']; ?>">
                                        <input type="hidden" name="action" value="accept">
                                        <select name="departement_id" class="form-select form-select-sm" required>
                                            <option value="">Sélectionner un département</option>
                                            <?php foreach ($departements as $departement): ?>
                                                <option value="<?= $departement['id']; ?>"><?= htmlspecialchars($departement['nom']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn btn-success btn-sm mt-1">Accepter</button>
                                    </form>

                                    <form action="manage_adhesion.php?id=<?= $club_id; ?>" method="POST" class="d-inline">
                                        <input type="hidden" name="adhesion_id" value="<?= $adhesion['id']; ?>">
                                        <input type="hidden" name="action" value="reject">
                                        <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                                    </form>

                                    <!-- Bouton "Détails" menant à une nouvelle page -->
                                    <a href="detail_adhesion.php?idA=<?= $adhesion['id']; ?>&id=<?= $club_id; ?>" class="btn btn-info btn-sm">Détails</a>
                                 </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer1.php'; ?>


