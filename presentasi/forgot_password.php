<?php
include 'components/koneksi.php';
session_start();

if (isset($_SESSION['masuk'])) {
    header('location:admin.php');
}

if (isset($_POST['kirim'])) {
    $user = $_POST['username'];

    // cek user ada atau tidak
    $q = mysqli_query($conn, "SELECT * FROM tb_login WHERE username='$user'");
    $cek = mysqli_num_rows($q);
    if ($cek == 0) {
        echo "<script>
                alert('User tidak ada!');
            </script>";
    } else {
        $_SESSION['user'] = $user;
        header('location:reset_password.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>
    <title>Lupa Password</title>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="img/login.jpg" width="450" height="400" style="background-position: center; background-size: cover;" />
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Lupa Password?</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <!-- username -->
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Username" required autofocus>
                                        </div>
                                        <!-- submit -->
                                        <button type="submit" name="kirim" class="btn btn-primary btn-user btn-block">Kirim</button>
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <a class="small" href="index.php">Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
    <?php include 'components/script.php'; ?>
</body>

</html>