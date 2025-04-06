<?php
if (!isset($subject)) {
    header("Location: /subjects");
    exit;
}

if (!function_exists('h')) {
    require_once __DIR__ . '/../includes/functions.php';
}

require 'includes/header.php';
?>

<section class="subject-page">
    <div class="container">
        <div class="subject-header">
            <h1 class="section-title"><?= h($subject['title']) ?></h1>
            <p class="subject-description"><?= h($subject['description']) ?></p>
        </div>
        
        <div class="lessons-list">
            <?php if (!empty($subject['lessons'])): ?>
                <?php foreach ($subject['lessons'] as $lesson): ?>
                <div class="lesson-card">
                    <span class="lesson-number">
                        <?= str_pad($lesson['order_number'], 2, '0', STR_PAD_LEFT) ?>
                    </span>
                    <div class="lesson-content">
                        <h3><?= h($lesson['title']) ?></h3>
                        <p><?= h($lesson['description']) ?></p>
                    </div>
                    <a href="/lesson/<?= $lesson['id'] ?>" class="btn btn--primary">
                        Начать урок
                    </a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <p>Уроки пока не добавлены</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
