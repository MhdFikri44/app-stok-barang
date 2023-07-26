<?php
include 'components/koneksi.php';
session_start();

$id = $_GET['id_data'];
$query = "SELECT * FROM tb_data WHERE id_data = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $pemasok = $_POST['pemasok'];

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['name'] != "") {
        // ambil nama gambar lama
        $q = mysqli_query($conn, "SELECT gambar FROM tb_data WHERE id_data = $id");
        $ary = mysqli_fetch_assoc($q);
        $gambar = $ary['gambar'];
        // hapus gambar lama
        unlink("uploaded/" . $gambar);
        // upload gambar baru
        $gambarBaru = basename($_FILES["gambar"]["name"]);
        $target_file = "uploaded/" . $gambarBaru;
        $upload = move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        mysqli_query($conn, "UPDATE tb_data SET gambar='$gambarBaru' WHERE id_data = $id");
    }

    mysqli_query($conn, "UPDATE tb_data 
                        SET kode_barang = '$kode_barang',
                            nama_barang = '$nama_barang',
                            kategori_id = '$kategori',
                            jumlah = '$jumlah',
                            pemasok_id = '$pemasok'
                        WHERE id_data = $id
                        ");
    header('location:admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php' ?>
    <title>Edit Data</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Edit Data</h1>
                    <p><a href="admin.php">Kembali</a></p>

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
                                                        <label for="kode">Kode Barang</label>
                                                        <input value="<?= $row['kode_barang']; ?>" type="text" name="kode_barang" id="kode" class="form-control form-control-user" placeholder="Kode barang" required readonly>
                                                    </div>
                                                    <!-- nama -->
                                                    <label for="nama">Nama Barang</label>
                                                    <div class="form-group">
                                                        <input value="<?= $row['nama_barang']; ?>" type="text" name="nama_barang" id="nama" class="form-control form-control-user" placeholder="Nama barang" required>
                                                    </div>
                                                    <!-- kategori -->
                                                    <div class="form-group">
                                                        <label for="kategori">Kategori</label>
                                                        <select name="kategori" id="kategori" class="form-control rounded-pill" style="font-size: 13px; height: 50px" required>
                                                            <option value="">Pilih Kategori</option>
                                                            <?php
                                                            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
                                                            while ($kate = mysqli_fetch_assoc($kategori)) :
                                                            ?>
                                                                <option value="<?= $kate['id_kategori']; ?>" <?php if ($row['kategori_id'] == $kate['id_kategori']) {
                                                                                                                    echo 'selected="selected"';
                                                                                                                } ?>><?= $kate['kategori']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <!-- jumlah -->
                                                    <div class="form-group">
                                                        <label for="jumlah">Jumlah</label>
                                                        <input value="<?= $row['jumlah']; ?>" type="number" name="jumlah" id="jumlah" class="form-control form-control-user" placeholder="Jumlah Barang" required>
                                                    </div>
                                                    <!-- pemasok -->
                                                    <div class="form-group">
                                                        <label for="pemasok">Pemasok</label>
                                                        <select name="pemasok" id="Pemasok" class="form-control rounded-pill" style="font-size: 13px; height: 50px" required>
                                                            <option value="">Pilih Pemasok</option>
                                                            <?php
                                                            $pemasok = mysqli_query($conn, "SELECT * FROM tb_pemasok");
                                                            while ($masok = mysqli_fetch_assoc($pemasok)) :
                                                            ?>
                                                                <option value="<?= $masok['id_pemasok']; ?>" <?php if ($row['pemasok_id'] == $masok['id_pemasok']) {
                                                                                                                    echo 'selected="selected"';
                                                                                                                } ?>><?= $masok['pemasok']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                    <!-- gambar -->
                                                    <div class="form-group">
                                                        <label for="gambar">Input gambar : </label><br>
                                                        <img src="uploaded/<?= $row['gambar'] ?>" width="150" height="100px" style="background-position: center; object-fit: cover;">
                                                        <br><br><input type="file" name="gambar" id="gambar" style="font-size: 12px;">
                                                    </div>
                                                    <hr>
                                                    <!-- tambah -->
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