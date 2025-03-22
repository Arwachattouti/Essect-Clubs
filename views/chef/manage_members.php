<?php 
session_start();
require_once __DIR__ . '/../../controllers/MemberController.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$controller = new MemberController();
$members = $controller->getAllMembers($id); 
include '../includes/header1.php';  
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
<div class="content">
    <div class="container mt-5">
        <h2 class="text-center">Gestion des Membres 
            <?php 
            if (!empty($members) && isset($members[0]['club'])) {
                echo htmlspecialchars($members[0]['club']);
            } else {
                echo "du Club";
            }
            ?>
        </h2>

        <?php  
         if (!empty($_SESSION['success_message'])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success_message']) . "</div>";
            unset($_SESSION['success_message']);
        }
        if (!empty($_SESSION['error_message'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error_message']) . "</div>";
            unset($_SESSION['error_message']);
        }
        ?>

        <?php if (!empty($members)): ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Département</th>
                    <th>Date d'adhésion</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($member['id']); ?></td>
                        <td><?php echo htmlspecialchars($member['username']); ?></td>
                        <td><?php echo htmlspecialchars($member['email']); ?></td>
                        <td><?php echo !empty($member['departement']) ? htmlspecialchars($member['departement']) : "Aucun département"; ?></td>
                        <td><?php echo htmlspecialchars($member['date_adhesion']); ?></td>
                        <td><?php echo ($member['statut_membre'] == 'actif') ? '✔ Actif' : '❌ Inactif'; ?></td>
                        <td>
                        <a href="edit_member.php?idm=<?php echo htmlspecialchars($member['id']); ?>&id=<?php echo htmlspecialchars($id); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete_member.php?idm=<?php echo htmlspecialchars($member['id']); ?>&id=<?php echo htmlspecialchars($id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">Aucun membre trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer1.php'; ?>
