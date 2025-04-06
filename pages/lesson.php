<?php
if (!function_exists('get_lesson')) {
    require_once __DIR__ . '/../includes/functions.php';
}

$lesson_id = $_GET['id'] ?? null;
if (!$lesson_id) {
    header("Location: /subjects");
    exit;
}

$lesson = get_lesson($lesson_id);
if (!$lesson) {
    header("Location: /subjects");
    exit;
}

$title = $lesson['title'];
require 'includes/header.php';
?>

<section class="lesson-page">
    <div class="container">
        <div class="lesson-header">
            <h1 class="section-title"><?= h($lesson['title']) ?></h1>
        </div>
        
        <div class="lesson-content">
            <?= $lesson['content'] ?>
        </div>
        
        <?php if ($lesson['has_test']): ?>
        <div class="lesson-actions">
            <a href="/test/<?= $lesson['id'] ?>" class="btn btn--primary">
                Пройти тест
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
