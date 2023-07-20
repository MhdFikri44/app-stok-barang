<?php
include 'components/koneksi.php';
session_start();

if (isset($_POST['tambah'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];

    $gambar = basename($_FILES['gambar']['name']);
    $target_file = 'uploaded/' . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    $query = "INSERT INTO tb_data (kode_barang, nama_barang, jumlah, satuan, gambar) 
    VALUES ('$kode_barang','$nama_barang','$jumlah','$satuan','$gambar')";

    mysqli_query($conn, $query);
    header('location:admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php' ?>
    <title>Tambah Data</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Tambah Data</h1>

                    <!-- content -->
                    <div class="row justify-content-center">

                        <div class="col-xl-10 col-lg-12 col-md-9">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="p-5">
                                                <form class="user" method="post" action="" enctype="multipart/form-data">
                                                    <!-- kode -->
                                                    <div class="form-group">
                                                        <input type="text" name="kode_barang" class="form-control form-control-user" placeholder="Kode barang" required>
                                                    </div>
                                                    <!-- nama -->
                                                    <div class="form-group">
                                                        <input type="text" name="nama_barang" class="form-control form-control-user" placeholder="Nama barang" required>
                                                    </div>
                                                    <!-- jumlah -->
                                                    <div class="form-group">
                                                        <input type="number" name="jumlah" class="form-control form-control-user" placeholder="Jumlah barang" required>
                                                    </div>
                                                    <!-- satuan -->
                                                    <div class="form-group">
                                                        <select name="satuan" class="form-control rounded-pill" style="font-size: 13px; height: 50px">
                                                            <option value="0" selected>Pilih satuan</option>
                                                            <option value="unit">Unit</option>
                                                            <option value="pack">Pack</option>
                                                        </select>
                                                    </div>
                                                    <!-- gambar -->
                                                    <div class="form-group" style="font-size: 13px;">
                                                        <label for="gambar">Input gambar : </label>
                                                        <input type="file" name="gambar" id="gambar" required>
                                                    </div>
                                                    <hr>
                                                    <!-- tambah -->
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