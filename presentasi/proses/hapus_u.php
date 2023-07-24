<?php
include '../components/koneksi.php';
session_start();

$id = $_GET['id_login'];
mysqli_query($conn, "DELETE FROM tb_login WHERE id_login=$id");
header('location:../data_user.php');
