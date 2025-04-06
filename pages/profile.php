<?php
require_once __DIR__ . '/../includes/functions.php';
$auth = Auth::getInstance();
$auth->requireAuth();

$user = $auth->getCurrentUser();
$title = "Профиль - " . h($user['name']);

require_once __DIR__ . '/../includes/header.php';
?>

<section class="profile-page">
    <div class="container">
        <div class="profile-header">
            <div class="profile-info">
                <span class="material-icons profile-avatar">account_circle</span>
                <div class="profile-details">
                    <h1 class="section-title"><?= h($user['name']) ?></h1>
                    <p class="profile-email"><?= h($user['email']) ?></p>
                </div>
            </div>
            <div class="profile-actions">
                <a href="/profile/edit" class="btn btn--secondary">
                    <span class="material-icons">edit</span>
                    Редактировать профиль
                </a>
            </div>
        </div>

        <div class="profile-content">
            <div class="profile-stats">
                <div class="stat-card">
                    <span class="material-icons">school</span>
                    <h3>Изучено уроков</h3>
                    <p class="stat-value">12</p>
                </div>
                <div class="stat-card">
                    <span class="material-icons">quiz</span>
                    <h3>Пройдено тестов</h3>
                    <p class="stat-value">5</p>
                </div>
                <div class="stat-card">
                    <span class="material-icons">emoji_events</span>
                    <h3>Достижений</h3>
                    <p class="stat-value">3</p>
                </div>
            </div>

            <div class="recent-activity">
                <h2>Последняя активность</h2>
                <div class="activity-list">
                    <!-- Здесь будет список последних действий -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
