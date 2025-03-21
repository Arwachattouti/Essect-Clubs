<?php 
require_once __DIR__ . '/../../controllers/StatisticsController.php';
$controller = new StatisticsController();
$stats = $controller->getStatisticsadmin();
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
<div class="content">
    <div class="container mt-5">
        <h2>Statistiques</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Nombre total de clubs</h5>
                        <p class="card-text display-4"><?php echo htmlspecialchars($stats['total_clubs']); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Nombre total d'étudiants inscrits</h5>
                        <p class="card-text display-4"><?php echo htmlspecialchars($stats['total_students']); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Demandes d'adhésion en attente</h5>
                        <p class="card-text display-4"><?php echo htmlspecialchars($stats['pending_adhesions']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <h3>Statistiques par club</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom du Club</th>
                    <th>Nombre de Membres enregistrés</th>
                    <th>Nombre d'événements enregistrés</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats['clubs'] as $club): ?>
                <tr>
                    <td><?php echo htmlspecialchars($club['nom']); ?></td>
                    <td><?php echo htmlspecialchars($club['nb_membres']); ?></td>
                    <td><?php echo htmlspecialchars($club['nb_evenements']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-5">
            <h3>Répartition des Membres et des Événements</h3>
            <div class="row">
                <div class="col-md-6">
                    <h5>Répartition des Membres Actifs par Club</h5>
                    <canvas id="membersByClubChart"></canvas>
                </div>
                <div class="col-md-6">
                    <h5>Nombre d'Événements Organisés par Club</h5>
                    <canvas id="eventsByClubChart"></canvas>
                </div>
            </div>
        </div>

        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const membersByClubData = {
        labels: <?php echo json_encode(array_column($stats['clubs'], 'nom')); ?>,
        datasets: [{
            label: 'Nombre de Membres',
            data: <?php echo json_encode(array_column($stats['clubs'], 'nb_membres')); ?>,
            backgroundColor: '#28a745', // Vert
            borderColor: '#218838',
            borderWidth: 1
        }]
    };

    const membersByClubConfig = {
        type: 'bar',
        data: membersByClubData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    const eventsByClubData = {
        labels: <?php echo json_encode(array_column($stats['clubs'], 'nom')); ?>,
        datasets: [{
            label: 'Nombre d\'Événements',
            data: <?php echo json_encode(array_column($stats['clubs'], 'nb_evenements')); ?>,
            backgroundColor: '#007bff', 
            borderColor: '#0062cc',
            borderWidth: 1
        }]
    };

    const eventsByClubConfig = {
        type: 'bar',
        data: eventsByClubData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    new Chart(document.getElementById('membersByClubChart'), membersByClubConfig);
    new Chart(document.getElementById('eventsByClubChart'), eventsByClubConfig);
</script>

<?php include '../includes/footer1.php'; ?>
