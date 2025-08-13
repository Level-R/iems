<?php
require_once __DIR__ . '/../../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$allowedRoles = ['admin', 'teacher', 'student', 'moderator', 'accounts'];
$userRole = $_GET['user'] ?? '';

if (!in_array($userRole, $allowedRoles)) {
    $_SESSION['error'] = "Invalid role provided.";
    header("Location: /iems/admin/index.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['error'] = "Invalid teacher ID.";
    header("Location: /iems/admin/manage-user.php?user=$userRole");
    exit;
}

if ($userRole === 'teacher') {
// Join users + teachers table
$stmt = $conn->prepare("
    SELECT 
        u.id AS user_id,
        t.id AS teacher_id,
        u.*, 
        t.* 
    FROM users u
    JOIN teachers t ON u.id = t.user_id
    WHERE u.id = ? AND u.role = 'teacher'
");
$stmt->execute([$id]);
$teacher = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$teacher) {
    $_SESSION['error'] = "Teacher not found.";
    header("Location: /iems/admin/manage-user.php?user=$userRole");
    exit;
}
}

    
// if ($userRole === 'student') {
//     // student টেবিলে insert করার কোড এখানে হবে
// } 
// elseif ($userRole === 'moderator') {
//     // moderator টেবিলে insert করার কোড এখানে হবে
// } elseif ($userRole === 'accounts') {
//     // accounts টেবিলে insert করার কোড এখানে হবে
// }
?>
