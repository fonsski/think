<?php
require_once __DIR__ . '/../includes/Auth.php';

Auth::getInstance()->logout();
header('Location: /');
exit;
