<?php 
 $pageTitle = "Index";
 include_once __DIR__ . '../includes/header.php'; 
 ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary roboto-body">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">IEMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon">☰</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About-IEMS</a></li>
            <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          </ul>
            <div class="d-flex">
                <a class="btn btn-success" href="./auth/login.php">LogIn</a>
            </div>
        </div>
      </div>
    </nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Hero Section -->
    <header class="bg-light text-center mt-5 py-5" id="home">
      <div class="container">
        <h1 class="display-5 fw-bold lobster-two-bold">Integrated Education Management System</h1>
        <p class="lead roboto-body">Digitize your entire academic ecosystem with IEMS — smart, secure, and scalable.</p>
        <a href="#" class="btn btn-primary btn-lg mt-3 roboto-body">Explore Features</a>
      </div>
    </header>
    <!-- Features Section -->
    <section class="bg-light py-5" id="features">
      <div class="container">
        <div class="row text-center">
            <?php for ($i=0; $i <= 3; $i++) { ?> 
              <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title lobster-two-regular">Student Management</h5>
                    <p class="card-text roboto-body">Handle admissions, attendance, grades, and records efficiently.</p>
                    <p class="card-text roboto-body">
                      <b>Duration:</b> 45 Hours <br>
                      <b>Price:</b> 45,000/-TK. <br>
                    </p>
                    <button class="btn btn-block btn-primary">Enroll Now</button>
                  </div>
                </div>
              </div>
            <?php } ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title lobster-two-regular">Faculty Dashboard</h5>
                <p class="card-text roboto-body">Track class schedules, assignments, and communicate with students.</p>
                <p class="card-text roboto-body">
                  <b>Duration:</b> 45 Hours <br>
                  <b>Price:</b> 45,000/-TK. <br>
                </p>
                <button class="btn btn-block btn-primary">Enroll Now</button>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title lobster-two-regular">Finance & Payments</h5>
                <p class="card-text roboto-body">Automate fee collection, invoicing, and expense reports.</p>
                <p class="card-text roboto-body">
                  <b>Duration:</b> 45 Hours <br>
                  <b>Price:</b> 45,000/-TK. <br>
                </p>
                <button class="btn btn-block btn-primary">Enroll Now</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section -->
    <section class="py-5" id="about">
        <div class="container">
            <div class="card mb-3 shadow-sm" >
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="./assets/img/about.jpg" class="h-100 w-100 rounded-start" alt="about.jpg">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title fw-bold lobster-two-bold">About IEMS</h2>
                        <p class="lead card-text roboto-body">IEMS (Integrated Education Management System) is a comprehensive, cloud-based platform designed to streamline and digitize all academic and administrative processes within educational institutions.</p>
                        <p class="card-text roboto-body">From student enrollment and attendance to academic performance, human resources, and financial management, IEMS provides an all-in-one solution that enhances efficiency, transparency, and decision-making. It empowers institutions to deliver quality education while saving time and reducing manual tasks.</p>
                        <ul class="list-unstyled card-text roboto-body">
                        <li>✔️ Centralized student and faculty management</li>
                        <li>✔️ Real-time data and reporting dashboards</li>
                        <li>✔️ Role-based secure access for staff, students, and parents</li>
                        <li>✔️ Seamless integration with online classes and exam modules</li>
                        </ul>
                        <p class="card-text roboto-body"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="#" class="btn btn-outline-primary mt-3">Learn More</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- acheivement section -->

    <!-- contact -->
     <section class="py-5 mb-5" id="contact">
        <div class="container">
            <form class="row g-3 needs-validation  m-auto shadow p-5 bg-light rounded" novalidate>
                <h1 class="text-center lobster-two-bold mb-5">Contact</h1>
              <div class="col-md-6">
                <label for="validationCustom01" class="form-label roboto-body">Full name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter Your Nane" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-6">
                <label for="validationCustom02" class="form-label roboto-body">E-mail Address</label>
                <input type="email" class="form-control" id="validationCustom02" placeholder="Enter Your Mail" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class="form-label roboto-body">Messages</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="drop your message" rows="3"></textarea>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                  <label class="form-check-label roboto-body" for="invalidCheck">
                    Agree to terms and conditions
                  </label>
                  <div class="invalid-feedback">
                    You must agree before submitting.
                  </div>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary roboto-body" type="submit">Contact Me!</button>
              </div>
            </form>
        </div>
     </section>
<?php include __DIR__ . '../includes/footer.php';?>