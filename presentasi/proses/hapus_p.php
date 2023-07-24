<?php
include '../components/koneksi.php';
session_start();

$id = $_GET['id_pemasok'];
mysqli_query($conn, "DELETE FROM tb_pemasok WHERE id_pemasok=$id");
header('location:../data_pemasok.php');
