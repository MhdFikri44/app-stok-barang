<?php
include 'components/koneksi.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:index.php');
}
if (isset($_SESSION['masuk'])) {
    header('location:admin.php');
}

$user = $_SESSION['user'];

if (isset($_POST['simpan'])) {
    $passBaru = $_POST['password'];

    // cek password sama atau tidak
    $q = mysqli_query($conn, "SELECT * FROM tb_login WHERE password='$passBaru'");
    $cek = mysqli_num_rows($q);
    if ($cek == 1) {
        echo "<script>
                alert('Masukkan password yg berbeda!');
            </script>";
    } else {
        mysqli_query($conn, "UPDATE tb_login SET password='$passBaru' WHERE username='$user'");
        session_destroy();
        header('location:index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>
    <title>Ganti Password</title>
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
                                        <h1 class="h4 text-gray-900 mb-4">Masukkan Password Baru</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <!-- username -->
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Password baru" required autofocus>
                                        </div>
                                        <!-- submit -->
                                        <button type="submit" name="simpan" class="btn btn-primary btn-user btn-block">Simpan</button>
                                    </form>
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