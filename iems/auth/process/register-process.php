<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/db.php'; // PDO connection from db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Input sanitize and trim
        $fname = preg_replace('/\s+/', ' ', trim($_POST['fname'] ?? ''));
        $lname = preg_replace('/\s+/', ' ', trim($_POST['lname'] ?? ''));
        $username = strtolower(trim($_POST['username'] ?? ''));
        $email = trim($_POST['email'] ?? '');
        $phone_number = trim($_POST['phone_number'] ?? '');
        $raw_password = $_POST['password'] ?? '';

        // Validate required fields
        if (empty($fname) || empty($lname) || empty($username) || empty($email) || empty($phone_number) || empty($raw_password)) {
            throw new Exception("All fields are required.");
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        // Validate Bangladeshi phone number format
        if (!preg_match('/^01[3-9][0-9]{8}$/', $phone_number)) {
            throw new Exception("Invalid Bangladeshi phone number.");
        }

        // Validate password length
        if (strlen($raw_password) < 6) {
            throw new Exception("Password must be at least 6 characters.");
        }

        // Check for duplicate user
        $checkSql = 'SELECT * FROM users WHERE username = ? OR email = ? OR phone_number = ? LIMIT 1';
        $stmt = $conn->prepare($checkSql);
        $stmt->execute([$username, $email, $phone_number]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            if ($existingUser['username'] === $username) {
                throw new Exception("Username already taken.");
            } elseif ($existingUser['email'] === $email) {
                throw new Exception("Email already taken.");
            } elseif ($existingUser['phone_number'] === $phone_number) {
                throw new Exception("Phone number already in use.");
            } else {
                throw new Exception("User already exists.");
            }
        }

        // Count total users to assign role
        $stmt = $conn->query("SELECT COUNT(*) AS total FROM users");//0
        $row = $stmt->fetch();
        $userCount = $row['total'] ?? 0;
        $role = ($userCount == 0) ? 'admin' : 'student';

        // Hash password
        $hashedPassword = password_hash($raw_password, PASSWORD_DEFAULT);

        // Insert new user
        $insertSql = 'INSERT INTO users (fname, lname, username, email, phone_number, password, role)
                      VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($insertSql);
        $stmt->execute([$fname, $lname, $username, $email, $phone_number, $hashedPassword, $role]);

        // Success redirect
        $success = urlencode("Account created successfully. You can now log in.");
        header("Location: ../login.php?success=$success");
        exit;

    } catch (Exception $e) {
        $error = urlencode(htmlspecialchars($e->getMessage()));
        header("Location: ../register.php?error=$error");
        exit;
    }
} else {
    $error = urlencode("Invalid request method.");
    header("Location: ../register.php?error=$error");
    exit;
}
