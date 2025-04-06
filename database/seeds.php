<?php
require_once __DIR__ . '/../includes/config.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Добавляем тестовые предметы
$subjects = [
    [
        'title' => 'Программирование',
        'slug' => 'programming',
        'description' => 'Изучите основы программирования, алгоритмы и структуры данных',
        'icon' => 'code'
    ],
    [
        'title' => 'Математика',
        'slug' => 'math',
        'description' => 'Базовые и продвинутые концепции математики',
        'icon' => 'functions'
    ]
];

foreach ($subjects as $subject) {
    $stmt = $db->prepare("INSERT IGNORE INTO subjects (title, slug, description, icon) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $subject['title'], $subject['slug'], $subject['description'], $subject['icon']);
    $stmt->execute();
}

// Добавляем тестовые уроки
$programming_id = $db->query("SELECT id FROM subjects WHERE slug = 'programming'")->fetch_object()->id;

$lessons = [
    [
        'subject_id' => $programming_id,
        'title' => 'Введение в программирование',
        'slug' => 'intro',
        'description' => 'Базовые концепции и принципы программирования',
        'order_number' => 1
    ],
    [
        'subject_id' => $programming_id,
        'title' => 'Переменные и типы данных',
        'slug' => 'variables',
        'description' => 'Работа с различными типами данных в программировании',
        'order_number' => 2
    ]
];

foreach ($lessons as $lesson) {
    $stmt = $db->prepare("INSERT IGNORE INTO lessons (subject_id, title, slug, description, order_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", 
        $lesson['subject_id'],
        $lesson['title'],
        $lesson['slug'],
        $lesson['description'],
        $lesson['order_number']
    );
    $stmt->execute();
}

echo "Тестовые данные добавлены!\n";
