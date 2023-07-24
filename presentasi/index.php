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
            $_SESSION['role'] = 'Admin';
            header('location:admin.php');
        }
        if ($row['role_id'] == '2') {
            $_SESSION['masuk'] = $row['username'];
            $_SESSION['role'] = 'Pimpinan';
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
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>
    <title>Login</title>
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
                                        <h1 class="h4 text-gray-900 mb-4">Aplikasi Gudang Barang</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <!-- username -->
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username" required>
                                        </div>
                                        <!-- password -->
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <!-- submit -->
                                        <button type="submit" name="masuk" class="btn btn-primary btn-user btn-block">Masuk</button>
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