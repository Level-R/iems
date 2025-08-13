<?php include __DIR__ . '/../includes/header.php'; ?>



    <!-- contact -->
    <section class="py-5 mt-2" id="contact">
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
                                <samp class="text-danger fw-bold">F</samp>or<samp class="text-info">g</samp>et
                            </h2>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label roboto-body">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder=" Enter your Email" required autocomplete="email">
                        </div>   
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary roboto-body btn-sm mt-2">Forgot Password</button>
                        </div>
                        <div class="form-links text-center mt-3">
                            remember your password? <a href="login.php">LogIn</a> <br>
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