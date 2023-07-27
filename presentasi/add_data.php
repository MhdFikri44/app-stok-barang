<?php
include 'components/koneksi.php';
session_start();

if (isset($_POST['tambah'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $pemasok = $_POST['pemasok'];

    $gambar = basename($_FILES['gambar']['name']);
    $target_file = 'uploaded/' . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    $q = mysqli_query($conn, "SELECT * FROM tb_data WHERE kode_barang='$kode_barang'");
    $cek = mysqli_num_rows($q);
    // cek apakah kode sudah ada
    if ($cek == 1) {
        echo "<script>
                alert('Kode yang digunakan sudah ada!');
            </script>";
    } else {
        $query = "INSERT INTO tb_data (kode_barang, nama_barang, kategori_id, jumlah, pemasok_id, gambar) 
                    VALUES ('$kode_barang','$nama_barang','$kategori','$jumlah','$pemasok','$gambar')";

        mysqli_query($conn, $query);
        header('location:admin.php');
    }
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
                                                        <input type="text" name="kode_barang" class="form-control form-control-user" placeholder="Kode barang" required autofocus>
                                                    </div>
                                                    <!-- nama -->
                                                    <div class="form-group">
                                                        <input type="text" name="nama_barang" class="form-control form-control-user" placeholder="Nama barang" required>
                                                    </div>
                                                    <!-- kategori -->
                                                    <div class="form-group">
                                                        <select name="kategori" class="form-control rounded-pill" style="font-size: 13px; height: 50px" required>
                                                            <option value="" selected>Pilih Kategori</option>
                                                            <?php
                                                            $result = mysqli_query($conn, "SELECT * FROM tb_kategori");
                                                            while ($row = mysqli_fetch_assoc($result)) : ?>
                                                                <option value="<?= $row['id_kategori']; ?>"><?= $row['kategori']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <!-- jumlah -->
                                                    <div class="form-group">
                                                        <input type="number" name="jumlah" class="form-control form-control-user" placeholder="Jumlah barang" required>
                                                    </div>
                                                    <!-- pemasok -->
                                                    <div class="form-group">
                                                        <select name="pemasok" class="form-control rounded-pill" style="font-size: 13px; height: 50px" required>
                                                            <option value="" selected>Pilih Pemasok</option>
                                                            <?php
                                                            $result = mysqli_query($conn, "SELECT * FROM tb_pemasok");
                                                            while ($row = mysqli_fetch_assoc($result)) : ?>
                                                                <option value="<?= $row['id_pemasok']; ?>"><?= $row['pemasok']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <!-- gambar -->
                                                    <div class="form-group">
                                                        <input type="file" name="gambar" style="font-size: 12px;" required>
                                                    </div>


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