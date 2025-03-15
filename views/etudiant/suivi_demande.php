<?php
require_once __DIR__ . '/../../controllers/AdhesionController.php';
include '../includes/header2.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $controller = new AdhesionController();
    $demandes = $controller->afficheradhesionbyiduser($id);
    echo '<div class="container mt-5">';
    if (!empty($demandes)) {
        echo '<h2 class="text-center mb-4">Suivi des demandes d\'adhésion</h2>';
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-hover">';
        echo '<thead class="table-dark"><tr><th>ID</th><th>Club</th><th>Nom complet</th><th>Email</th><th>Statut</th><th>CV</th></tr></thead>';
        echo '<tbody>';
        foreach ($demandes as $demande) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($demande['id']) . '</td>';
            echo '<td>' . htmlspecialchars($demande['club_id']) . '</td>'; 
            echo '<td>' . htmlspecialchars($demande['full_name']) . '</td>';
            echo '<td>' . htmlspecialchars($demande['email']) . '</td>';
            echo '<td>';
            $statutClass = '';
            if ($demande['statut'] == 'accepté') {
                $statutClass = 'text-success';
            } elseif ($demande['statut'] == 'refusé') {
                $statutClass = 'text-danger';
            } else {
                $statutClass = 'text-warning';
            }
            echo '<span class="' . $statutClass . '">' . htmlspecialchars($demande['statut']) . '</span>';
            echo '</td>';
            echo '<td><a class="btn btn-info" href="/clubs/public/uploads/' . htmlspecialchars($demande['cv_pdf_path']) . '" target="_blank">Voir le CV</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
       
        echo '<div class="alert alert-warning" role="alert">Aucune demande d\'adhésion trouvée pour cet étudiant.</div>';
    }
} else {
  
    echo '<div class="alert alert-danger" role="alert">ID utilisateur non spécifié.</div>';
}
echo '</div>';
?>
<style>
    
html, body {
    height: 100%;
    margin: 0;
}

.container {
    min-height: 100%; 
    display: flex;
    flex-direction: column;
}
.main-content {
    flex-grow: 1;
}
footer {
    background-color: #f8f9fa;
    padding: 10px 0;
    text-align: center;
    width: 100%;
    position: relative;
    bottom: 0;
    left: 0;
}
</style>
<?php include '../includes/footer.php'; ?>