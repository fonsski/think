<?php
require_once 'config.php';
require_once 'db.php';

// Вспомогательные функции
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function get_page_title($title = '') {
    return $title ? h($title) . ' | ' . SITE_NAME : SITE_NAME;
}

// Базовые функции
function handle_error($message, $code = 500) {
    http_response_code($code);
    if (DEBUG_MODE) {
        die($message);
    } else {
        error_log($message);
        require 'pages/error.php';
        exit;
    }
}

function get_subjects() {
    $db = DB::getInstance();
    $result = $db->query("SELECT * FROM subjects ORDER BY created_at DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function validate_slug($slug) {
    return preg_match('/^[a-z0-9-]+$/', $slug);
}

function get_subject($slug) {
    if (!validate_slug($slug)) {
        handle_error('Invalid slug format', 400);
    }
    
    $db = DB::getInstance();
    $stmt = $db->prepare("SELECT * FROM subjects WHERE slug = ?");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $subject = $stmt->get_result()->fetch_assoc();
    
    if ($subject) {
        $stmt = $db->prepare("SELECT * FROM lessons WHERE subject_id = ? ORDER BY order_number");
        $stmt->bind_param("i", $subject['id']);
        $stmt->execute();
        $subject['lessons'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    return $subject;
}

function get_lesson($id) {
    $db = DB::getInstance();
    $stmt = $db->prepare("
        SELECT l.*, s.title as subject_title 
        FROM lessons l 
        JOIN subjects s ON l.subject_id = s.id 
        WHERE l.id = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $lesson = $stmt->get_result()->fetch_assoc();
    
    if ($lesson) {
        $lesson['has_test'] = check_lesson_test($id);
    }
    
    return $lesson;
}

function check_lesson_test($lesson_id) {
    $db = DB::getInstance();
    $stmt = $db->prepare("SELECT COUNT(*) as count FROM tests WHERE lesson_id = ?");
    $stmt->bind_param("i", $lesson_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['count'] > 0;
}

function get_lesson_content($id) {
    $db = DB::getInstance();
    $stmt = $db->prepare("SELECT content FROM lessons WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result ? $result['content'] : '';
}

function update_lesson_progress($user_id, $lesson_id, $status) {
    $db = DB::getInstance();
    $stmt = $db->prepare("
        INSERT INTO user_progress (user_id, lesson_id, status) 
        VALUES (?, ?, ?) 
        ON DUPLICATE KEY UPDATE status = ?
    ");
    $stmt->bind_param("iiss", $user_id, $lesson_id, $status, $status);
    return $stmt->execute();
}

function get_lesson_progress($user_id, $lesson_id) {
    $db = DB::getInstance();
    $stmt = $db->prepare("
        SELECT status 
        FROM user_progress 
        WHERE user_id = ? AND lesson_id = ?
    ");
    $stmt->bind_param("ii", $user_id, $lesson_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result ? $result['status'] : null;
}
