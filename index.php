<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/Auth.php';

$auth = Auth::getInstance();
$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home', 'subjects', 'subject', 'login', 'register', 'lesson', 'logout', '404'];
$protected_pages = ['lesson', 'sandbox', 'tests'];

// Проверяем авторизацию для защищенных страниц
if (in_array($page, $protected_pages) && !$auth->isLoggedIn()) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: /login");
    exit;
}

// Перенаправляем авторизованных пользователей с страниц логина/регистрации
if (($page === 'login' || $page === 'register') && $auth->isLoggedIn()) {
    header("Location: /subjects");
    exit;
}

if (in_array($page, $allowed_pages)) {
    // Обработка параметров страниц
    switch ($page) {
        case 'subject':
            $slug = $_GET['slug'] ?? '';
            $subject = get_subject($slug);
            if (!$subject) {
                header("Location: /subjects");
                exit;
            }
            $title = $subject['title'];
            break;
            
        case 'lesson':
            $lesson_id = $_GET['id'] ?? null;
            if (!$lesson_id || !get_lesson($lesson_id)) {
                header("Location: /subjects");
                exit;
            }
            break;
    }
    
    require PAGES_DIR . "/{$page}.php";
} else {
    header("HTTP/1.0 404 Not Found");
    require PAGES_DIR . '/404.php';
}

require_once COMPONENTS_DIR . "/header.php";
?>
<?php
require_once COMPONENTS_DIR . "/footer.php";
?>