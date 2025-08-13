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

if ($userRole === 'teacher') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fname = preg_replace('/\s+/', ' ', trim($_POST['fname'] ?? ''));
        $lname = preg_replace('/\s+/', ' ', trim($_POST['lname'] ?? ''));
        $username = strtolower(trim($_POST['username'] ?? ''));
        $email = trim($_POST['email'] ?? '');
        $phone_number = trim($_POST['phone_number'] ?? '');
        $passwordRaw = $_POST['password'] ?? '';

        $national_id = trim($_POST['national_id'] ?? '');
        $qualification = trim($_POST['qualification'] ?? '');
        $department = trim($_POST['department'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $permanent_address = trim($_POST['permanent_address'] ?? '');
        $blood_group = trim($_POST['blood_group'] ?? '');
        $experience_years = trim($_POST['experience_years'] ?? '');
        $date_of_birth = trim($_POST['date_of_birth'] ?? '');
        $gender = trim($_POST['gender'] ?? '');
        $hiredate = trim($_POST['hiredate'] ?? '');

        // ✅ Full field validation
        if (
            empty($fname) || empty($lname) || empty($username) || empty($email) ||
            empty($phone_number) || empty($passwordRaw) || empty($qualification) ||
            empty($department) || empty($subject) || empty($position) ||
            empty($address) || empty($permanent_address) || empty($national_id) ||
            empty($blood_group) || empty($experience_years) || empty($date_of_birth) ||
            empty($gender) || empty($hiredate)
        ) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: /iems/admin/new-user.php?user=$userRole");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format.";
            header("Location: /iems/admin/new-user.php?user=$userRole");
            exit;
        }

        $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmtCheck->execute([$username, $email]);
        if ($stmtCheck->fetchColumn() > 0) {
            $_SESSION['error'] = "Username or email already exists.";
            header("Location: /iems/admin/new-user.php?user=$userRole");
            exit;
        }

        $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

        try {
            $conn->beginTransaction();

            // ✅ Insert into users
            $stmtUser = $conn->prepare("INSERT INTO users (fname, lname, username, email, phone_number, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmtUser->execute([$fname, $lname, $username, $email, $phone_number, $password, $userRole]);
            $user_id = $conn->lastInsertId();

            // ✅ Insert into teachers (with all new fields)
            $stmtTeacher = $conn->prepare("INSERT INTO teachers (user_id, national_id, qualification, department, subject_speciality, position, address, permanent_address, blood_group, experience_years, date_of_birth, gender, joining_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtTeacher->execute([
                $user_id,
                $national_id,
                $qualification,
                $department,
                $subject,
                $position,
                $address,
                $permanent_address,
                $blood_group,
                $experience_years,
                $date_of_birth,
                $gender,
                $hiredate
            ]);

            $conn->commit();

            $_SESSION['success'] = ucfirst($userRole) . " account created successfully.";
            header("Location: /iems/admin/new-user.php?user=" . urlencode($userRole));
            exit;
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            header("Location: /iems/admin/new-user.php?user=$userRole");
            exit;
        }
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