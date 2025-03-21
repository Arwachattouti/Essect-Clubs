<?php
require_once __DIR__ . '/../../controllers/ClubController.php';
$controller = new ClubController();
$clubs = $controller->afficherClubs(); 
?>
<div class="container-fluid bg-dark footer mt-1 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <img src="/clubs/public/img/logos/logo.png" width="200" alt="logo ESSECT" class="mb-3"/>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Contact</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>4, Rue Abou Zakaria El Hafsi - 1089 Montfleury - Tunis - 1089 Tunis</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+216 71 330 266</p>
                <div class="d-flex pt-3">
                    <a class="btn btn-square btn-light rounded-circle me-2" href="https://www.facebook.com/essec.tunis" aria-label="Facebook">
                        <i class="fab fa-facebook-f icon-color"></i>
                    </a>
                    <a class="btn btn-square btn-light rounded-circle me-2" href="https://www.youtube.com/@essectofficiel3421" aria-label="YouTube">
                        <i class="fab fa-youtube icon-color"></i>
                    </a>
                    <a class="btn btn-square btn-light rounded-circle me-2" href="https://www.linkedin.com/in/essect-de-tunis-page-officielle-0170b432b/" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in icon-color"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="row">
                    <h4 class="text-white mb-4">Liens rapides</h4>
                    <div class="col-6">
                        <a class="btn btn-link" href="listeclubs.php#aboutUSindex">À propos</a>
                        <a class="btn btn-link" href="contact.php">Contact</a>
                        <a class="btn btn-link" href="listeclubs.php#unitIndex">Clubs</a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-link" href="listeclubs.php#">Accueil</a>
                        <?php
                        if (!empty($clubs)) {
                            foreach ($clubs as $club) {
                                echo '<a href="detailclub.php?id=' . $club['id'] . '" class="btn btn-link">' . $club['nom'] . '</a>';
                            }
                        } else {
                            echo '<p>Aucun club trouvé.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Localisation</h4>
                <iframe src="https://www.google.com/maps/place/ESSECT,+Ave+Ali+Trad,+Tunis/@36.7870863,10.1722683,17z/data=!3m1!4b1!4m6!3m5!1s0x12fd3408c0a06d69:0x3b8c5efde9487a09!8m2!3d36.7870061!4d10.1747904!16s%2Fg%2F11bvth663s?entry=ttu&g_ep=EgoyMDI1MDIyNS4wIKXMDSoASAFQAw%3D%3D" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/clubs/public/lib/wow/wow.min.js"></script>
<script src="/clubs/public/lib/easing/easing.min.js"></script>
<script src="/clubs/public/lib/waypoints/waypoints.min.js"></script>
<script src="/clubs/public/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="/clubs/public/lib/lightbox/js/lightbox.min.js"></script>
<script src="/clubs/public/js/main.js"></script>
</body>
</html>


