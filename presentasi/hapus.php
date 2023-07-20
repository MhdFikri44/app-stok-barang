<?php
include 'components/koneksi.php';
session_start();

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tb_data WHERE id=$id ");
header('location:admin.php');
