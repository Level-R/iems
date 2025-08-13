<?php include_once __DIR__ . '/data/index-data.php'; ?>
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
  <section class="important_link py-3 py-md-5">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row gy-4">
            <?php
            require_once __DIR__ . '/../config/db.php';

            $role = $_GET['user'] ?? null;

            try {
              // Count active users
              $stmtActive = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = :role AND status = 'Active'");
              $stmtActive->execute(['role' => $role]);
              $activeCount = $stmtActive->fetchColumn();

              // Count inactive users
              $stmtInactive = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = :role AND status = 'Inactive'");
              $stmtInactive->execute(['role' => $role]);
              $inactiveCount = $stmtInactive->fetchColumn();

              // Total count
              $totalStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE role = :role");
              $totalStmt->execute(['role' => $role]);
              $totalCount = $totalStmt->fetchColumn();
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
                        <strong><?= htmlspecialchars($totalCount); ?></strong>
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
  <!-- uset table -->
  <section class="add-new-teachers py-5 bg-secondary">
    <?php $userRole = $_REQUEST['user'] ?? ''; ?>
    <div class="container-fluid">
      <div class="card rounded-0 shadow-sm">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-12 shadow py-2 px-1">
              <div class="row align-content-center align-items-center">
                <!-- Title -->
                <div class="col-12 col-sm-4 text-sm-start text-center mb-2 mb-sm-0">
                  <h5 class="card-title text-capitalize">all <?php echo $_REQUEST['user'] ?? ''; ?></h5>
                </div>

                <!-- Search -->
                <div class="col-12 col-sm-4 text-center mb-2 mb-sm-0">
                  <div class="input-group">
                    <div class="form-outline" data-mdb-input-init>
                      <input type="search" id="form1" class="form-control" />
                      <label class="form-label" for="form1">Search</label>
                    </div>
                  </div>
                </div>

                <!-- Add New -->
                <div class="col-12 col-sm-4 text-sm-end text-center">
                  <a class="btn btn-success" href="/iems/admin/new-user.php?user=<?php echo $_REQUEST['user'] ?? ''; ?>">
                    <i class="fa-solid fa-plus"></i>&nbsp; Add New
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Teacher Table and logic -->
          <?php if ($userRole === 'teacher'): ?>
            <!-- message show -->
            <?php if (isset($_SESSION['success'])): ?>
              <div id="flashMessage" class="alert alert-success text-center"><?= htmlspecialchars($_SESSION['success']) ?></div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <!-- Error -->
            <?php if (isset($_SESSION['error'])): ?>
              <div id="flashMessage" class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']) ?></div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <!-- message show -->
            <?php
            try {
              $role = $_REQUEST['user'];
              $stmt = $conn->prepare('SELECT u.*, t.* FROM teachers t JOIN users u ON u.id = t.user_id WHERE u.role = :role');
              $stmt->execute(['role' => $role]);
              $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
            ?>
            <!-- Teacher table -->
            <div class="table-responsive">
              <table class="table align-middle mb-4 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Position Role</th>
                    <th>Contact</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($allUsers)): ?>
                    <?php foreach ($allUsers as $userInfo): ?>
                      <tr>
                        <td><?= htmlspecialchars($userInfo['id']); ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <?php if (!empty($userInfo['profile_pic'])): ?>
                              <img src="<?= htmlspecialchars($userInfo['profile_pic']); ?>" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php else: ?>
                              <img src="/iems/assets/img/default.png" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php endif; ?>
                            <div class="ms-3">
                              <p class="fw-bold mb-1"><?= htmlspecialchars($userInfo['fname'] . ' ' . $userInfo['lname']); ?></p>
                              <p class="text-muted fst-italic mb-0"><?= htmlspecialchars($userInfo['username']); ?></p>
                              <p class="text-muted mb-0"><?= htmlspecialchars($userInfo['email']); ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="fw-normal mb-1"><?= htmlspecialchars($userInfo['qualification']); ?></p>
                          <p class="fw-normal mb-1"><?= htmlspecialchars($userInfo['department']); ?></p>
                          <p class="text-muted mb-0"><?= htmlspecialchars($userInfo['subject_speciality']); ?></p>
                        </td>
                        <td>
                          <span class="badge badge-success rounded-pill d-inline">
                            <?= htmlspecialchars($userInfo['status']); ?>
                          </span>
                        </td>
                        <td>
                          <?= htmlspecialchars($userInfo['position']); ?> <?= htmlspecialchars($userInfo['role']); ?>
                        </td>
                        <td>
                          <?= htmlspecialchars($userInfo['phone_number']); ?>
                        </td>
                        <td>
                          <a href="/iems/admin/user-edit.php?user=<?= htmlspecialchars($userInfo['role']); ?>&id=<?= htmlspecialchars($userInfo['user_id']); ?>"
                            class="btn btn-warning btn-rounded btn-sm fw-bold mb-2 roboto-body"
                            data-mdb-ripple-color="dark">
                            Edit
                          </a>
                          <button
                            class="btn btn-danger btn-rounded btn-sm fw-bold mb-2 delete-btn roboto-body"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteConfirmModal"
                            data-user-id="<?= htmlspecialchars($userInfo['user_id']) ?>"
                            data-role="<?= htmlspecialchars($userInfo['role']) ?>">
                            Delete
                          </button>

                        </td>
                      </tr>
                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Yes, Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="text-info text-center" colspan="18">No <?= htmlspecialchars($_REQUEST['user']); ?> data found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>

              </table>
            </div>


            <!-- Student table and logic -->

          <?php elseif ($userRole == 'student'): ?>
            <!-- message show -->
            <?php if (isset($_SESSION['success'])): ?>
              <div id="flashMessage" class="alert alert-success text-center"><?= htmlspecialchars($_SESSION['success']) ?></div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <!-- Error -->
            <?php if (isset($_SESSION['error'])): ?>
              <div id="flashMessage" class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']) ?></div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <!-- message show -->
            <?php
            try {
              $role = $_REQUEST['user'];
              $stmt = $conn->prepare("SELECT u.*, s.* FROM students s JOIN users u ON u.id=s.user_id WHERE u.role = :role");
              $stmt->execute(['role' => $role]);
              $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo "Error: " . $e->getMessage();
            }
            ?>
            <!-- Student table -->
            <div class="table-responsive">
              <table class="table align-middle mb-4 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Class Info</th>
                    <th>Status</th>
                    <th>Guardian Info</th>
                    <th>Student Info</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($allUsers)): ?>
                    <?php foreach ($allUsers as $userInfo): ?>
                      <tr>
                        <td><?= htmlspecialchars($userInfo['id']); ?></td>
                        <!-- Name -->
                        <td>
                          <div class="d-flex align-items-center">
                            <?php if (!empty($userInfo['photo'])): ?>
                              <img src="<?= htmlspecialchars($userInfo['photo']); ?>" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php else: ?>
                              <img src="/iems/assets/img/default.png" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php endif; ?>
                            <div class="ms-3">
                              <p class="fw-bold mb-1"><?= htmlspecialchars($userInfo['fname'] . ' ' . $userInfo['lname']); ?></p>
                              <p class="text-muted fst-italic mb-0"><?= htmlspecialchars($userInfo['username']); ?></p>
                              <p class="text-muted mb-0"><?= htmlspecialchars($userInfo['email']); ?></p>
                            </div>
                          </div>
                        </td>
                        <!-- Title -->
                        <td>
                          <p class="fw-normal mb-1"><b>Class: </b><?= htmlspecialchars($userInfo['class']); ?></p>
                          <p class="text-muted mb-0"><b>Dept: </b><?= htmlspecialchars($userInfo['department']); ?></p>
                          <p class="fw-normal mb-1"><b>Roll No: </b><?= htmlspecialchars($userInfo['roll_number']); ?><b> Section: </b><?= htmlspecialchars($userInfo['section']); ?></p>
                        </td>
                        <!-- status -->
                        <td>
                          <span class="badge badge-success rounded-pill d-inline">
                            <?= htmlspecialchars($userInfo['status']); ?>
                          </span>
                        </td>
                        <!-- guardian_Info -->
                        <td>
                          <p class="fw-normal mb-1"><b>Name: </b><?= htmlspecialchars($userInfo['guardian_name']); ?></p>
                          <p class="text-muted mb-0"><b>Contact: </b><?= htmlspecialchars($userInfo['guardian_phone']); ?></p>
                          <p class="fw-normal mb-1"><b>Relation: </b><?= htmlspecialchars($userInfo['guardian_relation']); ?></p>
                        </td>
                        <!-- student Info -->
                        <td>
                          <p class="fw-normal mb-1"><b>Gender: </b><?= htmlspecialchars($userInfo['gender']); ?></p>
                          <p class="text-muted mb-0"><b>Contact: </b><?= htmlspecialchars($userInfo['phone_number']); ?></p>
                          <p class="text-muted fst-italic mb-1"><b>Course Inroll: </b><?= htmlspecialchars(date('d-F-Y', strtotime($userInfo['admission_date']))); ?></p>
                        </td>
                        <td>
                          <a href="/iems/admin/user-edit.php?user=<?= htmlspecialchars($userInfo['role']); ?>&id=<?= htmlspecialchars($userInfo['user_id']); ?>"
                            class="btn btn-warning btn-rounded btn-sm fw-bold mb-2 roboto-body"
                            data-mdb-ripple-color="dark">
                            Edit
                          </a>
                          <button
                            class="btn btn-danger btn-rounded btn-sm fw-bold mb-2 delete-btn roboto-body"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteConfirmModal"
                            data-user-id="<?= htmlspecialchars($userInfo['user_id']) ?>"
                            data-role="<?= htmlspecialchars($userInfo['role']) ?>">
                            Delete
                          </button>

                        </td>
                      </tr>
                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Yes, Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="text-info text-center" colspan="18">No <?= htmlspecialchars($_REQUEST['user']); ?> data found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>

              </table>
            </div>

            <!-- moderator Table and logic -->

          <?php elseif ($userRole === 'moderator'): ?>
            <!-- message show -->
            <?php if (isset($_SESSION['success'])): ?>
              <div id="flashMessage" class="alert alert-success text-center"><?= htmlspecialchars($_SESSION['success']) ?></div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <!-- Error -->
            <?php if (isset($_SESSION['error'])): ?>
              <div id="flashMessage" class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']) ?></div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <!-- message show -->
            <?php
            try {
              $role = $_REQUEST['user'];
              $stmt = $conn->prepare('SELECT u.*, t.* FROM teachers t JOIN users u ON u.id = t.user_id WHERE u.role = :role');
              $stmt->execute(['role' => $role]);
              $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
            ?>
            <!-- Teacher table -->
            <div class="table-responsive">
              <table class="table align-middle mb-4 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Position Role</th>
                    <th>Contact</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($allUsers)): ?>
                    <?php foreach ($allUsers as $userInfo): ?>
                      <tr>
                        <td><?= htmlspecialchars($userInfo['id']); ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <?php if (!empty($userInfo['profile_pic'])): ?>
                              <img src="<?= htmlspecialchars($userInfo['profile_pic']); ?>" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php else: ?>
                              <img src="/iems/assets/img/default.png" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php endif; ?>
                            <div class="ms-3">
                              <p class="fw-bold mb-1"><?= htmlspecialchars($userInfo['fname'] . ' ' . $userInfo['lname']); ?></p>
                              <p class="text-muted fst-italic mb-0"><?= htmlspecialchars($userInfo['username']); ?></p>
                              <p class="text-muted mb-0"><?= htmlspecialchars($userInfo['email']); ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="fw-normal mb-1"><?= htmlspecialchars($userInfo['qualification']); ?></p>
                          <p class="fw-normal mb-1"><?= htmlspecialchars($userInfo['department']); ?></p>
                          <p class="text-muted mb-0"><?= htmlspecialchars($userInfo['subject_speciality']); ?></p>
                        </td>
                        <td>
                          <span class="badge badge-success rounded-pill d-inline">
                            <?= htmlspecialchars($userInfo['status']); ?>
                          </span>
                        </td>
                        <td>
                          <?= htmlspecialchars($userInfo['position']); ?> <?= htmlspecialchars($userInfo['role']); ?>
                        </td>
                        <td>
                          <?= htmlspecialchars($userInfo['phone_number']); ?>
                        </td>
                        <td>
                          <a href="/iems/admin/user-edit.php?user=<?= htmlspecialchars($userInfo['role']); ?>&id=<?= htmlspecialchars($userInfo['user_id']); ?>"
                            class="btn btn-warning btn-rounded btn-sm fw-bold mb-2 roboto-body"
                            data-mdb-ripple-color="dark">
                            Edit
                          </a>
                          <button
                            class="btn btn-danger btn-rounded btn-sm fw-bold mb-2 delete-btn roboto-body"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteConfirmModal"
                            data-user-id="<?= htmlspecialchars($userInfo['user_id']) ?>"
                            data-role="<?= htmlspecialchars($userInfo['role']) ?>">
                            Delete
                          </button>

                        </td>
                      </tr>
                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Yes, Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="text-info text-center" colspan="18">No <?= htmlspecialchars($_REQUEST['user']); ?> data found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>

              </table>
            </div>

            <!-- moderator Table and logic -->
          <?php elseif ($userRole === 'accounts'): ?>
            <!-- message show -->
            <?php if (isset($_SESSION['success'])): ?>
              <div id="flashMessage" class="alert alert-success text-center"><?= htmlspecialchars($_SESSION['success']) ?></div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <!-- Error -->
            <?php if (isset($_SESSION['error'])): ?>
              <div id="flashMessage" class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']) ?></div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <!-- message show -->
            <?php
            try {
              $role = $_REQUEST['user'];
              $stmt = $conn->prepare('SELECT u.*, t.* FROM teachers t JOIN users u ON u.id = t.user_id WHERE u.role = :role');
              $stmt->execute(['role' => $role]);
              $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
            ?>
            <!-- Teacher table -->
            <div class="table-responsive">
              <table class="table align-middle mb-4 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Position Role</th>
                    <th>Contact</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($allUsers)): ?>
                    <?php foreach ($allUsers as $userInfo): ?>
                      <tr>
                        <td><?= htmlspecialchars($userInfo['id']); ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <?php if (!empty($userInfo['profile_pic'])): ?>
                              <img src="<?= htmlspecialchars($userInfo['profile_pic']); ?>" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php else: ?>
                              <img src="/iems/assets/img/default.png" class="rounded-circle" style="width: 45px; height: 45px" alt="Profile" />
                            <?php endif; ?>
                            <div class="ms-3">
                              <p class="fw-bold mb-1"><?= htmlspecialchars($userInfo['fname'] . ' ' . $userInfo['lname']); ?></p>
                              <p class="text-muted fst-italic mb-0"><?= htmlspecialchars($userInfo['username']); ?></p>
                              <p class="text-muted mb-0"><?= htmlspecialchars($userInfo['email']); ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="fw-normal mb-1"><?= htmlspecialchars($userInfo['qualification']); ?></p>
                          <p class="fw-normal mb-1"><?= htmlspecialchars($userInfo['department']); ?></p>
                          <p class="text-muted mb-0"><?= htmlspecialchars($userInfo['subject_speciality']); ?></p>
                        </td>
                        <td>
                          <span class="badge badge-success rounded-pill d-inline">
                            <?= htmlspecialchars($userInfo['status']); ?>
                          </span>
                        </td>
                        <td>
                          <?= htmlspecialchars($userInfo['position']); ?> <?= htmlspecialchars($userInfo['role']); ?>
                        </td>
                        <td>
                          <?= htmlspecialchars($userInfo['phone_number']); ?>
                        </td>
                        <td>
                          <a href="/iems/admin/user-edit.php?user=<?= htmlspecialchars($userInfo['role']); ?>&id=<?= htmlspecialchars($userInfo['user_id']); ?>"
                            class="btn btn-warning btn-rounded btn-sm fw-bold mb-2 roboto-body"
                            data-mdb-ripple-color="dark">
                            Edit
                          </a>
                          <button
                            class="btn btn-danger btn-rounded btn-sm fw-bold mb-2 delete-btn roboto-body"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteConfirmModal"
                            data-user-id="<?= htmlspecialchars($userInfo['user_id']) ?>"
                            data-role="<?= htmlspecialchars($userInfo['role']) ?>">
                            Delete
                          </button>

                        </td>
                      </tr>
                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this user?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Yes, Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="text-info text-center" colspan="18">No <?= htmlspecialchars($_REQUEST['user']); ?> data found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>

              </table>
            </div>

          <?php else: ?>
            <div class="alert alert-danger">Invalid user type selected.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>



</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>