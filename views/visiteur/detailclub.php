<?php 
require_once __DIR__ . '/../../controllers/ClubController.php';
include '../includes/header.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1; 
$controller = new ClubController();
$club = $controller->afficherClubById($id); 

require_once __DIR__ . '/../../controllers/DepartementController.php';
$departementController = new DepartementController();
$departements = $departementController->getDepartementsByClubId($id);
?>

<body>
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" style="max-height: 80vh !important;" src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars ($club['img_slide1']) ?>" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-lg-7 text-end">
                                    <p class="fs-4 text-white animated slideInLeft"><strong><?php echo htmlspecialchars($club['nom']); ?></strong></p>
                                    <img class="display-1 text-white mb-5 animated slideInLeft" src="" width="500"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" style="max-height: 80vh !important;" src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['img_slide2'])?>" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7 text-start">
                                    <p class="fs-4 text-white animated slideInRight"><strong><?php echo htmlspecialchars($club['nom']); ?></strong></p>
                                    <img class="display-1 text-white mb-4 animated slideInRight" src="" width="500"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container-xxl py-4">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="display-6 mb-5 text-warning">Présentation du club</h1>
                <p class="fs-5 fw-medium"><?php echo htmlspecialchars($club['description']) ?></p>
            </div>
        </div>
    </div>

    <div id="aboutUSindex" class="container-xxl py-5 text-center">
        <div class="container">
            <div class="row g-0 feature-row">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="feature-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="/clubs/public/img/icon/group.png" alt="Icon">
                        </div>
                        <h5 class="mb-3">Les Membres </h5>
                        <h4 class="mb-0" id="membersValue"><?php echo htmlspecialchars($club['nb_membre']) ?></h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="feature-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="/clubs/public/img/icon/handshake.png" alt="Icon">
                        </div>
                        <h5 class="mb-3">Les Partenaires </h5>
                        <h4 class="mb-0" id="partnershipValue"><?php echo htmlspecialchars($club['nb_partenaires']) ?></h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="feature-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="/clubs/public/img/icon/schedule.png" alt="Icon">
                        </div>
                        <h5 class="mb-3">Date de début</h5>
                        <h4 class="mb-0" id="startingYearValue"><?php echo date('d M Y', strtotime($club['date_creation'])); ?></h4>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="feature-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="/clubs/public/img/icon/project.png" alt="Icon">
                        </div>
                        <h5 class="mb-3">Les Evénements</h5>
                        <h4 class="mb-0" id="projectsValue"><?php echo htmlspecialchars( $club['nb_evenements']) ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    require_once __DIR__ . '/../../controllers/BureauController.php';
    if (class_exists('BureauController')) {
        $controller3 = new BureauController();
        $bureau = $controller3->getBureauMembersByClubId($id);
    } else {
        die("Erreur : Classe BureauController non trouvée.");
    }
    ?>

    <div id="teamindex" class="container-xxl py-4 d-flex justify-content-center">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium text-warning">Bureau Exécutif</p>
                <h4 class="display-6 mb-3">2025-2026 Mandat</h4>
            </div>
            <div class="row g-4 justify-content-center">
                <?php
                foreach ($bureau as $membre) {
                    echo '<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">';
                    echo '<div class="team-item rounded overflow-hidden pb-4">';
                    echo '<img class="img-fluid mb-4" src="/clubs/public/img/clubsessect/' . htmlspecialchars($membre['profile_image']) . '" alt="Image de ' . htmlspecialchars($membre['username']) . '">';
                    echo '<h5>' . htmlspecialchars($membre['username']) . '</h5>';
                    if (isset($membre['responsabilite'])) {
                        echo '<span class="text-black-50">' . htmlspecialchars($membre['responsabilite']) . '</span>';
                    } else {
                        echo '<span class="text-black-50">Responsabilité non définie</span>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div id="departments" class="container-xxl py-5 text-center">
    <div class="container">
        <h2 class="display-6 mb-5 ">Nos Départements</h2>
        <div class="row g-4">
            <?php foreach ($departements as $departement) : ?>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="department-item border h-100 p-5">
                        <h4 class="mb-3"><?= htmlspecialchars($departement['nom']) ?></h4>
                        <p class="fs-5"><?= htmlspecialchars($departement['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

    <?php 
    require_once __DIR__ . '/../../controllers/EventController.php';
    if (class_exists('EventController')) {
        $controller2 = new EventController();
        $events = $controller2->affichereventbyid($id);
    } else {
        die("Erreur : Classe EventController non trouvée.");
    }
    ?>

<div class="container-xxl py-4">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
            <h4 class="display-6 mb-4">Nos Événements</h4>
            <section>
                <div class="scroller event" data-direction="left" data-speed="slow">
                    <div class="scroller__inner">
                        <?php foreach ($events as $event) : ?>
                            <div class="card-ev">
                                <img src="<?= htmlspecialchars($event['image_principale']) ?>" alt="<?= htmlspecialchars($event['titre']) ?>" class="event-image" />
                                <div class="event-details">
                                    <h5 class="event-title"><?= htmlspecialchars($event['titre']) ?></h5>
                                    <p class="event-club"><?= htmlspecialchars($event['club_name']) ?></p>
                                    <p class="event-date"><?= date("d/m/Y", strtotime($event['date'])) ?></p>
                                    <p class="event-description"><?= htmlspecialchars($event['description']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


<?php include '../includes/footer.php'; ?>

