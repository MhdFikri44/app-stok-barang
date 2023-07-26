<?php
include '../components/koneksi.php';
session_start();

$id = $_GET['id_data'];

$q = mysqli_query($conn, "SELECT gambar FROM tb_data WHERE id_data='$id'");
$gambar = mysqli_fetch_assoc($q);

// menghapus gambar dari folder
unlink('uploaded/' . $gambar);

mysqli_query($conn, "DELETE FROM tb_data WHERE id_data=$id ");
header('location:../admin.php');
