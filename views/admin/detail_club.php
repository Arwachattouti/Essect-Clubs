<?php 
include '../includes/header1.php';
require_once __DIR__ .'/../../controllers/ClubController.php';
require_once __DIR__ .'/../../controllers/BureauController.php';
require_once __DIR__ .'/../../controllers/DepartementController.php';
$id = intval($_GET['id']);
$clubController = new ClubController();
$club = $clubController->getClubById($id);
if (!$club) {
    die("Club non trouvé");
}
$bureauController = new BureauController();
$departementController = new DepartementController();
$bureauMembres = $bureauController->getBureauMembersByClubId($id);
$departements = $departementController->getDepartementsByClubId($id);

function displayList($items, $emptyMessage, $type) {
    if (empty($items)) {
        echo '<p>' . htmlspecialchars($emptyMessage) . '</p>';
        return;
    }
    echo '<div class="bureau-container">';

    foreach ($items as $item) {
        switch ($type) {
            case 'bureau':
                echo '<div class="bureau-item">';  
                echo '<article class="event-item">';
                echo '<center><header><h3>' . htmlspecialchars($item['username']) . '</h3></header></center>';
             
                echo '<center><p class="bureau-responsabilite">' . htmlspecialchars($item['responsabilite']) . '</p></center>';
            
                echo '<footer class="event-actions">';
                echo '<center><a href="../admin/edit_bureau.php?id=' . $item['id']  . '" class="btn-edit">✏️ Modifier</a></center>';
                echo '</footer>';
                echo '</article>';
                echo '</div>';  
                break;
        
    
            case 'departement':
               
                echo '<article class="departement-item">';
                echo '<header><h3>' . htmlspecialchars($item['nom']) . '</h3></header>';
                echo '<p class="departement-description">' . htmlspecialchars($item['description'] ?? 'Aucune description disponible') . '</p>';
                echo '<footer class="departement-actions">';
                echo '<a href="../admin/edit_departement.php?dept_id=' . $item['id'] . '&club_id=' . $item['club_id'].'" class="btn-edit">✏️ Modifier</a>';
                echo ' | ';
                echo '<a href="../admin/delete_departement.php?dept_id=' . $item['id'] . '&club_id=' . $item['club_id'].'" class="btn-delete" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce département ?\');">🗑️ Supprimer</a>';
                echo '</footer>';
                echo '</article>';
               break;
    
               
            default:
                echo "</div>";
                break;
        }
    }
        echo '</div>';   
}
?>
<style>
    body {
        height: 300vh;
    }
    .bureau-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px; 
    justify-content: space-between; 
}

.bureau-item {
    width: 30%; 
    box-sizing: border-box;
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
        <div class="card shadow-lg p-4">
            <h1 class="text-center text-primary"><?php echo htmlspecialchars($club['nom']); ?></h1>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Description :</strong> <?php echo nl2br(htmlspecialchars($club['description'])); ?></p>
                    <p><strong>Date de création :</strong> <?php echo htmlspecialchars($club['date_creation']); ?></p>
                    <p><strong>Nombre de membres:</strong> <?php echo htmlspecialchars($club['nb_membre']); ?></p>
                    <p><strong>Nombre de partenaires :</strong> <?php echo htmlspecialchars($club['nb_partenaires']); ?></p>
                    
                    <?php if (!empty($club['facebook_link'])): ?>
                        <p><strong>Facebook :</strong> 
                            <a href="<?php echo htmlspecialchars($club['facebook_link']); ?>" target="_blank" class="btn btn-primary btn-sm">
                                <i class="bi bi-facebook"></i> Page Facebook
                            </a>
                        </p>
                    <?php endif; ?>
                    
                    <?php if (!empty($club['instagram_link'])): ?>
                        <p><strong>Instagram :</strong> 
                            <a href="<?php echo htmlspecialchars($club['instagram_link']); ?>" target="_blank" class="btn btn-danger btn-sm">
                                <i class="bi bi-instagram"></i> Profil Instagram
                            </a>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 text-center">
                    <?php if (!empty($club['logo'])): ?>
                        <p><strong>Logo :</strong></p>
                        <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['logo']); ?>" alt="Logo du Club" class="img-fluid rounded shadow" style="max-width: 150px;">
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mt-4">
                <?php if (!empty($club['img_slide1'])): ?>
                    <div class="col-md-6 text-center">
                        <p><strong>Image Slide 1 :</strong></p>
                        <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['img_slide1']); ?>" alt="Slide 1" class="img-fluid rounded shadow">
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($club['img_slide2'])): ?>
                    <div class="col-md-6 text-center">
                        <p><strong>Image Slide 2 :</strong></p>
                        <img src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['img_slide2']); ?>" alt="Slide 2" class="img-fluid rounded shadow">
                    </div>
                <?php endif; ?>
            </div>

            <hr>

            
<div class="card shadow-sm p-4 mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2 class="text-primary">Membres du bureau</h2>
            <a href="create_bureau.php?id=<?php echo $id; ?>" class="btn btn-success mb-3">
                + Ajouter un membre
            </a>

            <?php 
                if (!empty($bureauMembres)) {
                    displayList($bureauMembres, "Aucun membre du bureau trouvé.", "bureau");
                } else {
                    echo "<p>Aucun membre du bureau trouvé.</p>";
                }
            ?>
        </div>
    </div>
    <div class="row">
       <div class="col-md-6">
            <h2 class="text-primary">Départements</h2>
            <a href="create_departement.php?id=<?php echo $id; ?>" class="btn btn-success mb-3">
                + Ajouter un département
            </a>
            <?php 
                if (!empty($departements)) {
                    displayList($departements, "Aucun département trouvé.", "departement");
                } else {
                    echo "<p>Aucun département trouvé.</p>";
                }
            ?>
        </div>
    </div>
</div>


            <div class="text-center mt-4">
                <a href="manage_clubs.php" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</div>



<?php include '../includes/footer1.php'; ?>