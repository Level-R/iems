<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}require_once __DIR__ . '/../../config/db.php';
if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin'){
    header('Location: /iems/auth/login.php');
    exit;
}
// username
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT u.fname, u.lname, u.username, a.profile_image FROM admin a JOIN users u ON a.user_id = u.id WHERE a.user_id = ?');
$stmt->execute([$user_id]);
$admin = $stmt->fetch();
$admin_name = $admin ? $admin['fname'] . ' ' . $admin['lname'] : 'Admin';
$admin_username = $admin ? $admin['username'] : '';
// profile upload & check
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    $fileTmpPath = $_FILES['profile_image']['tmp_name'];
    $fileName = $_FILES['profile_image']['name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = 'admin_' . $user_id . '.' . $fileExtension;

    $uploadDir = __DIR__ . '/../../uploads/admin/';
    $uploadPath = $uploadDir . $newFileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
        $stmt = $conn->prepare("UPDATE admin SET profile_image = ? WHERE user_id = ?");
        $stmt->execute([$newFileName, $user_id]);

        header("Location: index.php?upload=success");
        exit;
    } else {
        $uploadError = "Error uploading file.";
    }
}
$profileImage = $admin['profile_image'] ?? null;

if ($profileImage) {
    $imagePath = "/iems/uploads/admin/" . $profileImage;
} else {
    $imagePath = "/iems/assets/img/default.png";
}

// count all 
$roles = ['admin','student', 'teacher', 'moderator', 'accounts'];
$counts = [];

try {
    foreach ($roles as $role) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = :role");
        $stmt->execute(['role' => $role]);
        $counts[$role] = $stmt->fetchColumn();
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
try {
  // Count users
  $stmt = $conn->prepare("SELECT COUNT(*) FROM users");
  $stmt->execute();
  $total_count = $stmt->fetchColumn();

  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
            
?>
