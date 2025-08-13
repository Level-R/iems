<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input = trim($_POST['userId'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($user_input) || empty($password)) {
        $error = urlencode("Username/email/phone and password are required.");
        header("Location: /iems/auth/login.php?error=$error");
        exit;
    }

    try {
        // Find user by username, email or phone
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :input OR email = :input OR phone_number = :input LIMIT 1");
        $stmt->execute([':input' => $user_input]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            // Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    $success = 'Login Successful!';
                    header("Location: /../iems/admin/index.php?success= $success");
                    break;
                case 'teacher':
                    $success = 'Login Successful!';
                    header("Location: /../iems/teacher/teacher-dashboard.php?success= $success");
                    break;
                case 'student':
                    $success = 'Login Successful!';
                    header("Location: /../iems/student/student-dashboard.php?success= $success");
                    break;
                case 'moderator':
                    $success = 'Login Successful!';
                    header("Location: /../iems/moderator/moderator-dashboard.php?success= $success");
                    break;
                default:
                    header("Location: /../iems/index.php");
                    break;
            }
            exit;
        } else {
            $error = urlencode("Invalid login credentials.");
            header("Location: /iems/auth/login.php?error=$error");
            exit;
        }
    } catch (PDOException $e) {
        error_log("Login Error: " . $e->getMessage());
        $error = urlencode("Server error. Please try again later.");
        header("Location: /iems/auth/login.php?error=$error");
        exit;
    }
} else {
    header("Location: /iems/auth/login.php?error=" . urlencode("Invalid request method."));
    exit;
}
