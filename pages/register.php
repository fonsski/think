<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/Auth.php';

$title = "Регистрация";
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    
    if (empty($email) || empty($password) || empty($name)) {
        $error = 'Все поля обязательны для заполнения';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Неверный формат email';
    } elseif (strlen($password) < 6) {
        $error = 'Пароль должен быть не менее 6 символов';
    } else {
        if (Auth::getInstance()->register($email, $password, $name)) {
            $success = 'Регистрация успешна. Теперь вы можете войти.';
        } else {
            $error = 'Email уже используется';
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<section class="auth-page">
    <div class="container">
        <div class="auth-form">
            <h1 class="section-title">Регистрация</h1>
            
            <?php if ($error): ?>
                <div class="alert alert--error"><?= h($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert--success"><?= h($success) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="/register">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" required minlength="6">
                </div>
                
                <button type="submit" class="btn btn--primary">Зарегистрироваться</button>
            </form>
            
            <div class="auth-links">
                <span>Уже есть аккаунт?</span>
                <a href="/login">Войти</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
