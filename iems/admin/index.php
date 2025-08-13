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

  <!-- importent View port content link -->
  <section class="important_link py-3 py-md-5">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row gy-4">
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
              <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title widget-card-title mb-3">Total Student</h5>
                      <h4 class="card-subtitle text-body-secondary m-0">
                        <?= $counts['student'] ?? 0 ?>
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
                        <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-arrow-trend-up bsb-rotate-45"></i>
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
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
              <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title widget-card-title mb-3">Total Teacher</h5>
                      <h4 class="card-subtitle text-body-secondary m-0">
                        <?= $counts['teacher'] ?? 0 ?>
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
                          <i class="fa-solid fa-arrow-trend-up bsb-rotate-45"></i>
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
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
              <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title widget-card-title mb-3">Total Moderator</h5>
                      <h4 class="card-subtitle text-body-secondary m-0">
                        <?= $counts['moderator'] ?? 0 ?>
                      </h4>
                    </div>
                    <div class="col-4">
                      <div class="d-flex justify-content-end">
                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width:40px; height: 40px;">
                          <i class="fa-solid fa-people-roof fs-4"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex align-items-center mt-3">
                        <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-arrow-trend-down bsb-rotate-45"></i>
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
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
              <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title widget-card-title mb-3">Total Accounts</h5>
                      <h4 class="card-subtitle text-body-secondary m-0">
                        <?= $counts['accounts'] ?? 0 ?>
                      </h4>
                    </div>
                    <div class="col-4">
                      <div class="d-flex justify-content-end">
                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width:40px; height: 40px;">
                          <i class="fa-solid fa-file-invoice-dollar fs-4"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex align-items-center mt-3">
                        <span class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-arrow-trend-down bsb-rotate-45"></i>
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
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
              <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title widget-card-title mb-3">Total Course</h5>
                      <h4 class="card-subtitle text-body-secondary m-0">764</h4>
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
                        <span class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-arrow-trend-up bsb-rotate-45"></i>
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
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
              <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title widget-card-title mb-3">Visitors</h5>
                      <h4 class="card-subtitle text-body-secondary m-0">1786</h4>
                    </div>
                    <div class="col-4">
                      <div class="d-flex justify-content-end">
                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width:40px; height: 40px;">
                          <i class="fa-solid fa-eye-low-vision fs-4"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex align-items-center mt-3">
                        <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-arrow-trend-up bsb-rotate-45"></i>
                        </span>
                        <div>
                          <p class="fs-7 mb-0">-21%</p>
                          <p class="fs-7 mb-0 text-secondary">since last week</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
              <div class="card widget-card border-light shadow-sm">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-8">
                      <h5 class="card-title widget-card-title mb-3">Total Users</h5>
                      <h4 class="card-subtitle text-body-secondary m-0">
                        <?= $total_count ?? 0 ?>
                      </h4>
                    </div>
                    <div class="col-4">
                      <div class="d-flex justify-content-end">
                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width:40px; height: 40px;">
                          <i class="fa-solid fa-eye-low-vision fs-4"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex align-items-center mt-3">
                        <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-arrow-trend-up bsb-rotate-45"></i>
                        </span>
                        <div>
                          <p class="fs-7 mb-0">-21%</p>
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
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>