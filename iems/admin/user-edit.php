<?php include_once __DIR__ . '/data/index-data.php'; ?>
<?php include_once __DIR__ . '/data/user-edit-data.php'; ?>
<?php $pageTitle = "Admin Dashboard";
include __DIR__ . '/../includes/header.php'; ?>

<header>
    <nav class="navbar fixed-top" style="background-color: #232E57;" data-bs-theme="light">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand lobster-two-bold d-flex align-items-center">
                <span class="text-danger">I</span><span class="text-light">E</span><span class="text-primary">M</span><span class="text-success">S</span>
            </a>
            <button class="openbtn" id="toggleSidebar">☰</button>

            <!-- Search Form -->
            <div class="d-flex align-self-center gap-2 roboto-body">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle btn-sm text-capitalize d-none d-md-inline" type="button" id="profile_btn_text" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($admin_name); ?>
                    </button>

                    <!-- Profile Picture Button (for small screens) -->
                    <button class="btn btn-success dropdown-toggle btn-sm mx-2 p-0 d-inline d-md-none" type="button" id="profile_btn_pic" data-bs-toggle="dropdown" aria-expanded="false" style="width: 30px; height: 30px; border-radius: 50%; overflow: hidden;">
                        <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu roboto-body mt-2" style="background-color: #232E57;" data-bs-theme="light" aria-labelledby="profile_btn_text">
                        <li>
                            <button type="button" class="dropdown-item text-white" data-bs-toggle="modal" data-bs-target="#ChangeProfile">
                                Change Profile
                            </button>
                        </li>
                        <li><button class="dropdown-item text-white" type="button">Change Password</button></li>
                        <li><button class="dropdown-item text-white" type="button">Edit Profile</button></li>
                    </ul>
                </div>
                <button type="button" class="btn btn-success roboto-body btn-sm position-relative ">
                    <i class="fa fa-fw fa-envelope"></i><br>
                    <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
                <a href="/iems/auth/logout.php" class="btn btn-success roboto-body btn-sm"><i class="fas fa-sign-out-alt"></i><br></a>
            </div>
        </div>
    </nav>
</header>
<aside>
    <?php include __DIR__ . '/../admin/src/sidebar.php'; ?>
</aside>

