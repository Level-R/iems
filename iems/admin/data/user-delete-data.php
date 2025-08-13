<?php 
include_once __DIR__ . '/../../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$allowedRoles = ['admin', 'teacher', 'student', 'moderator', 'accounts'];

$userRole = $_POST['user'] ?? $_GET['user'] ?? '';  
$user_id   = $_POST['user_id'] ?? $_GET['id'] ?? null;

if (!in_array($userRole, $allowedRoles)) {
    $_SESSION['error'] = "Invalid role provided.";
    header("Location: /iems/admin/manage-user.php?user=$userRole");
    exit;
}

if (!$user_id) {
    $_SESSION['error'] = "Invalid user ID.";
    header("Location: /iems/admin/manage-user.php?user=$userRole");
    exit;
}

if($userRole === 'teacher'){
    try {
        // এখানে শুধু users table থেকে delete করলেই হবে, কারণ foreign key ON DELETE CASCADE আছে
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role = ?");
        $stmt->execute([$user_id, $userRole]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = ucfirst($userRole) . " deleted successfully.";
        } else {
            $_SESSION['error'] = ucfirst($userRole) . " not found or already deleted.";
        }

        header("Location: /iems/admin/manage-user.php?user=$userRole");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Delete failed: " . $e->getMessage();
        header("Location: /iems/admin/manage-user.php?user=$userRole");
        exit;
    }
}
// ==== STUDENT UPDATE ====
elseif ($userRole === 'student') {
    // তুমি চাইলে এখানে student update code লিখতে পারো
    $_SESSION['info'] = "Student update coming soon...";
    header("Location: /iems/admin/manage-user.php?user=student");
    exit;
}

// ==== ACCOUNTS UPDATE ====
elseif ($userRole === 'accounts') {
    // তুমি চাইলে এখানে accounts update code লিখতে পারো
    $_SESSION['info'] = "Accounts update coming soon...";
    header("Location: /iems/admin/manage-user.php?user=accounts");
    exit;
}

// ==== MODERATOR UPDATE ====
elseif ($userRole === 'moderator') {
    // তুমি চাইলে এখানে moderator update code লিখতে পারো
    $_SESSION['info'] = "Moderator update coming soon...";
    header("Location: /iems/admin/manage-user.php?user=moderator");
    exit;
} else {
    $_SESSION['error'] = "Unsupported role: $userRole";
    header("Location: /iems/admin/manage-user.php");
    exit;
}

?>