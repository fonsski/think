<?php 
require_once __DIR__ . '/functions.php';
if (!isset($auth)) {
    $auth = Auth::getInstance();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0f172a">
    <title><?= get_page_title($title ?? '') ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <header class="header">
        <div class="container header__inner">
            <a href="/" class="logo"><?= SITE_NAME ?></a>
            <nav class="nav">
                <ul class="nav__menu">
                    <li>
                        <a href="/subjects" class="nav__link">
                            <span class="material-icons">library_books</span>
                            Предметы
                        </a>
                    </li>
                    <?php if ($auth->isLoggedIn()): ?>
                        <li>
                            <a href="/sandbox" class="nav__link">
                                <span class="material-icons">code</span>
                                Песочница
                            </a>
                        </li>
                        <li>
                            <a href="/tests" class="nav__link">
                                <span class="material-icons">quiz</span>
                                Тесты
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="nav__auth">
                    <?php if ($auth->isLoggedIn()): ?>
                        <a href="/profile" class="nav__link">
                            <span class="material-icons">account_circle</span>
                            Профиль
                        </a>
                        <a href="/logout" class="btn btn--secondary">
                            <span class="material-icons">logout</span>
                            Выйти
                        </a>
                    <?php else: ?>
                        <a href="/login" class="btn btn--primary">
                            <span class="material-icons">login</span>
                            Войти
                        </a>
                        <a href="/register" class="btn btn--secondary">
                            <span class="material-icons">person_add</span>
                            Регистрация
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
            <div class="header__actions">
                <button class="mobile-menu-toggle" aria-label="Меню">
                    <span class="material-icons">menu</span>
                </button>
            </div>
        </div>
    </header>
    <main>
