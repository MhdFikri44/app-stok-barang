<?php
include 'components/koneksi.php';
session_start();
session_destroy();
header('location:index.php');
