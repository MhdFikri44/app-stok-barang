<?php
include '../components/koneksi.php';
session_start();

$id = $_GET['id_kategori'];
mysqli_query($conn, "DELETE FROM tb_kategori WHERE id_kategori=$id");
header('location:../data_kategori.php');
