<?php
session_start();
include 'config/config.php';
$conn = getDatabaseConnection();

if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'index.php');
    exit;
}

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $name = trim($_POST['name'] ?? '');
    // Validasi input
    if (empty($username) || empty($password) || empty($name)) {
        $error = 'Semua kolom wajib diisi.';
    } elseif (strlen($password) < 6) {
        $error = 'Password harus minimal 6 karakter.';
    } else {
        // Cek apakah username sudah ada
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error = 'Username sudah digunakan.';
        } else {
            // Hash password dan simpan user baru
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name,username, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $name,$username, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                $success = 'Registrasi berhasil! Silakan Login';
            } else {
                $error = 'Gagal menyimpan data. Silakan coba lagi.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register - Inventory App</title>
    <?php include 'includes/header.php'; ?>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="name" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="username" placeholder="Username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" name="password">
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                                    </div>
                                </div>
                                <?php if ($error): ?>
                                    <p style="color: red;"><?php echo $error; ?></p>
                                <?php endif; ?>
                                <?php if ($success): ?>
                                    <p style="color: green;"><?php echo $success; ?></p>
                                <?php endif; ?>
                                <div class="mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>