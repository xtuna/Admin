<section id="storeSection">
    <h1 class="mt-4">Stores</h1>
    <div class="row">
        <?php
        include('../db.php');
        $stmt = $pdo->prepare("SELECT id, name, image FROM stores");
        $stmt->execute();
        $stores = $stmt->fetchAll();

        foreach ($stores as $store): ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($store['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($store['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($store['name']) ?></h5>
                        <a href="edit_store.php?id=<?= $store['id'] ?>" class="btn btn-warning btn-sm">EDIT</a>
                        <a href="delete_store.php?id=<?= $store['id'] ?>" class="btn btn-danger btn-sm">DELETE</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