<main id="main">
    <div>
        <?php include __DIR__ . '/src/secondary-nav.php'; ?>
        <div class="show-message">
            <?php include __DIR__ . '/../message/success-error-upload-img.php'; ?>
            <?php include __DIR__ . '/../message/error.php'; ?>
            <?php include __DIR__ . '/../message/success.php'; ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ChangeProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pick a New Image for Your Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <label for="profile_image">Upload Profile Image:</label>
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success btn-sm" type="submit">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- importent View port content link -->
    <section class="bg-light">
        <div class="container-fluid">
            <div class="row g-3 justify-content-between align-items-center py-3">

                <!-- Title -->
                <div class="col-12 col-md-6 text-start">
                    <h2 class="roboto-body text-capitalize">Manage <?php echo htmlspecialchars($_REQUEST['user'] ?? '', ENT_QUOTES); ?></h2>
                </div>

                <!-- Breadcrumb -->
                <div class="col-12 col-md-6 text-md-end text-start">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item">
                                <a class="text-capitalize" href="/iems/admin/index.php">
                                    <?php echo htmlspecialchars($_SESSION['user_role'] ?? '', ENT_QUOTES); ?> administration
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo htmlspecialchars($_REQUEST['user'] ?? '', ENT_QUOTES); ?>
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </section>

    <!-- user count section -->
    <section class="important_link user-count-section py-3 py-md-5 d-none d-md-block">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row gy-4">
                        <?php
                        require_once __DIR__ . '/../config/db.php';

                        $role = $_GET['user'] ?? 'teacher';

                        try {
                            // Count active users
                            $stmtActive = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = :role AND status = 'Active'");
                            $stmtActive->execute(['role' => $role]);
                            $activeCount = $stmtActive->fetchColumn();

                            // Count inactive users
                            $stmtInactive = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = :role AND status = 'Inactive'");
                            $stmtInactive->execute(['role' => $role]);
                            $inactiveCount = $stmtInactive->fetchColumn();

                            // Total count (optional)
                            $total = $activeCount + $inactiveCount;
                        } catch (PDOException $e) {
                            $activeCount = $inactiveCount = $total = 0;
                            echo "Error: " . $e->getMessage();
                        }
                        ?>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card widget-card border-light shadow-sm">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5 class="card-title widget-card-title mb-3 text-capitalize">Total <?php echo $_REQUEST['user']; ?></h5>
                                            <h4 class="card-subtitle text-body-secondary m-0">
                                                <strong><?= $total; ?></strong>
                                            </h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width:40px; height: 40px;">
                                                    <i class="fa-solid fa-user-graduate fs-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mt-3">
                                                <span class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-arrow-up bsb-rotate-45"></i>
                                                </span>
                                                <div>
                                                    <p class="fs-7 mb-0">-9%</p>
                                                    <p class="fs-7 mb-0 text-secondary">since last week</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card widget-card border-light shadow-sm">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5 class="card-title widget-card-title mb-3 text-capitalize">Active <?php echo $_REQUEST['user']; ?></h5>
                                            <h4 class="card-subtitle text-body-secondary m-0">
                                                <?= $activeCount ?>
                                            </h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width:40px; height: 40px;">
                                                    <i class="fa-solid fa-users fs-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mt-3">
                                                <span class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-arrow-up bsb-rotate-45"></i>
                                                </span>
                                                <div>
                                                    <p class="fs-7 mb-0">+26%</p>
                                                    <p class="fs-7 mb-0 text-secondary">since last week</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card widget-card border-light shadow-sm">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <h5 class="card-title widget-card-title mb-3 text-capitalize">inactive <?php echo $_REQUEST['user']; ?></h5>
                                            <h4 class="card-subtitle text-body-secondary m-0">
                                                <?= $inactiveCount ?>
                                            </h4>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex justify-content-end">
                                                <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width:40px; height: 40px;">
                                                    <i class="fa-solid fa-book fs-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mt-3">
                                                <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-arrow-down bsb-rotate-45"></i>
                                                </span>
                                                <div>
                                                    <p class="fs-7 mb-0">+69%</p>
                                                    <p class="fs-7 mb-0 text-secondary">since last week</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Users -->
    <section class="add-new-teachers py-5 bg-secondary">
        <?php $userRole = $_REQUEST['user'] ?? ''; ?>
        <div class="container-fluid">
            <div class="card rounded-0 shadow-sm">
                <div class="card-body">
                    <!-- Title -->
                    <div class="row g-3">
                        <div class="col-12 py-2 px-1">
                            <div class="row align-content-center align-items-center">
                                <!-- Title -->
                                <div class="col-12 col-sm-6 text-sm-start text-center mb-2 mb-sm-0">
                                    <h5 class="card-title text-capitalize">Update <?php echo $_REQUEST['user'] ?? ''; ?> account</h5>
                                </div>


                                <!-- Add New -->
                                <div class="col-12 col-sm-6 text-sm-end text-center">
                                    <a class="btn btn-dark" href="/iems/admin/manage-user.php?user=<?php echo $_REQUEST['user'] ?? ''; ?>">
                                        <i class="fa-solid fa-arrow-left"></i>&nbsp; Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- All user form -->
                    <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                        <?php if ($userRole === 'teacher'): ?>
                            <!-- Success/error Message -->
                            <?php if (isset($_SESSION['error'])): ?>
                                <div id="flashMessage" class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']) ?></div>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?>
                            <!-- Success/error Message end -->

                            <!-- HTML form to update teacher-->
                            <form class="row g-3 needs-validation" enctype="multipart/form-data" action="/iems/admin/data/user-update-data.php?user=<?= htmlspecialchars($teacher['role']) ?>" method="POST" novalidate>

                                <input type="hidden" name="user_id" value="<?= $teacher['user_id'] ?>">
                                <input type="hidden" name="user" value="<?= $teacher['role'] ?>">
                                <!--  fields -->
                                <div class="col-md-4">
                                    <label for="validationfname" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="validationfname" name="fname" value="<?= htmlspecialchars($teacher['fname']) ?>" placeholder="frist name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationlname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="validationlname" name="lname" value="<?= htmlspecialchars($teacher['lname']) ?>" placeholder="last name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustomUsername" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="username" value="<?= htmlspecialchars($teacher['username']) ?>" placeholder="create @ username" required>
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($teacher['email']) ?>" placeholder="example@gmail.com" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="Cnumber" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="Cnumber" name="phone_number" value="<?= htmlspecialchars($teacher['phone_number']) ?>" placeholder="01866*********" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid phone number.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="national_id" class="form-label">National ID Card</label>
                                    <input type="text" class="form-control" id="national_id" name="national_id" value="<?= htmlspecialchars($teacher['national_id']) ?>" placeholder="4512 458* ***" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid national id number.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="Qualification" class="form-label">Qualification</label>
                                    <input type="text" class="form-control" id="Qualification" name="qualification" value="<?= htmlspecialchars($teacher['qualification']) ?>" placeholder="bachelor of arts, BA, Science,..." required>
                                    <div class="invalid-feedback">
                                        Please provide a valid qualification.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="Department" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="Department" name="department" value="<?= htmlspecialchars($teacher['department']) ?>" placeholder="CSE, EEE, English, Math,..." required>
                                    <div class="invalid-feedback">
                                        Please provide a valid department.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="subjects" class="form-label">Subject Speciality</label>
                                    <input type="text" class="form-control" id="subjects" name="subject" value="<?= htmlspecialchars($teacher['subject_speciality']) ?>" placeholder="Speciality: math, data science, bangla,..." required>
                                    <div class="invalid-feedback">
                                        Please provide a valid subject.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom03" class="form-label">Positon</label>
                                    <input type="text" class="form-control" name="position" value="<?= htmlspecialchars($teacher['position']) ?>" placeholder="Principals, senior, junior, Assistant..." id="validationCustom03" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid position.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($teacher['address']) ?>" placeholder="207, B-block, jatrabari, dhaka" id="address" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid address.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="permanent_address" class="form-label">permanent address</label>
                                    <input type="text" class="form-control" name="permanent_address" value="<?= htmlspecialchars($teacher['permanent_address']) ?>" placeholder="kazla-108, jatrabari, dhaka" id="permanent_address" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid position.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="blood_group" class="form-label">blood group</label>
                                    <input type="text" class="form-control" name="blood_group" value="<?= htmlspecialchars($teacher['blood_group']) ?>" placeholder="Blood: A+, A-, B+, B-, AB-,...." id="blood_group" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid position.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="experience_years" class="form-label">experience years</label>
                                    <input type="number" class="form-control" name="experience_years" value="<?= htmlspecialchars($teacher['experience_years']) ?>" placeholder="2,5,7,..." id="experience_years" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid position.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="date_of_birth" class="form-label">date of birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" value="<?= htmlspecialchars($teacher['date_of_birth']) ?>" id="date_of_birth" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid position.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option disabled>Choose status</option>
                                        <option value="Active" <?= ($teacher['status'] === 'Active') ? 'selected' : '' ?>>Active</option>
                                        <option value="Inactive" <?= ($teacher['status'] === 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                                        <option value="graduated" <?= ($teacher['status'] === 'graduated') ? 'selected' : '' ?>>graduated</option>
                                        <option value="Retired" <?= ($teacher['status'] === 'Retired') ? 'selected' : '' ?>>Retired</option>
                                        <option value="On Leave" <?= ($teacher['status'] === 'On Leave') ? 'selected' : '' ?>>On Leave</option>
                                        <option value="expelled" <?= ($teacher['status'] === 'expelled') ? 'selected' : '' ?>>expelled</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid position. ''
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="Role" class="form-label">Role</label>
                                    <select class="form-select" id="Role" name="role">
                                        <option selected value="<?= htmlspecialchars($teacher['gender']) ?>"><?= htmlspecialchars($teacher['role']) ?></option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid role.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="Gender" class="form-label">Gender</label>
                                    <select class="form-select" id="Gender" name="gender" required>
                                        <option disabled>Choose Gender</option>
                                        <option value="Male" <?= ($teacher['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?= ($teacher['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
                                        <option value="Other" <?= ($teacher['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid gender.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="hiredate" class="form-label">Hire date</label>
                                    <input type="date" class="form-control" name="hiredate" value="<?= htmlspecialchars($teacher['joining_date']) ?>" id="hiredate" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid date.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="profile_pic" class="form-label">Change Profile | </label>
                                    <?php if (!empty($teacher['profile_pic'])): ?>
                                        <img src="<?= htmlspecialchars($teacher['profile_pic']) ?>" alt="Profile Image" class="rounded-circle" style="width: 25px; height: 25px">
                                    <?php else: ?>
                                        <img src="/iems/assets/img/default.png" class="rounded-circle" style="width: 25px; height: 25px" alt="Profile" />
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid password.
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>

                        <?php elseif ($userRole === 'student'): ?>
                            <!-- Success/error Message -->
                            <?php if (isset($_SESSION['error'])): ?>
                                <div id="flashMessage" class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']) ?></div>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?>
                            <!-- Success/error Message end -->
                            <!-- student Edit form -->
                            <form class="row g-3 needs-validation" enctype="multipart/form-data" action="/iems/admin/data/user-update-data.php?user=<?= htmlspecialchars($teacher['role']) ?>" method="POST" novalidate>

                                <input type="hidden" name="user_id" value="<?= $teacher['user_id'] ?>">
                                <input type="hidden" name="user" value="<?= $teacher['role'] ?>">
                                <!--  fields -->
                                <div class="col-md-4">
                                    <label for="validationfname" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="validationfname" name="fname" placeholder="frist name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationlname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="validationlname" name="lname" placeholder="last name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustomUsername" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="username" placeholder="create a username" required>
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="Cnumber" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="Cnumber" name="phone_number" placeholder="01866*********" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid phone number.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="national_id" class="form-label">National ID Card</label>
                                    <input type="text" class="form-control" id="national_id" name="national_id" placeholder="4512 458* ***" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid national id number.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="student_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" id="student_id" name="student_id" placeholder="STU-12**" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid Student id number.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="roll_number" class="form-label">Student Roll</label>
                                    <input type="number" class="form-control" id="roll_number" name="roll_number" placeholder="01,02,..." required>
                                    <div class="invalid-feedback">
                                        Please provide a valid qualification.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="class" class="form-label">Class / Level</label>
                                    <input type="text" class="form-control" id="class" name="class" placeholder="O-Level, Bechalor's" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid Class / Level.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="department" class="form-label">Group / Department</label>
                                    <input type="text" class="form-control" id="department" name="department" placeholder="Science, Arts, commerce" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid subject.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="section" class="form-label">Section</label>
                                    <select type="text" class="form-control" name="section" id="section" required>
                                        <option selected disabled value="">Choose section</option>
                                        <option value="A">A</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid position.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="session_year" class="form-label">Session year</label>
                                    <select class="form-select" id="session_year" name="session_year" required>
                                        <option selected disabled value="">Choose section</option>
                                        <?php
                                        $currentYear = date('Y');
                                        $startYear = 2025;
                                        $endYear = $currentYear + 10;
                                        for ($year = $startYear; $year <= $endYear; $year++) {
                                            echo "<option value=\"$year\">$year</option>";
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid subject.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option selected disabled value="">Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid gender.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="blood_group" class="form-label">Blood Group</label>
                                    <select class="form-select" id="blood_group" name="blood_group" required>
                                        <option selected disabled value="">Choose Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid gender.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="religion" class="form-label">Religion</label>
                                    <select class="form-select" id="religion" name="religion" required>
                                        <option selected disabled value="">Choose Blood Group</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddh">Buddh</option>
                                        <option value="Christianity">Christianity</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid gender.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="207, B-block, jatrabari, dhaka" id="address" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid address.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="permanent_address" class="form-label">permanent address</label>
                                    <input type="text" class="form-control" name="permanent_address" placeholder="kazla-108, jatrabari, dhaka" id="permanent_address" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid permanent address.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="guardian_name" class="form-label">Guardian Name</label>
                                    <input type="text" class="form-control" name="guardian_name" placeholder="Enter guardian name" id="guardian_name" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid guardian_name.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="guardian_phone" class="form-label">Guardian Number</label>
                                    <input type="text" class="form-control" name="guardian_phone" placeholder="017** **** **" id="guardian_phone" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid position.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="guardian_relation" class="form-label">Guardian Relation</label>
                                    <input type="text" class="form-control" name="guardian_relation" placeholder="fether, mother," id="guardian_relation" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid Relation.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label">date of birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid date of birth.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="admission_date" class="form-label">Admission Date</label>
                                    <input type="date" class="form-control" name="admission_date" id="admission_date" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid admission date.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="Role" class="form-label">Role</label>
                                    <select class="form-select" id="Role" name="role" required>
                                        <option selected disabled value="">Choose Role</option>
                                        <option value="<?php echo $_REQUEST['user']; ?>"><?php echo $_REQUEST['user']; ?></option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid role.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="photo" class="form-label">Change Profile | </label>
                                    <?php if (!empty($student['photo'])): ?>
                                        <img src="<?= htmlspecialchars($teacher['photo']) ?>" alt="Profile Image" class="rounded-circle" style="width: 25px; height: 25px">
                                    <?php else: ?>
                                        <img src="/iems/assets/img/default.png" class="rounded-circle" style="width: 25px; height: 25px" alt="Profile" />
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid password.
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-danger">Invalid user type selected.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>