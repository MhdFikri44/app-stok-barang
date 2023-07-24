<?php
include '../components/koneksi.php';
session_start();

$id = $_GET['id_data'];
mysqli_query($conn, "DELETE FROM tb_data WHERE id_data=$id ");
header('location:../admin.php');
