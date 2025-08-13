      <nav class="navbar bg-light" data-bs-theme="light">
        <div class="container-fluid">
          <!-- Brand Logo -->

          <a class="navbar-brand lobster-two-bold text-capitalize d-none d-md-inline" id="logo" type="button" id="profile_btn_text" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Profile Image">
          </a>

          <!-- Profile Picture Button (for small screens) -->
          <a class="navbar-brand lobster-two-regular text-success mx-2 p-0 d-inline d-md-none" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
            <?php echo htmlspecialchars($admin_username); ?>
          </a>
          <!-- Search Form -->
          <div class="d-flex justify-content-end roboto-body" style="gap: 8px;">
            <button type="button" class="btn btn-success roboto-body btn-sm" id="printBtn"><i class="fa-solid fa-print"></i></i>&nbsp; Print</button>
            <button type="button" class="btn btn-success roboto-body btn-sm "  id="refreshBtn"><i class="fa-solid fa-rotate"></i>&nbsp; refresh</button>
          </div>
        </div>
      </nav>