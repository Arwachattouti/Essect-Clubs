<?php 
require_once __DIR__ . '/../../controllers/StatisticsController.php';
$controller = new StatisticsController();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$stats = $controller->getStatisticschef($id);
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
<style>
    body{
        height:150vh;}
</style>
<div class="content">
    <div class="container mt-5">
        <h3>Résumé des Statistiques</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total des membres</h5>
                        <p class="card-text display-4"><?php echo htmlspecialchars($stats['total_members'] ?? '0'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <h5 class="card-title">Demandes reçues</h5>
                        <p class="display-4"><?php echo htmlspecialchars(
                            ($stats['accepted_requests'] ?? 0) + 
                            ($stats['pending_requests'] ?? 0) + 
                            ($stats['rejected_requests'] ?? 0)
                        ); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white text-center">
                    <div class="card-body">
                        <h5 class="card-title">Événements organisés</h5>
                        <p class="display-4"><?php echo htmlspecialchars($stats['total_events'] ?? '0'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white text-center">
                    <div class="card-body">
                        <h5 class="card-title">Taux de participation</h5>
                        <p class="display-4"><?php echo htmlspecialchars($stats['participation_rate'] ?? '0') . '%'; ?></p>
                    </div>
                </div>
            </div>
        </div>
<div class="mt-5">
    <canvas id="eventParticipationChart" class="mt-4"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const eventData = {
        labels: ['Événements passés', 'Membres participants'],
        datasets: [{
            data: [
                <?php echo ($stats['total_events'] ?? 0); ?>, 
                <?php echo ($stats['total_participations'] ?? 0); ?>
            ],
            backgroundColor: ['#007bff', '#17a2b8']
        }]
    };

    new Chart(document.getElementById('eventParticipationChart'), {
        type: 'bar',
        data: eventData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include '../includes/footer1.php'; ?>
