<?php
require_once __DIR__ . '/../../controllers/ClubController.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$controller = new ClubController();
$clubs = $controller->afficherClubs();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clubs ESSECT</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="/clubs/public/img/logos/logo.png" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/clubs/public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/clubs/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/clubs/public/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="/clubs/public/css/bootstrap.min.css" rel="stylesheet">    
    <link href="/clubs/public/css/style1.css" rel="stylesheet">
</head>

<body>
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">
                <a href="listeclubs.php?id=<?php echo $id; ?>" class="navbar-brand d-lg-none">
                    <img src="/clubs/public/img/logos/logo.png" width="150">
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="listeclubs.php?id=<?php echo $id; ?>" class="nav-item nav-link active" style="color:black;">Accueil</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color:black;">Clubs</a>
                            <div class="dropdown-menu bg-light rounded-0 rounded-bottom m-0">
                                <?php
                                if (!empty($clubs)) {
                                    foreach ($clubs as $club) {
                                        echo '<a href="detailclub.php?idclub=' . $club['id'] . '&id=' . $id . '" class="dropdown-item">' . $club['nom'] . '</a>';
                                    }
                                } else {
                                    echo '<p>Aucun club trouvé.</p>';
                                }
                                ?>
                            </div>
                        </div>
                        <a href="joinclub.php?id=<?php echo $id; ?>" class="nav-item nav-link" style="color:black;">Rejoindre un club</a>
                        <a href="suivi_demande.php?id=<?php echo $id; ?>" class="nav-item nav-link" style="color:black;">Suivi de la demande</a>
                        <a href="profile.php?id=<?php echo $id; ?>" class="nav-item nav-link" style="color:black;">Profil</a>
                        <a href="logout.php?id=<?php echo $id; ?>" class="nav-item nav-link" style="color:black;">Déconnexion</a>
                    </div>
                    <div class="ms-auto d-none d-lg-block">
                        <img src="/clubs/public/img/logos/logo.png" width="100">
                    </div>
                </div>
            </nav>
        </div>
    </div>
