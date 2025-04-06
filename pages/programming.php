<?php
$title = "Программирование";
require 'includes/header.php';
?>

<section class="subject-page">
    <div class="container">
        <div class="subject-header">
            <h1 class="section-title">Программирование</h1>
            <p class="subject-description">Изучите основы программирования, алгоритмы и структуры данных</p>
        </div>
        
        <div class="lessons-list">
            <div class="lesson-card">
                <span class="lesson-number">01</span>
                <div class="lesson-content">
                    <h3>Введение в программирование</h3>
                    <p>Базовые концепции и принципы программирования</p>
                </div>
                <a href="/lesson/1" class="btn btn--primary">Начать урок</a>
            </div>
            
            <div class="lesson-card">
                <span class="lesson-number">02</span>
                <div class="lesson-content">
                    <h3>Переменные и типы данных</h3>
                    <p>Работа с различными типами данных в программировании</p>
                </div>
                <a href="/lesson/2" class="btn btn--primary">Начать урок</a>
            </div>
        </div>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
