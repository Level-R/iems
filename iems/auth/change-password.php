<?php include_once __DIR__ . '/process/login-process.php'; ?>
<?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- contact -->
    <section class="py-5 mt-5" id="contact">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form class="needs-validation m-auto shadow p-5 bg-light rounded" action="login.php" method="POST" novalidate>
                        <div class="py-1">
                            <h1 class="text-center fw-bold lobster-two-bold mt-2">
                                <samp class="text-danger">I</samp><samp class="text-dark">E</samp><samp class="text-primary">M</samp><samp class="text-success">S</samp>
                            </h1>
                            <h2 class="text-center lobster-two-regular mb-2">
                                <samp class="text-danger fw-bold">Pass</samp>word <samp class="text-info">cha</samp>nge
                            </h2>
                        </div>
                    
                        <div class="col-md-12">
                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger m-auto text-center">
                                    <?= htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            <label for="user_input" class="form-label roboto-body">Username/ Email</label>
                            <input type="text" name="username_mail" class="form-control" id="user_input"
                                placeholder="Username or Email" required autocomplete="username">
                        </div>
                        <div class="col-md-12">
                            <label for="current-password" class="form-label roboto-body">Password</label>
                            <input type="password" class="form-control" name="password" id="current-password"
                                placeholder="current-password" required autocomplete="current-password">
                        </div>
                        <div class="col-md-12">
                            <label for="confirm_password" class="form-label roboto-body">Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                placeholder="Confirm Password" required autocomplete="confirm_password">
                        </div>                        
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary roboto-body btn-sm mt-2">Login</button>
                        </div>
                        <div class="form-links text-center mt-3">
                            Can't remember your password?
                            <a href="forgot-password.php">Click here to reset it</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-danger text-center roboto-body footer mt-auto py-3 d-flex flex-column h-100">
        <div class="container">
            <p class="mb-0">&copy; 2025 IEMS. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
