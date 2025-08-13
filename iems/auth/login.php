<?php $pageTitle = "Login"; include __DIR__ . '/../includes/header.php'; ?>

    <!-- contact -->
    <section class="py-5 mt-5" id="contact">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form class="needs-validation m-auto shadow p-5 bg-light rounded" action="/../iems/auth/process/login-process.php" method="POST" novalidate>
                        <div class="py-1">
                            <h1 class="text-center fw-bold lobster-two-bold mt-2">
                                <samp class="text-danger">I</samp><samp class="text-dark">E</samp><samp class="text-primary">M</samp><samp class="text-success">S</samp>
                            </h1>
                            <h2 class="text-center lobster-two-regular mb-2">
                                <samp class="text-danger fw-bold">L</samp>og<samp class="text-info">I</samp>n
                            </h2>
                        </div>
                        <!-- error message -->
                        <div class="col-md-12">
                            <?php include_once __DIR__ . '/../message/error.php';?>
                        </div>
                        <!-- success message -->
                        <div class="col-md-12">
                            <?php include_once __DIR__ . '/../message/success.php';?>
                        </div>
                        <div class="col-md-12">
                            <label for="login_input" class="form-label roboto-body">user-Id/email</label>
                            <input type="text" name="userId" class="form-control" id="login_input"
                                placeholder="Enter Username or Email or phone number" required autocomplete="login_input">
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label roboto-body">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Enter Your Password" required autocomplete="current-password">
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded roboto-body mt-2" data-mdb-ripple-init>Login</button>
                        </div>
                        <div class="form-links text-center mt-3">
                            Don't have an account? <a href="register.php">Register</a> <br>
                            <a href="forgot-password.php">Forgot password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>

            </div>
        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php';?>
