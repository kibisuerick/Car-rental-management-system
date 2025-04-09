<?php
require_once 'db.php';
require_once 'functions.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process form data
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['emailAddress']);
    $userType = $_POST['userType'];
    $password = $_POST['loginPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Basic validation
    if (empty($fullName)) {
        $errors[] = "Full name is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    // Additional validation based on user type
    if ($userType === 'dealer') {
        $companyName = trim($_POST['companyName']);
        $businessLicense = trim($_POST['businessLicense']);

        if (empty($companyName) || empty($businessLicense)) {
            $errors[] = "Company name and business license are required for dealers";
        }
    }

    if ($userType === 'admin') {
        $adminCode = trim($_POST['adminCode']);
        $validAdminCode = "ADMIN12345"; // In production, store this securely

        if (empty($adminCode) || $adminCode !== $validAdminCode) {
            $errors[] = "Invalid administrator authorization code";
        }
    }

    // Check if email already exists
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $errors[] = "Email already registered";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        try {
            $pdo->beginTransaction();

            // Hash password
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Insert into users table
            $stmt = $pdo->prepare("
                INSERT INTO users (full_name, email, password_hash, user_type) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$fullName, $email, $passwordHash, $userType]);
            $userId = $pdo->lastInsertId();

            // Handle user type specific data
            if ($userType === 'dealer') {
                $stmt = $pdo->prepare("
                    INSERT INTO dealers (user_id, company_name, business_license_number) 
                    VALUES (?, ?, ?)
                ");
                $stmt->execute([$userId, $companyName, $businessLicense]);
            } elseif ($userType === 'admin') {
                $stmt = $pdo->prepare("
                    INSERT INTO admin_details (user_id, admin_code, access_level) 
                    VALUES (?, ?, 'standard')
                ");
                $stmt->execute([$userId, $adminCode]);
            }

            $pdo->commit();
            $success = true;

            // Redirect to login page after successful registration
            header("Location: login.php?registration=success");
            exit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/favicon.png" />
    <title>Car rental management system</title>
    <meta name="description" content="Login and Register Form Html">
    <meta name="author" content="#">

    <!-- Web Fonts
========================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>

    <!-- Stylesheet
========================= -->
    <link rel="stylesheet" type="text/css"
        href="https://harnishdesign.net/demo/html/oxyy/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://harnishdesign.net/demo/html/oxyy/vendor/font-awesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://harnishdesign.net/demo/html/oxyy/css/stylesheet.css" />
    <!-- Colors Css -->
    <link id="color-switcher" type="text/css" rel="stylesheet" href="#" />
</head>

<body>

    <div id="main-wrapper" class="oxyy-login-register">
        <div class="container-fluid px-0">
            <div class="row g-0 min-vh-100">
                <!-- Welcome Text -->
                <div class="col-md-4">
                    <div class="hero-wrap h-100">
                        <div class="hero-mask opacity-5 bg-dark"></div>
                        <div class="hero-bg hero-bg-scroll"
                            style="background-image:url('https://harnishdesign.net/demo/html/oxyy/images/login-bg-6.jpg');"></div>
                        <div class="hero-content mx-auto w-100 h-100">
                            <div class="container d-flex flex-column h-100">
                                <div class="row g-0">
                                    <div class="col-11 col-lg-9 mx-auto text-center">
                                        <!-- Business Logo with Link -->
                                        <div class="logo mt-5 mb-3">
                                            <a href="home.html" title="Homepage">
                                                <img src="img/logo.png" alt="Business Logo" style="max-width: 150px;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-0 mt-3">
                                    <div class="col-11 col-lg-9 mx-auto text-center">
                                        <h1 class="text-9 text-white fw-300 mb-5"><span class="fw-500">Welcome</span>, Looks like you're new
                                            here!</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Welcome Text End -->

                <!-- Register Form -->
                <div class="col-md-8 d-flex flex-column align-items-center bg-dark">
                    <div class="container my-auto py-5">
                        <div class="row g-0">
                            <div class="col-11 col-md-8 col-lg-7 col-xl-6 mx-auto">
                                <?php displayErrors($errors); ?>
                                <?php if ($success): ?>
                                    <div class="alert alert-success">
                                        Registration successful! You can now <a href="login.php">login</a>.
                                    </div>
                                <?php else: ?>
                                <p class="text-2 text-light">Already a member? <a class="fw-500" href="login.php">Login</a></p>
                                <h3 class="text-white mb-4">Register Your Account</h3>
                                <div class="d-flex align-items-center my-4">
                                    <hr class="col-1 border-secondary">
                                    <span class="mx-3 text-2 text-white-50"></span>
                                    <hr class="flex-grow-1 border-secondary">
                                </div>
                                <form id="registerForm" class="form-dark" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" required 
                                               value="<?php echo isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName']) : ''; ?>" 
                                               placeholder="Enter Your Name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="emailAddress">Email Address</label>
                                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" required
                                               value="<?php echo isset($_POST['emailAddress']) ? htmlspecialchars($_POST['emailAddress']) : ''; ?>" 
                                               placeholder="Enter Your Email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="userType">Account Type</label>
                                        <select class="form-select" id="userType" name="userType" required>
                                            <option value="" selected disabled>Select your account type</option>
                                            <option value="user" <?php echo (isset($_POST['userType']) && $_POST['userType'] === 'user') ? 'selected' : ''; ?>>Regular User (Rent cars)</option>
                                            <option value="dealer" <?php echo (isset($_POST['userType']) && $_POST['userType'] === 'dealer') ? 'selected' : ''; ?>>Car Dealer (List vehicles for rent)</option>
                                            <option value="admin" <?php echo (isset($_POST['userType']) && $_POST['userType'] === 'admin') ? 'selected' : ''; ?>>Administrator (System management)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="loginPassword">Password</label>
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required
                                               placeholder="Enter Password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="confirmPassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required
                                               placeholder="Confirm Password">
                                    </div>
                                    <!-- Additional fields for dealers -->
                                    <div id="dealerFields" class="d-none">
                                        <div class="mb-3">
                                            <label class="form-label text-light" for="companyName">Company Name</label>
                                            <input type="text" class="form-control" id="companyName" name="companyName"
                                                   value="<?php echo isset($_POST['companyName']) ? htmlspecialchars($_POST['companyName']) : ''; ?>"
                                                   placeholder="Enter Company Name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-light" for="businessLicense">Business License Number</label>
                                            <input type="text" class="form-control" id="businessLicense" name="businessLicense"
                                                   value="<?php echo isset($_POST['businessLicense']) ? htmlspecialchars($_POST['businessLicense']) : ''; ?>"
                                                   placeholder="Enter License Number">
                                        </div>
                                    </div>
                                    <!-- Additional fields for admins -->
                                    <div id="adminFields" class="d-none">
                                        <div class="mb-3">
                                            <label class="form-label text-light" for="adminCode">Administrator Code</label>
                                            <input type="password" class="form-control" id="adminCode" name="adminCode"
                                                   value="<?php echo isset($_POST['adminCode']) ? htmlspecialchars($_POST['adminCode']) : ''; ?>"
                                                   placeholder="Enter Admin Authorization Code">
                                        </div>
                                    </div>
                                    <div class="form-check text-light my-4">
                                        <input id="agree" name="agree" class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label" for="agree">I agree to the <a href="#">Terms</a> and <a
                                                href="#">Privacy Policy</a>.</label>
                                    </div>
                                    <button class="btn btn-primary shadow-none my-2" type="submit">Register</button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Register Form End -->
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://harnishdesign.net/demo/html/oxyy/vendor/jquery/jquery.min.js"></script>
    <script src="https://harnishdesign.net/demo/html/oxyy/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Style Switcher -->
    <script src="https://harnishdesign.net/demo/html/oxyy/js/switcher.min.js"></script>
    <script src="https://harnishdesign.net/demo/html/oxyy/js/theme.js"></script>

    <script>
        $(document).ready(function() {
            // Show/hide additional fields based on user type selection
            $('#userType').change(function() {
                const userType = $(this).val();

                // Hide all additional fields first
                $('#dealerFields, #adminFields').addClass('d-none');

                // Show relevant fields based on selection
                if (userType === 'dealer') {
                    $('#dealerFields').removeClass('d-none');
                } else if (userType === 'admin') {
                    $('#adminFields').removeClass('d-none');
                }
            });

            // Initialize fields based on current selection (in case of form validation error)
            const currentType = $('#userType').val();
            if (currentType === 'dealer') {
                $('#dealerFields').removeClass('d-none');
            } else if (currentType === 'admin') {
                $('#adminFields').removeClass('d-none');
            }

            // Form validation
            $('#registerForm').submit(function(e) {
                // Basic validation
                const password = $('#loginPassword').val();
                const confirmPassword = $('#confirmPassword').val();

                if (password !== confirmPassword) {
                    alert('Passwords do not match!');
                    return false;
                }

                // Additional validation for admin code if admin is selected
                if ($('#userType').val() === 'admin' && $('#adminCode').val().trim() === '') {
                    alert('Please enter the administrator authorization code');
                    return false;
                }

                // Additional validation for dealer fields if dealer is selected
                if ($('#userType').val() === 'dealer') {
                    if ($('#companyName').val().trim() === '' || $('#businessLicense').val().trim() === '') {
                        alert('Please fill all required dealer information');
                        return false;
                    }
                }

                return true; // Allow form submission
            });
        });
    </script>
</body>

</html>