<?php 
require '../includes/header1.php' ;
$id = isset($_GET['id']) ? $_GET['id'] : null;
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
    <h1 class="text-center">Tableau de bord du Responsable du Club</h1>
    <div id="content-area">
        <div class="container mt-4">
            <div class="alert alert-info">
                <h3>Bienvenue sur le tableau de bord du responsable du club !</h3>
                <p>Vous êtes connecté en tant que responsable du club. Utilisez les liens à gauche pour gérer les membres de votre club, organiser les événements et consulter les statistiques relatives à votre club. Vous pouvez également voir les demandes et les interactions des utilisateurs avec votre club.</p>
            </div>
        </div>
    </div>
</div>

<?php require '../includes/footer1.php' ?> 
