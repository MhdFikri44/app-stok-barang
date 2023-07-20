<?php
include 'components/koneksi.php';
session_start();

$id = $_GET['id'];
$query = "SELECT * FROM tb_data WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['name'] != "") {
        // ambil nama gambar lama
        $q = mysqli_query($conn, "SELECT gambar FROM tb_data WHERE id = $id");
        $ary = mysqli_fetch_assoc($q);
        $gambar = $ary['gambar'];
        // hapus gambar lama
        unlink("uploaded/" . $gambar);
        // upload gambar baru
        $gambarBaru = basename($_FILES["gambar"]["name"]);
        $target_file = "uploaded/" . $gambarBaru;
        $upload = move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        mysqli_query($conn, "UPDATE tb_data SET gambar='$gambarBaru' WHERE id = $id");
    }

    mysqli_query($conn, "UPDATE tb_data 
                            SET kode_barang = '$kode_barang',
                                nama_barang = '$nama_barang',
                                jumlah = '$jumlah',
                                satuan = '$satuan'
                            WHERE id = $id
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
                                                        <input value="<?= $row['kode_barang'] ?>" type="text" name="kode_barang" class="form-control form-control-user" placeholder="Kode barang">
                                                    </div>
                                                    <!-- nama -->
                                                    <div class="form-group">
                                                        <input value="<?= $row['nama_barang'] ?>" type="text" name="nama_barang" class="form-control form-control-user" placeholder="Nama barang">
                                                    </div>
                                                    <!-- jumlah -->
                                                    <div class="form-group">
                                                        <input value="<?= $row['jumlah'] ?>" type="number" name="jumlah" class="form-control form-control-user" placeholder="Jumlah barang">
                                                    </div>
                                                    <!-- satuan -->
                                                    <div class="form-group">
                                                        <select name="satuan" class="form-control rounded-pill" style="font-size: 13px; height: 50px">
                                                            <option value="0">Pilih satuan</option>
                                                            <option value="unit" <?php if ($row['satuan'] == 'unit') {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Unit</option>
                                                            <option value="pack" <?php if ($row['satuan'] == 'pack') {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Pack</option>
                                                        </select>
                                                    </div>
                                                    <!-- gambar -->
                                                    <div class="form-group" style="font-size: 13px;">
                                                        <label for="gambar">Input gambar : </label><br>
                                                        <img src="uploaded/<?= $row['gambar'] ?>" width="150">
                                                        <br><br><input type="file" name="gambar" id="gambar">
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