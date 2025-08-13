<?php
require_once __DIR__ . '/../../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$allowedRoles = ['admin', 'teacher', 'student', 'moderator', 'accounts'];
$userRole = $_POST['user'] ?? ''; 
$user_id = $_POST['user_id'] ?? null;

// Check role validity
if (!in_array($userRole, $allowedRoles)) {
    $_SESSION['error'] = "Invalid role provided.";
    header("Location: /iems/admin/index.php");
    exit;
}

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: /iems/admin/manage-user.php?user=$userRole");
    exit;
}


if (!$userRole || !$user_id) {
    $_SESSION['error'] = "Invalid role or user ID.";
    header("Location: /iems/admin/manage-user.php?user=$userRole");
    exit;
}

if ($userRole === 'teacher') {
    // ==== TEACHER UPDATE ====
    $fname = preg_replace('/\s+/', ' ', trim($_POST['fname'] ?? ''));
    $lname = preg_replace('/\s+/', ' ', trim($_POST['lname'] ?? ''));
    $username = strtolower(trim($_POST['username'] ?? ''));
    $email = trim($_POST['email'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
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
    $status = trim($_POST['status'] ?? '');

    // if (
    //     empty($fname) || empty($lname) || empty($username) || empty($email) ||
    //     empty($phone_number) || empty($qualification) || empty($department) ||
    //     empty($subject) || empty($position) || empty($address) || empty($permanent_address) ||
    //     empty($national_id) || empty($blood_group) || empty($experience_years) ||
    //     empty($date_of_birth) || empty($gender) || empty($hiredate)
    // ) {
    //     $_SESSION['error'] = "All fields are required.";
    //     header("Location: /iems/admin/user-edit.php?user=teacher&id=$user_id");
    //     exit;
    // }
    if (empty($national_id)) {
        $_SESSION['error'] = "National ID is required.";
        header("Location: /iems/admin/user-edit.php?user=teacher&id=$user_id");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: /iems/admin/user-edit.php?user=teacher&id=$user_id");
        exit;
    }

    try {
        $conn->beginTransaction();

        // Update users table
        $stmtUser = $conn->prepare("UPDATE users SET fname = ?, lname = ?, username = ?, email = ?, phone_number = ?, status = ? WHERE id = ? AND role = 'teacher'");
        $stmtUser->execute([$fname, $lname, $username, $email, $phone_number, $status, $user_id]);

        // Update teachers table
        $stmtTeacher = $conn->prepare("
            UPDATE teachers SET 
                national_id = ?, qualification = ?, department = ?, subject_speciality = ?, 
                position = ?, address = ?, permanent_address = ?, blood_group = ?, 
                experience_years = ?, date_of_birth = ?, gender = ?, joining_date = ?
            WHERE user_id = ?
        ");
        $stmtTeacher->execute([
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
            $hiredate,
            $user_id
        ]);

        $conn->commit();

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '/iems/uploads/profile_pics/';
            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $imageName = time() . '_' . basename($_FILES['profile_pic']['name']);
            $imageTmpPath = $_FILES['profile_pic']['tmp_name'];
            $targetFilePath = $uploadPath . $imageName;

            if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
                $imageURL = $uploadDir . $imageName;

                // DB-তে আপডেট করো
                $stmt = $conn->prepare("UPDATE teachers SET profile_pic = ? WHERE user_id = ?");
                $stmt->execute([$imageURL, $user_id]);
            } else {
                $_SESSION['error'] = "Image upload failed.";
            }
        }

        $_SESSION['success'] = "Teacher updated successfully.";
        header("Location: /iems/admin/manage-user.php?user=$userRole");
        exit;
    } catch (PDOException $e) {
        $conn->rollBack();
        $_SESSION['error'] = "Update failed: " . $e->getMessage();
        header("Location: /iems/admin/user-edit.php?user=teacher&id=$user_id");
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
