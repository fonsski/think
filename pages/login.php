<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/Auth.php';

$title = "Вход в систему";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (Auth::getInstance()->login($email, $password)) {
        header('Location: /');
        exit;
    } else {
        $error = 'Неверный email или пароль';
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<section class="auth-page">
    <div class="container">
        <div class="auth-form">
            <h1 class="section-title">Вход в систему</h1>
            
            <?php if ($error): ?>
                <div class="alert alert--error"><?= h($error) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="/login">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn--primary">Войти</button>
            </form>
            
            <div class="auth-links">
                <a href="/register">Регистрация</a>
                <a href="/forgot-password">Забыли пароль?</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
