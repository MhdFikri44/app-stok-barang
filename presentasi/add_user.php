<?php
include 'components/koneksi.php';
session_start();

if (isset($_POST['tambah'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    if ($role == '') {
        echo "<script>
                alert('Silahkan pilih role!!!');
            </script>";
    } else {
        $query = "SELECT * FROM tb_login WHERE username='$user' AND password='$pass'";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

        if ($num == 0) {
            $insert = "INSERT INTO tb_login (username, password, role_id) VALUES ('$user','$pass','$role')";
            $result = mysqli_query($conn, $insert);
            header('location:data_user.php');
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'components/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'components/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>

                    <!-- content -->
                    <div class="row justify-content-center">

                        <div class="col-xl-10 col-lg-12 col-md-9">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="p-5">
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
                                                        <select name="role" class="form-control rounded-pill" style="font-size: 13px; height: 50px">
                                                            <option value="" selected>Pilih Role</option>
                                                            <?php
                                                            $result = mysqli_query($conn, "SELECT * FROM tb_role");
                                                            while ($row = mysqli_fetch_assoc($result)) :
                                                            ?>
                                                                <option value="<?= $row['id_role']; ?>"><?= $row['role']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <!-- submit -->
                                                    <button type="submit" name="tambah" class="btn btn-primary btn-user btn-block">Tambah</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'components/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include 'components/scroll_top.php'; ?>

    <!-- Logout Notif-->
    <?php include 'components/logout_notif.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
    <?php include 'components/script.php'; ?>
</body>

</html>