
<?php include_once __DIR__ . '/../includes/header1.php'; ?>

<div class="container mt-4">
    <h2 class="text-center">Liste des Départements</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="create_departement.php" class="btn btn-primary">+ Ajouter un Département</a>
    </div>

    <?php if (empty($departements)): ?>
        <p class="alert alert-warning text-center">Aucun département trouvé.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($departements as $departement): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($departement['nom']) ?>
                    <div>
                        <a href="edit_departement.php?id=<?= $departement['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete_departement.php?id=<?= $departement['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce département ?');">Supprimer</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../includes/footer1.php'; ?>