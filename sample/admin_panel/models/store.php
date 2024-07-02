<?php
include('../db.php');

$stmt = $pdo->query("SELECT * FROM stores");
$stores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h1>Stores</h1>
    <div class="row">
        <?php foreach ($stores as $store): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="../<?= htmlspecialchars($store['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($store['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($store['name']) ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
