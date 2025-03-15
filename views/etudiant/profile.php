<?php
include '../includes/header2.php';
require_once __DIR__ . '/../../controllers/UserController.php';
require_once __DIR__ . '/../../controllers/MemberController.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$controller = new UserController();
$etudiant = $controller->afficherProfil($id);
$controller1 = new MemberController();
$Membre = $controller1->getprofil($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $userController = new UserController();
    $userController->mettreAJourProfil($id, $username, $email, $phone);
    header('Location: profile.php?id=' . $id );
    exit;
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h2 class="card-title mb-4 text-primary">Profil de <?= htmlspecialchars($etudiant['username']) ?></h2>

                    <img src="/clubs/public/img/clubsessect/<?= htmlspecialchars($etudiant['profile_image'] ?: 'default.png') ?>" 
                         alt="Photo de profil" class="rounded-circle img-thumbnail mb-4" width="150" style="border: 3px solid #007bff;">

                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($etudiant['id']) ?>">

                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($etudiant['username']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($etudiant['email']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-telephone"></i></div>
                                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($etudiant['phone']) ?>" required>
                            </div>
                        </div>

                        <?php if (!empty($Membre)): ?>
                            <div class="row mt-4">
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm border-light">
                                        <div class="card-body">
                                            <h5 class="card-title text-center mb-3">
                                                <i class="bi bi-house-door-fill text-primary" style="font-size: 2rem;"></i>
                                            </h5>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">Club</h6>
                                            <p class="card-text text-center"><?= htmlspecialchars($Membre['club_nom']) ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm border-light">
                                        <div class="card-body">
                                            <h5 class="card-title text-center mb-3">
                                                <i class="bi bi-person-badge-fill text-success" style="font-size: 2rem;"></i>
                                            </h5>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">Statut du Membre</h6>
                                            <p class="card-text text-center"><?= htmlspecialchars($Membre['statut_membre']) ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm border-light">
                                        <div class="card-body">
                                            <h5 class="card-title text-center mb-3">
                                                <i class="bi bi-building-fill text-info" style="font-size: 2rem;"></i>
                                            </h5>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">Département</h6>
                                            <p class="card-text text-center"><?= htmlspecialchars($Membre['departement']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary btn-lg mt-4 w-100">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>


