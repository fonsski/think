<?php 
$title = "Главная страница";
require_once __DIR__ . '/../includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1 class="hero__title">Современная образовательная платформа</h1>
        <p class="hero__subtitle">Изучайте, практикуйтесь и развивайтесь вместе с нами</p>
        <a href="/subjects" class="btn btn--primary">Начать обучение</a>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="features__grid">
            <div class="feature-card">
                <h3 class="feature-card__title">Интерактивные курсы</h3>
                <p class="feature-card__text">Погрузитесь в мир знаний с нашими интерактивными материалами</p>
            </div>
            <div class="feature-card">
                <h3 class="feature-card__title">Практические задания</h3>
                <p class="feature-card__text">Закрепляйте знания через выполнение реальных задач</p>
            </div>
            <div class="feature-card">
                <h3 class="feature-card__title">Песочница для кода</h3>
                <p class="feature-card__text">Экспериментируйте с кодом в безопасной среде</p>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
