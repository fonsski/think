<?php
require_once __DIR__ . '/../includes/functions.php';

$title = "Предметы";
$subjects = get_subjects();
require_once __DIR__ . '/../includes/header.php';
?>

<section class="subjects">
    <div class="container">
        <h1 class="section-title">Доступные предметы</h1>
        <div class="subjects__grid">
            <?php foreach ($subjects as $subject): ?>
            <div class="subject-card">
                <div class="subject-card__image">
                    <span class="material-icons"><?= h($subject['icon']) ?></span>
                </div>
                <div class="subject-card__content">
                    <h3><?= h($subject['title']) ?></h3>
                    <p><?= h($subject['description']) ?></p>
                    <a href="/subject/<?= urlencode($subject['slug']) ?>" 
                       class="btn btn--primary">Начать обучение</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
