<?php
include 'components/koneksi.php';
session_start();

$id = $_GET['id_login'];
$query = "SELECT * FROM tb_login WHERE id_login=$id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    mysqli_query($conn, "UPDATE tb_login SET username = '$username', password = '$password', role_id = '$role' WHERE id_login = $id");
    header('location:data_user.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php' ?>
    <title>Edit User</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>
                    <p><a href="data_user.php">Kembali</a></p>

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
                                                        <label for="username">Username</label>
                                                        <input value="<?= $row['username']; ?>" type="text" name="username" id="username" class="form-control form-control-user" required>
                                                    </div>
                                                    <!-- password -->
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input value="<?= $row['password']; ?>" type="text" name="password" id="password" class="form-control form-control-user" required>
                                                    </div>
                                                    <!-- pilih role -->
                                                    <div class="form-group">
                                                        <label for="role">Role</label>
                                                        <select name="role" id="role" class="form-control rounded-pill" style="font-size: 13px; height: 50px">
                                                            <option value="">Pilih Role</option>
                                                            <?php
                                                            $roles = mysqli_query($conn, "SELECT * FROM tb_role");
                                                            while ($role = mysqli_fetch_assoc($roles)) :
                                                            ?>
                                                                <option value="<?= $role['id_role']; ?>" <?php if ($row['role_id'] == $role['id_role']) {
                                                                                                                echo 'selected="selected"';
                                                                                                            } ?>><?= $role['role']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <!-- submit -->
                                                    <button type="submit" name="edit" class="btn btn-primary btn-user btn-block">Edit</button>
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