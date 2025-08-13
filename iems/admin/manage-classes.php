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
          <h2 class="roboto-body text-capitalize">Manage Class</h2>
        </div>

        <!-- Breadcrumb -->
        <div class="col-12 col-md-6 text-md-end text-start">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-md-end mb-0">
              <li class="breadcrumb-item">
                <a class="text-capitalize" href="/iems/admin/index.php">
                  <?php echo htmlspecialchars($_SESSION['user_role'] ?? '', ENT_QUOTES); ?>
                </a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                class
              </li>
            </ol>
          </nav>
        </div>

      </div>
    </div>
  </section>
  <!-- manage class count section -->
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
                      <h5 class="card-title widget-card-title mb-3 text-capitalize">Total Class</h5>
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
                      <h5 class="card-title widget-card-title mb-3 text-capitalize">Total Course</h5>
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
                      <h5 class="card-title widget-card-title mb-3 text-capitalize">Totol Section</h5>
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
    <div class="container-fluid">
      <div class="card rounded-0 shadow-sm">
        <?php if (isset($_REQUEST['action'])): ?>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12 shadow py-2 px-1">
                <div class="row align-content-center align-items-center">
                  <!-- Title -->
                  <div class="col-12 col-sm-6 text-sm-start text-center mb-2 mb-sm-0">
                    <h5 class="card-title text-capitalize">Add new Class</h5>
                  </div>

                  <!-- Add New -->
                  <div class="col-12 col-sm-6 text-sm-end text-center">
                    <a class="btn btn-dark" href="/iems/admin/manage-classes.php">
                      <i class="fa-solid fa-arrow-left"></i>&nbsp; Back
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <form class="row g-3 needs-validation" action="/iems/admin/data/manage-user-data.php?" method="POST" novalidate>
                <div class="col-md-4">
                  <label for="Cname" class="form-label">Class name</label>
                  <input type="text" class="form-control" id="Cname" name="Cname" placeholder="Class title name" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="Ccode" class="form-label">Class Code</label>
                  <select class="form-select" id="Ccode" name="Ccode" required>
                    <option selected disabled value="">Choose class code</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid gender.
                  </div>
                </div>
                <div class="col-md-4">
                  <?php
                  // Prepare and execute query (using PDO)
                  $stmt = $conn->prepare("SELECT section FROM section");
                  $stmt->execute();
                  $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  ?>

                  <label for="Section" class="form-label">Section</label>
                  <select class="form-select" id="Section" name="section" required>
                    <option selected disabled value="">Choose Section</option>
                    <?php foreach ($sections as $section): ?>
                      <option value="<?php echo htmlspecialchars($section['section']); ?>">
                        Section <?php echo htmlspecialchars($section['section']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                  <div class="invalid-feedback">
                    Please select a valid section.
                  </div>
                </div>


                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary">Create New</button>
                </div>
              </form>
            </div>
          </div>
        <?php else: ?>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-12 shadow py-2 px-1">
                <div class="row align-content-center align-items-center">
                  <!-- Title -->
                  <div class="col-12 col-sm-6 text-sm-start text-center mb-2 mb-sm-0">
                    <h5 class="card-title text-capitalize">all Class</h5>
                  </div>

                  <!-- Add New -->
                  <div class="col-12 col-sm-6 text-sm-end text-center">
                    <a class="btn btn-success" href="?action=new-class">
                      <i class="fa-solid fa-plus"></i>&nbsp; Add New
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">



              <div class="col-12 col-md-2 col-sm-3">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-Class-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Class" type="button" role="tab" aria-controls="v-pills-Class" aria-selected="true">Class</button>
                  <button class="nav-link" id="v-pills-Course-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Course" type="button" role="tab" aria-controls="v-pills-Course" aria-selected="false">Course</button>
                  <button class="nav-link" id="v-pills-Section-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Section" type="button" role="tab" aria-controls="v-pills-Section" aria-selected="false">Section</button>
                  <button class="nav-link" id="v-pills-Subject-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Subject" type="button" role="tab" aria-controls="v-pills-Subject" aria-selected="false">Subject</button>
                </div>
              </div>
              <div class="col-12 col-md-10 col-sm-9 ">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-Class" role="tabpanel" aria-labelledby="v-pills-Class-tab">
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
                  </div>
                  <div class="tab-pane fade" id="v-pills-Course" role="tabpanel" aria-labelledby="v-pills-Course-tab">
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
                  </div>
                  <div class="tab-pane fade" id="v-pills-Section" role="tabpanel" aria-labelledby="v-pills-Section-tab">
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
                  </div>
                  <div class="tab-pane fade" id="v-pills-Subject" role="tabpanel" aria-labelledby="v-pills-Subject-tab">
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
                  </div>

                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>



</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>