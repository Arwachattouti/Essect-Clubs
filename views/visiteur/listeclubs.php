<?php
require_once __DIR__ . '/../../controllers/ClubController.php';
include '../includes/header.php';
$controller = new ClubController();
$clubs = $controller->afficherClubs(); 
?>
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="/clubs/public/img/4.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-7 text-start">
                                <p class="fs-4 text-white animated slideInRight"><strong>ESSECT CLUBS</strong> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="/clubs/public/img/3.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-lg-7 text-end">
                                <p class="fs-4 text-white animated slideInLeft"><strong>ESSECT CLUBS</strong> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Aprés</span>
        </button>
    </div>
</div>
<div id="unitIndex" class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-5">Nos Clubs</h1>
        </div>
        <div class="row g-4">
            <?php 
            if (empty($clubs)) {
                echo "<p>Aucun club trouvé.</p>";
            } else {
                foreach ($clubs as $club) : ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item position-relative h-100">
                            <div class="service-text rounded p-5">
                                <div class="btn-square mx-auto mb-4" style="width: 64px; height: 64px;">
                                    <img style="width: 300%;" src="/clubs/public/img/clubsessect/<?php echo htmlspecialchars($club['logo']); ?>" alt="Icon">
                                </div>
                                <h5 class="mb-3"><?php echo htmlspecialchars($club['nom']); ?></h5>
                                <p class="mb-0"><?php echo htmlspecialchars($club['description']); ?></p>
                            </div>
                            <div class="service-btn rounded-0 rounded-bottom">
                                <a class="text-primary fw-medium" href="detailclub.php?id=<?php echo $club['id']; ?>">Voir plus<i class="bi bi-chevron-double-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; 
            }
            ?>  
        </div>
    </div>
</div>

    <div class="container-xxl py-4">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" >
                <h1 class="display-6 mb-3">Jetez un œil à notre galerie</h1>
                <section>
                    <div class="scroller" data-direction="left" data-speed="slow">
                        <div class="scroller__inner">
                            <img src="/clubs/public/img/gallery/0.jpg" alt=""   />   
                            <img src="/clubs/public/img/gallery/1.jpg" alt="" />   
                            <img src="/clubs/public/img/gallery/5.jpg" alt=""  />   
                            <img src="/clubs/public/img/gallery/6.jpg" alt=""  />   
                            <img src="/clubs/public/img/gallery/7.jpg" alt="" />   
                            <img src="/clubs/public/img/gallery/0.png" alt="" />   
                            <img src="/clubs/public/img/gallery/1.png" alt="" />   
                            <img src="/clubs/public/img/gallery/2.png" alt="" />   
                            <img src="/clubs/public/img/gallery/3.png" alt="" />   
                            <img src="/clubs/public/img/gallery/4.png" alt="" />   
                            <img src="/clubs/public/img/gallery/5.png" alt="" /> 
                            <img src="/clubs/public/img/gallery/6.png" alt="" />   
                            <img src="/clubs/public/img/gallery/7.png" alt="" /> 
                            <img src="/clubs/public/img/gallery/8.png" alt="" />  
                        </div>
                    </div>
                    <div class="scroller" data-direction="left" data-speed="slow">
                        <div class="scroller__inner border-text">
                        <h3>Créer des souvenirs</h3>
                        <h3>Capturer des moments</h3>
                        <h3>Des moments à se souvenir</h3>
                        <h3>Des moments inoubliables</h3>

                        </div>
                    </div>
                    <div class="scroller" data-direction="right" data-speed="slow">
                       <div class="scroller__inner">
                        <img src="/clubs/public/img/gallery/8.png" alt="" />   
                        <img src="/clubs/public/img/gallery/7.png" alt="" />   
                        <img src="/clubs/public/img/gallery/6.png" alt="" />   
                        <img src="/clubs/public/img/gallery/5.png" alt="" />   
                        <img src="/clubs/public/img/gallery/4.png" alt="" />   
                        <img src="/clubs/public/img/gallery/3.png" alt="" /> 
                        <img src="/clubs/public/img/gallery/2.png" alt="" />   
                        <img src="/clubs/public/img/gallery/1.png" alt="" /> 
                        <img src="/clubs/public/img/gallery/0.png" alt="" />    
                        <img src="/clubs/public/img/gallery/7.jpg" alt=""   />   
                        <img src="/clubs/public/img/gallery/6.jpg" alt="" />   
                        <img src="/clubs/public/img/gallery/1.jpg" alt=""  />   
                        <img src="/clubs/public/img/gallery/5.jpg" alt=""  />   
                        <img src="/clubs/public/img/gallery/0.jpg" alt="" />   
                    </div>
                    </div>
                 </section>
                 <script>
                    const scrollers = document.querySelectorAll(".scroller");
                    if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
                    addAnimation();
                    }
                    function addAnimation() {
                    scrollers.forEach((scroller) => {
                       scroller.setAttribute("data-animated", true);
                       const scrollerInner = scroller.querySelector(".scroller__inner");
                       const scrollerContent = Array.from(scrollerInner.children);
                       scrollerContent.forEach((item) => {
                          const duplicatedItem = item.cloneNode(true);
                          duplicatedItem.setAttribute("aria-hidden", true);
                          scrollerInner.appendChild(duplicatedItem);
                       });
                    });
                    }
                 </script>
            </div>
        </div>
    </div>

    <script>
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                element.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
        animateValue(document.getElementById("membersValue"), 0, 220, 2000); 
        animateValue(document.getElementById("partnershipValue"), 0, 5, 1500); 
        animateValue(document.getElementById("projectsValue"), 0, 15, 2500); 
        animateValue(document.getElementById("startingYearValue"), 2024, 2013, 2500);
    </script>
<?php include '../includes/footer.php'; ?>