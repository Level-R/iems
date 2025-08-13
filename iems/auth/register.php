<?php $pageTitle = "register"; include __DIR__ . '/../includes/header.php'; ?>



    <!-- contact -->
    <section class="py-5 mt-2" id="contact">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form class="needs-validation m-auto shadow p-5 bg-light rounded" action="/../iems/auth/process/register-process.php" method="POST" novalidate>
                        <div class="py-1">
                            <h1 class="text-center fw-bold lobster-two-bold mt-2">
                                <samp class="text-danger">I</samp><samp class="text-dark">E</samp><samp class="text-primary">M</samp><samp class="text-success">S</samp>
                            </h1>
                           <h2 class="text-center lobster-two-regular mb-2">
                                <samp class="text-danger fw-bold">R</samp>egi<samp class="text-info">s</samp>ter
                            </h2>
                        </div>
                        <div class="col-md-12">
                            <?php include_once __DIR__ . '/../message/error.php';?>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label roboto-body">First Name</label>
                            <input type="text" name="fname" class="form-control" id="fname"
                                placeholder="Enter Your First Name" required autocomplete="given-name">
                        </div> 
                        <div class="col-md-12">
                            <label for="lname" class="form-label roboto-body">Last Name</label>
                            <input type="text" name="lname" class="form-control" id="lname"
                                placeholder="Enter Your Last Name" required autocomplete="family-name">
                        </div>                                        
                        <div class="col-md-12">
                            <label for="username" class="form-label roboto-body">Username</label>
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="choose a username" required autocomplete="username">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label roboto-body">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder=" Enter your Email" required autocomplete="email">
                        </div>   
                        <div class="col-md-12">
                            <label for="phone_number" class="form-label roboto-body">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" id="phone_number"
                                placeholder="01788********" required autocomplete="tel-area-code">
                        </div>                                             
                        <div class="col-md-12">
                            <label for="password" class="form-label roboto-body">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Enter Your Password" required autocomplete="current-password">
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary roboto-body btn-sm mt-2">Create On Account</button>
                        </div>
                        <div class="form-links text-center mt-3">
                            You have already create on account? <a href="login.php">LogIn</a> <br>
                            <a href="forgot-password.php">Forgot password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>

        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php';?>