<?php
include 'components/koneksi.php';

if (isset($_POST['tambah'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    if ($role == 'role') {
        echo "<script>
                alert('Silahkan pilih role!!!');
            </script>";
    } else {
        $query = "SELECT * FROM tb_login WHERE username='$user' AND password='$pass'";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

        if ($num == 0) {
            $insert = "INSERT INTO tb_login (username, password, role) VALUES ('$user','$pass','$role')";
            $result = mysqli_query($conn, $insert);
            echo "<script>
                alert('User berhasil ditambah!!!');
            </script>";
        } else {
            echo "<script>
                alert('User sudah adaa!!!');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php' ?>
    <title>Tambah User</title>
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
                            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah User!</h1>
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
                                        <!-- pilih role -->
                                        <div class="form-group">
                                            <select name="role" class="form-control rounded-pill" style="font-size: 13px;">
                                                <option value="role" selected>Pilih Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <!-- submit -->
                                        <button type="submit" name="tambah" class="btn btn-primary btn-user btn-block">Tambah</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Sudah punya akun? Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?= include 'components/script.php'; ?>
</body>

</html>