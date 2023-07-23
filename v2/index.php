<?php
include 'components/koneksi.php';
session_start();

if (isset($_SESSION['masuk'])) {
    header('location:admin.php');
}

if (isset($_POST['masuk'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM tb_login WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['role_id'] == '1') {
            $_SESSION['masuk'] = $row['username'];
            $_SESSION['role'] = 'admin';

            header('location:admin.php');
        }
        if ($row['role_id'] == '2') {
            $_SESSION['masuk'] = $row['username'];
            $_SESSION['role'] = 'user';
            header('location:user.php');
        }
    } else {
        echo "<script>
                alert('User atau sandi salah!');
            </script>";
    }
}
?>

<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <?php include 'components/head_login.php'; ?>
    <title>Login</title>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Title -->
                        <h4 class="mb-1 pt-2">Welcome to Vuexy! 👋</h4><br>
                        <!-- Form -->
                        <form class="mb-3" action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="auth-forgot-password-basic.html">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Massukkan password" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div><br>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" name="masuk">Masuk</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Script -->
    <?php include 'components/script_login.php'; ?>
</body>

</html>