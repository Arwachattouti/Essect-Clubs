<?php 
require '../includes/header1.php' ?> 
<div class="sidebar">
    <h4>Admin Panel</h4>
    <a href="statistics.php" class="nav-link">📊 Statistiques Globales </a>
    <a href="manage_clubs.php" class="nav-link">🏛️ Gérer les clubs</a>
    <a href="manage_users.php" class="nav-link">👥 Gérer les utilisateurs</a>
    <a href="manage_chef.php" class="nav-link">📩 Gérer les responsables de clubs </a>
    <a href="logout.php" class="nav-link">Deconnexion </a>
</div>
<div class="content">
    <h1 class="text-center">Tableau de bord de l'Administrateur</h1>
    <div id="content-area">
        <div class="container mt-4">
            <div class="alert alert-info">
                <h3>Bienvenue sur le tableau de bord de l'administrateur !</h3>
                <p>Vous êtes connecté en tant qu'administrateur. Utilisez les liens à gauche pour gérer les clubs, les utilisateurs et les responsables de clubs. Vous pouvez également consulter les statistiques globales du système.</p>
            </div>
        </div>
    </div>
</div>
<?php require '../includes/footer1.php' ?> 
